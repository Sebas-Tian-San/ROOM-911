@extends('layouts.app')

@section('template_title')
    Access Attemps
@endsection

<!-- <link rel="stylesheet" href="{{ asset('css/accessattempts.css') }}"> -->

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Historial de Accesos') }}
                            </span>

                             <!-- <div class="float-right">
                                <a href="{{ route('access-attemps.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div> -->
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Empleado Id</th>
									<th >Numero Interno Empleado</th>
									<th >Estado</th>
                                    <th >Creado En</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accessAttemps as $accessAttemp)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $accessAttemp->employee_id }}</td>
										<td >{{ $accessAttemp->attempted_internal_id }}</td>
										<td >{{ $accessAttemp->status }}</td>
                                        <td >{{ $accessAttemp->created_at }}</td>

                                            <td>
                                                <form action="{{ route('access-attemps.destroy', $accessAttemp->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('access-attemps.show', $accessAttemp->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <!-- <a class="btn btn-sm btn-success" href="{{ route('access-attemps.edit', $accessAttemp->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a> -->
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button> -->
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $accessAttemps->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
