@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sessionDuty.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.session-duties.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="employee_id">{{ trans('cruds.sessionDuty.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id">
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sessionDuty.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="session_id">{{ trans('cruds.sessionDuty.fields.session') }}</label>
                <select class="form-control select2 {{ $errors->has('session') ? 'is-invalid' : '' }}" name="session_id" id="session_id" required>
                    @foreach($sessions as $id => $entry)
                        <option value="{{ $id }}" {{ old('session_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('session'))
                    <span class="text-danger">{{ $errors->first('session') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sessionDuty.fields.session_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="owned_by_id">{{ trans('cruds.sessionDuty.fields.owned_by') }}</label>
                <select class="form-control select2 {{ $errors->has('owned_by') ? 'is-invalid' : '' }}" name="owned_by_id" id="owned_by_id">
                    @foreach($owned_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('owned_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('owned_by'))
                    <span class="text-danger">{{ $errors->first('owned_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sessionDuty.fields.owned_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="section_name">{{ trans('cruds.sessionDuty.fields.section_name') }}</label>
                <input class="form-control {{ $errors->has('section_name') ? 'is-invalid' : '' }}" type="text" name="section_name" id="section_name" value="{{ old('section_name', '') }}">
                @if($errors->has('section_name'))
                    <span class="text-danger">{{ $errors->first('section_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sessionDuty.fields.section_name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection