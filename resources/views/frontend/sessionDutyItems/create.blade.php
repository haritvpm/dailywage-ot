@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.sessionDutyItem.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.session-duty-items.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="fn_from">{{ trans('cruds.sessionDutyItem.fields.fn_from') }}</label>
                            <input class="form-control timepicker" type="text" name="fn_from" id="fn_from" value="{{ old('fn_from') }}">
                            @if($errors->has('fn_from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fn_from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDutyItem.fields.fn_from_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fn_to">{{ trans('cruds.sessionDutyItem.fields.fn_to') }}</label>
                            <input class="form-control timepicker" type="text" name="fn_to" id="fn_to" value="{{ old('fn_to') }}">
                            @if($errors->has('fn_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fn_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDutyItem.fields.fn_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="an_from">{{ trans('cruds.sessionDutyItem.fields.an_from') }}</label>
                            <input class="form-control timepicker" type="text" name="an_from" id="an_from" value="{{ old('an_from') }}">
                            @if($errors->has('an_from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('an_from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDutyItem.fields.an_from_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="an_to">{{ trans('cruds.sessionDutyItem.fields.an_to') }}</label>
                            <input class="form-control timepicker" type="text" name="an_to" id="an_to" value="{{ old('an_to') }}">
                            @if($errors->has('an_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('an_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDutyItem.fields.an_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_hours">{{ trans('cruds.sessionDutyItem.fields.total_hours') }}</label>
                            <input class="form-control" type="number" name="total_hours" id="total_hours" value="{{ old('total_hours', '') }}" step="0.01">
                            @if($errors->has('total_hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDutyItem.fields.total_hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date_id">{{ trans('cruds.sessionDutyItem.fields.date') }}</label>
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
                            <span class="help-block">{{ trans('cruds.sessionDutyItem.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="form_id">{{ trans('cruds.sessionDutyItem.fields.form') }}</label>
                            <select class="form-control select2" name="form_id" id="form_id">
                                @foreach($forms as $id => $entry)
                                    <option value="{{ $id }}" {{ old('form_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('form'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('form') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sessionDutyItem.fields.form_helper') }}</span>
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