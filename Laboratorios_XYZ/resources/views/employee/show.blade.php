@extends('layouts.app')

@section('template_title')
    {{ __('Historial de Accesos de ') . $employee->first_name . ' ' . $employee->last_name }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Historial de Accesos al ROOM_911') }}</h3>
                    </div>

                    <!-- Formulario de filtrado por rango de fechas -->
                    <form action="{{ route('employees.show', $employee->id) }}" method="GET" class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">{{ __('Fecha de inicio') }}</label>
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">{{ __('Fecha de fin') }}</label>
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="status">{{ __('Estado') }}</label>
                                <select name="status" class="form-control">
                                    <option value="">{{ __('Todos los estados') }}</option>
                                    <option value="concedido" {{ request('status') == 'concedido' ? 'selected' : '' }}>{{ __('Concedido') }}</option>
                                    <option value="denegado" {{ request('status') == 'denegado' ? 'selected' : '' }}>{{ __('Denegado') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-2">{{ __('Filtrar') }}</button>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary me-2">{{ __('Limpiar') }}</a>
                                                            <a href="{{ route('employees.access-history.pdf', $employee->id) }}" class="btn btn-danger me-2">
                                {{ __('Descargar PDF') }}
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Intento de ID Interno') }}</th>
                                        <th>{{ __('Estado') }}</th>
                                        <th>{{ __('Fecha de Creación') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accessAttemps as $attempt)
                                        <tr>
                                            <td>{{ $attempt->id }}</td>
                                            <td>{{ $attempt->attempted_internal_id }}</td>
                                            <td>{{ $attempt->status }}</td>
                                            <td>{{ $attempt->created_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('No se encontraron intentos de acceso.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $accessAttemps->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
