<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Employee::query();

        // Búsqueda por ID, nombre o apellido
        if ($request->filled('search')) {
            $query->where('internal_id', 'like', '%' . $request->search . '%')
                  ->orWhere('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%');
        }

        // Filtrado por departamento
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        // Filtrado por permiso de acceso
        if ($request->filled('has_room_911_access')) {
            $query->where('has_room_911_access', $request->has_room_911_access);
        }

        $employees = $query->paginate(10);

        // Obtener los departamentos para el filtro
        $departments = Department::all();

        return view('employee.index', compact('employees', 'departments'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employee = new Employee();

        return view('employee.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request): RedirectResponse
    {
        Employee::create($request->validated());

        return Redirect::route('employees.index')
            ->with('success', 'Empleado creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id): View
    {
        $employee = Employee::findOrFail($id);

        // Consulta base para obtener los intentos de acceso del empleado
        $query = $employee->accessAttemps();

        // Filtrar por rango de fechas
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $accessAttemps = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('employee.show', compact('employee', 'accessAttemps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $employee = Employee::find($id);

        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->validated());

        return Redirect::route('employees.index')
            ->with('success', 'Empleado actualizado satisfactoriamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Employee::find($id)->delete();

        return Redirect::route('employees.index')
            ->with('success', 'Empleado eliminado satisfactoriamente.');
    }

    public function import(Request $request)
    {
        Log::info('Import method called.'); // Verifica si el método es alcanzado

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:5120', //Tamño máximo 5MB
        ]);

        Log::info('File validated.'); // Verifica si pasa la validación

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();

        Log::info('File path: ' . $filePath); // Verifica la ruta del archivo

        try {
            // Leer el archivo CSV
            $csvData = array_map(function ($line) {
                return str_getcsv($line, ';'); // Cambia el delimitador a ;
            }, file($filePath));
            $header = array_shift($csvData); // Extraer encabezados

            Log::info('CSV headers: ' . implode(';', $header)); // Verifica los encabezados

            foreach ($csvData as $row) {
                $row = array_combine($header, $row);

                Log::info('Processing row: ' . json_encode($row)); // Verifica cada fila

                Validator::make($row, [
                    'internal_id' => 'required|integer|unique:employees,internal_id',
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|unique:employees,email',
                    'has_room_911_access' => 'required|boolean',
                    'department_id' => 'required|exists:departments,id',
                ])->validate();

                Employee::create([
                    'internal_id' => $row['internal_id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'has_room_911_access' => $row['has_room_911_access'],
                    'department_id' => $row['department_id'],
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error during import: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error importing CSV: ' . $e->getMessage()]);
        }

        Log::info('Import completed.'); // Verifica si se completó el proceso

        return redirect()->route('employees.index')->with('success', 'Empleados cargados satisfactoriamente.');
    }

    public function downloadAccessHistory(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        // Consulta base para obtener los intentos de acceso del empleado
        $query = $employee->accessAttemps();

        // Filtrar por rango de fechas
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filtrar por estado (opcional)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $accessAttemps = $query->orderBy('created_at', 'desc')->get();

        // Generar el PDF
        $pdf = Pdf::loadView('employee.access-history-pdf', compact('employee', 'accessAttemps'));

        // Descargar el PDF
        return $pdf->download('Historial_Accesos_' . $employee->first_name . '_' . $employee->last_name . '.pdf');
    }
}
