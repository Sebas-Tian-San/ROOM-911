<?php

namespace App\Http\Controllers;

use App\Models\AccessAttemp;
use Illuminate\Http\Request;
use App\Models\Employee;

class Room911AccessController extends Controller
{
    public function showForm()
    {
        return view('room911.access');
    }

    public function processAccess(Request $request)
    {
    $request->validate([
        'internal_id' => 'required|regex:/^\d{0,11}$/',
    ], [
    'internal_id.regex' => 'El campo ID interno debe contener solo números y máximo 10 dígitos.',
    ]);

        $internalId = (int) $request->input('internal_id');
        $employee = Employee::where('internal_id', $internalId)->first();

        $status = 'No Registrado';
        $employeeId = null;

        if ($employee) {
            $employeeId = $employee->id;
            $status = $employee->has_room_911_access ? 'Permitido' : 'Denegado';
        }

        AccessAttemp::create([
            'employee_id' => $employeeId,
            'attempted_internal_id' => $internalId,
            'status' => $status,
        ]);

        return back()->with('status', $status);
    }
}
