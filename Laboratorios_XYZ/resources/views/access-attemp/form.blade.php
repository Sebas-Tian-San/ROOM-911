<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="employee_id" class="form-label">{{ __('Employee Id') }}</label>
            <input type="text" name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" value="{{ old('employee_id', $accessAttemp?->employee_id) }}" id="employee_id" placeholder="Employee Id">
            {!! $errors->first('employee_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="attempted_internal_id" class="form-label">{{ __('Attempted Internal Id') }}</label>
            <input type="text" name="attempted_internal_id" class="form-control @error('attempted_internal_id') is-invalid @enderror" value="{{ old('attempted_internal_id', $accessAttemp?->attempted_internal_id) }}" id="attempted_internal_id" placeholder="Attempted Internal Id">
            {!! $errors->first('attempted_internal_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label">{{ __('Status') }}</label>
            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status', $accessAttemp?->status) }}" id="status" placeholder="Status">
            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>