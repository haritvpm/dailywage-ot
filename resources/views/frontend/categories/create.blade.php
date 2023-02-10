@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.categories.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.category.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="max_hours">{{ trans('cruds.category.fields.max_hours') }}</label>
                            <input class="form-control" type="number" name="max_hours" id="max_hours" value="{{ old('max_hours', '') }}" step="0.01" required>
                            @if($errors->has('max_hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('max_hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.max_hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="working_fn_from">{{ trans('cruds.category.fields.working_fn_from') }}</label>
                            <input class="form-control timepicker" type="text" name="working_fn_from" id="working_fn_from" value="{{ old('working_fn_from') }}">
                            @if($errors->has('working_fn_from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('working_fn_from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.working_fn_from_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="working_fn_to">{{ trans('cruds.category.fields.working_fn_to') }}</label>
                            <input class="form-control timepicker" type="text" name="working_fn_to" id="working_fn_to" value="{{ old('working_fn_to') }}">
                            @if($errors->has('working_fn_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('working_fn_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.working_fn_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="working_an_from">{{ trans('cruds.category.fields.working_an_from') }}</label>
                            <input class="form-control timepicker" type="text" name="working_an_from" id="working_an_from" value="{{ old('working_an_from') }}">
                            @if($errors->has('working_an_from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('working_an_from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.working_an_from_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="working_an_to">{{ trans('cruds.category.fields.working_an_to') }}</label>
                            <input class="form-control timepicker" type="text" name="working_an_to" id="working_an_to" value="{{ old('working_an_to') }}">
                            @if($errors->has('working_an_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('working_an_to') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection