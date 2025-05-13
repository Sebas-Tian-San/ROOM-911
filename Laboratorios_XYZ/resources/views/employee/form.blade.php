<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="internal_id" class="form-label">{{ __('Internal Id') }}</label>
            <input type="text" name="internal_id" class="form-control @error('internal_id') is-invalid @enderror" value="{{ old('internal_id', $employee?->internal_id) }}" id="internal_id" placeholder="Internal Id">
            {!! $errors->first('internal_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="first_name" class="form-label">{{ __('First Name') }}</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $employee?->first_name) }}" id="first_name" placeholder="First Name">
            {!! $errors->first('first_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $employee?->last_name) }}" id="last_name" placeholder="Last Name">
            {!! $errors->first('last_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="has_room_911_access" class="form-label">{{ __('Has Room 911 Access') }}</label>
            <select name="has_room_911_access" class="form-control @error('has_room_911_access') is-invalid @enderror" id="has_room_911_access">
            <option value="1" {{ old('has_room_911_access', $employee->has_room_911_access ?? '') == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('has_room_911_access', $employee->has_room_911_access ?? '') == 0 ? 'selected' : '' }}>No</option>
                </select>
            {!! $errors->first('has_room_911_access', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="department_id" class="form-label">{{ __('Department Id') }}</label>
            <input type="text" name="department_id" class="form-control @error('department_id') is-invalid @enderror" value="{{ old('department_id', $employee?->department_id) }}" id="department_id" placeholder="Department Id">
            {!! $errors->first('department_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>