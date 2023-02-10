@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.singleDayDuty.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.single-day-duties.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date_id">{{ trans('cruds.singleDayDuty.fields.date') }}</label>
                <select class="form-control select2 {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date_id" id="date_id">
                    @foreach($dates as $id => $entry)
                        <option value="{{ $id }}" {{ old('date_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDuty.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_hours">{{ trans('cruds.singleDayDuty.fields.total_hours') }}</label>
                <input class="form-control {{ $errors->has('total_hours') ? 'is-invalid' : '' }}" type="number" name="total_hours" id="total_hours" value="{{ old('total_hours', '') }}" step="0.01">
                @if($errors->has('total_hours'))
                    <span class="text-danger">{{ $errors->first('total_hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDuty.fields.total_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="owned_by_id">{{ trans('cruds.singleDayDuty.fields.owned_by') }}</label>
                <select class="form-control select2 {{ $errors->has('owned_by') ? 'is-invalid' : '' }}" name="owned_by_id" id="owned_by_id">
                    @foreach($owned_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('owned_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('owned_by'))
                    <span class="text-danger">{{ $errors->first('owned_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDuty.fields.owned_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="section_name">{{ trans('cruds.singleDayDuty.fields.section_name') }}</label>
                <input class="form-control {{ $errors->has('section_name') ? 'is-invalid' : '' }}" type="text" name="section_name" id="section_name" value="{{ old('section_name', '') }}">
                @if($errors->has('section_name'))
                    <span class="text-danger">{{ $errors->first('section_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.singleDayDuty.fields.section_name_helper') }}</span>
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