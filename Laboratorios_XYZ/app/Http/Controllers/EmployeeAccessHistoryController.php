<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\AccessAttempt;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeAccessHistoryController extends Controller
{
    public function show(Employee $employee, Request $request)
    {
        $query = $employee->accessAttempts()->latest();

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->input('to'));
        }

        $attempts = $query->get();

        return view('employees.history', compact('employee', 'attempts'));
    }

    public function exportPDF(Employee $employee, Request $request)
    {
        $query = $employee->accessAttempts()->latest();

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->input('to'));
        }

        $attempts = $query->get();

        $pdf = PDF::loadView('employees.pdf', compact('employee', 'attempts'));
        return $pdf->download("access_history_{$employee->id}.pdf");
    }
}
