@extends('layouts.app')

<!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->

@section('content')
<div class="custom-container">
    <h2>Acceso al ROOM_911</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Mostrar mensaje de estado -->
    @if(session('status'))
        <div class="alert alert-info">
            Resultado del acceso: <strong>{{ session('status') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('room911.process') }}">
        @csrf
        <div class="form-group">
            <label for="internal_id">ID Interno del Empleado:</label>
            <input type="text"
                name="internal_id"
                class="form-control"
                required
                maxlength="10"
                pattern="\d{1,10}"
                title="Debe contener solo números y máximo 10 dígitos">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3 px-5">Validar Acceso</button>
        </div>
    </form>
</div>
@endsection
