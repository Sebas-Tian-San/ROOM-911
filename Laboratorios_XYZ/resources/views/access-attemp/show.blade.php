@extends('layouts.app')

@section('template_title')
    {{ $accessAttemp->name ?? __('Show') . " " . __('Access Attemp') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Access Attemp</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('access-attemps.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Employee Id:</strong>
                                    {{ $accessAttemp->employee_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Attempted Internal Id:</strong>
                                    {{ $accessAttemp->attempted_internal_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $accessAttemp->status }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
