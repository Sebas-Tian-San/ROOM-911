<?php ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Historial de Accesos') }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>{{ __('Historial de Accesos al ROOM_911') }}</h1>
    <p><strong>{{ __('Empleado:') }}</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
    <p><strong>{{ __('ID Interno:') }}</strong> {{ $employee->internal_id }}</p>

    <table>
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Intento de ID Interno') }}</th>
                <th>{{ __('Estado') }}</th>
                <th>{{ __('Fecha de Creación') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accessAttemps as $attempt)
                <tr>
                    <td>{{ $attempt->id }}</td>
                    <td>{{ $attempt->attempted_internal_id }}</td>
                    <td>{{ $attempt->status }}</td>
                    <td>{{ $attempt->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>