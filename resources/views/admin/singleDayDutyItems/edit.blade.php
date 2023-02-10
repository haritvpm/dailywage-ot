@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.singleDayDutyItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.single-day-duty-items.update", [$singleDayDutyItem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.singleDayDutyItem.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $singleDayDutyItem->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDutyItem.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fn_from">{{ trans('cruds.singleDayDutyItem.fields.fn_from') }}</label>
                <input class="form-control timepicker {{ $errors->has('fn_from') ? 'is-invalid' : '' }}" type="text" name="fn_from" id="fn_from" value="{{ old('fn_from', $singleDayDutyItem->fn_from) }}">
                @if($errors->has('fn_from'))
                    <span class="text-danger">{{ $errors->first('fn_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDutyItem.fields.fn_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fn_to">{{ trans('cruds.singleDayDutyItem.fields.fn_to') }}</label>
                <input class="form-control timepicker {{ $errors->has('fn_to') ? 'is-invalid' : '' }}" type="text" name="fn_to" id="fn_to" value="{{ old('fn_to', $singleDayDutyItem->fn_to) }}">
                @if($errors->has('fn_to'))
                    <span class="text-danger">{{ $errors->first('fn_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDutyItem.fields.fn_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="an_from">{{ trans('cruds.singleDayDutyItem.fields.an_from') }}</label>
                <input class="form-control timepicker {{ $errors->has('an_from') ? 'is-invalid' : '' }}" type="text" name="an_from" id="an_from" value="{{ old('an_from', $singleDayDutyItem->an_from) }}">
                @if($errors->has('an_from'))
                    <span class="text-danger">{{ $errors->first('an_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDutyItem.fields.an_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="an_to">{{ trans('cruds.singleDayDutyItem.fields.an_to') }}</label>
                <input class="form-control timepicker {{ $errors->has('an_to') ? 'is-invalid' : '' }}" type="text" name="an_to" id="an_to" value="{{ old('an_to', $singleDayDutyItem->an_to) }}">
                @if($errors->has('an_to'))
                    <span class="text-danger">{{ $errors->first('an_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDutyItem.fields.an_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_hours">{{ trans('cruds.singleDayDutyItem.fields.total_hours') }}</label>
                <input class="form-control {{ $errors->has('total_hours') ? 'is-invalid' : '' }}" type="number" name="total_hours" id="total_hours" value="{{ old('total_hours', $singleDayDutyItem->total_hours) }}" step="0.01">
                @if($errors->has('total_hours'))
                    <span class="text-danger">{{ $errors->first('total_hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDutyItem.fields.total_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="form_id">{{ trans('cruds.singleDayDutyItem.fields.form') }}</label>
                <select class="form-control select2 {{ $errors->has('form') ? 'is-invalid' : '' }}" name="form_id" id="form_id">
                    @foreach($forms as $id => $entry)
                        <option value="{{ $id }}" {{ (old('form_id') ? old('form_id') : $singleDayDutyItem->form->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('form'))
                    <span class="text-danger">{{ $errors->first('form') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDutyItem.fields.form_helper') }}</span>
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