@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.category.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="max_hours">{{ trans('cruds.category.fields.max_hours') }}</label>
                <input class="form-control {{ $errors->has('max_hours') ? 'is-invalid' : '' }}" type="number" name="max_hours" id="max_hours" value="{{ old('max_hours', '') }}" step="0.01" required>
                @if($errors->has('max_hours'))
                    <span class="text-danger">{{ $errors->first('max_hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.max_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="working_fn_from">{{ trans('cruds.category.fields.working_fn_from') }}</label>
                <input class="form-control timepicker {{ $errors->has('working_fn_from') ? 'is-invalid' : '' }}" type="text" name="working_fn_from" id="working_fn_from" value="{{ old('working_fn_from') }}">
                @if($errors->has('working_fn_from'))
                    <span class="text-danger">{{ $errors->first('working_fn_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.working_fn_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="working_fn_to">{{ trans('cruds.category.fields.working_fn_to') }}</label>
                <input class="form-control timepicker {{ $errors->has('working_fn_to') ? 'is-invalid' : '' }}" type="text" name="working_fn_to" id="working_fn_to" value="{{ old('working_fn_to') }}">
                @if($errors->has('working_fn_to'))
                    <span class="text-danger">{{ $errors->first('working_fn_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.working_fn_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="working_an_from">{{ trans('cruds.category.fields.working_an_from') }}</label>
                <input class="form-control timepicker {{ $errors->has('working_an_from') ? 'is-invalid' : '' }}" type="text" name="working_an_from" id="working_an_from" value="{{ old('working_an_from') }}">
                @if($errors->has('working_an_from'))
                    <span class="text-danger">{{ $errors->first('working_an_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.working_an_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="working_an_to">{{ trans('cruds.category.fields.working_an_to') }}</label>
                <input class="form-control timepicker {{ $errors->has('working_an_to') ? 'is-invalid' : '' }}" type="text" name="working_an_to" id="working_an_to" value="{{ old('working_an_to') }}">
                @if($errors->has('working_an_to'))
                    <span class="text-danger">{{ $errors->first('working_an_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.working_an_to_helper') }}</span>
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