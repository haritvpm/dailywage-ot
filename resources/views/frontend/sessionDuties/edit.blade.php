@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.sessionDuty.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.session-duties.update", [$sessionDuty->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">{{ trans('cruds.sessionDuty.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id">
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $sessionDuty->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDuty.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="session_id">{{ trans('cruds.sessionDuty.fields.session') }}</label>
                            <select class="form-control select2" name="session_id" id="session_id" required>
                                @foreach($sessions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('session_id') ? old('session_id') : $sessionDuty->session->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('session'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('session') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDuty.fields.session_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="owned_by_id">{{ trans('cruds.sessionDuty.fields.owned_by') }}</label>
                            <select class="form-control select2" name="owned_by_id" id="owned_by_id">
                                @foreach($owned_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('owned_by_id') ? old('owned_by_id') : $sessionDuty->owned_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('owned_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owned_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDuty.fields.owned_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="section_name">{{ trans('cruds.sessionDuty.fields.section_name') }}</label>
                            <input class="form-control" type="text" name="section_name" id="section_name" value="{{ old('section_name', $sessionDuty->section_name) }}">
                            @if($errors->has('section_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section_name') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection