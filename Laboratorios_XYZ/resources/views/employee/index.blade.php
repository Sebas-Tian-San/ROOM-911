@extends('layouts.app')

@section('template_title')
    Employees
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Employees') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                            @csrf
                            <div class="input-group">
                                <input type="file" name="csv_file" class="form-control" required>
                                <button type="submit" class="btn btn-success">{{ __('Importar CSV') }}</button>
                            </div>
                        </form>
                        <!-- Formulario de búsqueda y filtrado -->
                        <form action="{{ route('employees.index') }}" method="GET" class="mt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Buscar por ID, nombre o apellido" value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="department_id" class="form-control">
                                        <option value="">{{ __('Todos los departamentos') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="has_room_911_access" class="form-control">
                                        <option value="">{{ __('Todos los accesos') }}</option>
                                        <option value="1" {{ request('has_room_911_access') == '1' ? 'selected' : '' }}>{{ __('Con acceso') }}</option>
                                        <option value="0" {{ request('has_room_911_access') == '0' ? 'selected' : '' }}>{{ __('Sin acceso') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">{{ __('Limpiar') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Internal Id</th>
									<th >First Name</th>
									<th >Last Name</th>
									<th >Email</th>
									<th >Has Room 911 Access</th>
									<th >Department Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $employee->internal_id }}</td>
										<td >{{ $employee->first_name }}</td>
										<td >{{ $employee->last_name }}</td>
										<td >{{ $employee->email }}</td>
										<td >{{ $employee->has_room_911_access }}</td>
										<td >{{ $employee->department_id }}</td>

                                            <td>
                                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('employees.show', $employee->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('employees.edit', $employee->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $employees->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
