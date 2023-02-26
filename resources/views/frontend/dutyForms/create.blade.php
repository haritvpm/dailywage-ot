@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.dutyForm.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.duty-forms.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('cruds.dutyForm.fields.form_type') }}</label>
                            <select class="form-control" name="form_type" id="form_type">
                                <option value disabled {{ old('form_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\DutyForm::FORM_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('form_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('form_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('form_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dutyForm.fields.form_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date_id">{{ trans('cruds.dutyForm.fields.date') }}</label>
                            <select class="form-control select2" name="date_id" id="date_id">
                                @foreach($dates as $id => $entry)
                                    <option value="{{ $id }}" {{ old('date_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dutyForm.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="session_id">{{ trans('cruds.dutyForm.fields.session') }}</label>
                            <select class="form-control select2" name="session_id" id="session_id">
                                @foreach($sessions as $id => $entry)
                                    <option value="{{ $id }}" {{ old('session_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('session'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('session') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dutyForm.fields.session_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="employee_id">{{ trans('cruds.dutyForm.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id">
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dutyForm.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_hours">{{ trans('cruds.dutyForm.fields.total_hours') }}</label>
                            <input class="form-control" type="number" name="total_hours" id="total_hours" value="{{ old('total_hours', '') }}" step="0.01">
                            @if($errors->has('total_hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dutyForm.fields.total_hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="owned_by_id">{{ trans('cruds.dutyForm.fields.owned_by') }}</label>
                            <select class="form-control select2" name="owned_by_id" id="owned_by_id">
                                @foreach($owned_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('owned_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('owned_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owned_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dutyForm.fields.owned_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="section_name">{{ trans('cruds.dutyForm.fields.section_name') }}</label>
                            <input class="form-control" type="text" name="section_name" id="section_name" value="{{ old('section_name', '') }}">
                            @if($errors->has('section_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dutyForm.fields.section_name_helper') }}</span>
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