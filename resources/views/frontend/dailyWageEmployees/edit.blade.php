@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.dailyWageEmployee.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.daily-wage-employees.update", [$dailyWageEmployee->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.dailyWageEmployee.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $dailyWageEmployee->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dailyWageEmployee.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ten">{{ trans('cruds.dailyWageEmployee.fields.ten') }}</label>
                            <input class="form-control" type="text" name="ten" id="ten" value="{{ old('ten', $dailyWageEmployee->ten) }}" required>
                            @if($errors->has('ten'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ten') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dailyWageEmployee.fields.ten_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="designation_id">{{ trans('cruds.dailyWageEmployee.fields.designation') }}</label>
                            <select class="form-control select2" name="designation_id" id="designation_id" required>
                                @foreach($designations as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('designation_id') ? old('designation_id') : $dailyWageEmployee->designation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('designation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('designation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dailyWageEmployee.fields.designation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.dailyWageEmployee.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $dailyWageEmployee->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dailyWageEmployee.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="section_id">{{ trans('cruds.dailyWageEmployee.fields.section') }}</label>
                            <select class="form-control select2" name="section_id" id="section_id">
                                @foreach($sections as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('section_id') ? old('section_id') : $dailyWageEmployee->section->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('section'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dailyWageEmployee.fields.section_helper') }}</span>
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