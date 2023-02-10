@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.singleDayDuty.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.single-day-duties.update", [$singleDayDuty->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="date_id">{{ trans('cruds.singleDayDuty.fields.date') }}</label>
                            <select class="form-control select2" name="date_id" id="date_id">
                                @foreach($dates as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('date_id') ? old('date_id') : $singleDayDuty->date->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.singleDayDuty.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_hours">{{ trans('cruds.singleDayDuty.fields.total_hours') }}</label>
                            <input class="form-control" type="number" name="total_hours" id="total_hours" value="{{ old('total_hours', $singleDayDuty->total_hours) }}" step="0.01">
                            @if($errors->has('total_hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.singleDayDuty.fields.total_hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="owned_by_id">{{ trans('cruds.singleDayDuty.fields.owned_by') }}</label>
                            <select class="form-control select2" name="owned_by_id" id="owned_by_id">
                                @foreach($owned_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('owned_by_id') ? old('owned_by_id') : $singleDayDuty->owned_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('owned_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owned_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.singleDayDuty.fields.owned_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="section_name">{{ trans('cruds.singleDayDuty.fields.section_name') }}</label>
                            <input class="form-control" type="text" name="section_name" id="section_name" value="{{ old('section_name', $singleDayDuty->section_name) }}">
                            @if($errors->has('section_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section_name') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection