@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.session.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.sessions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.session.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.session.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="assembly">{{ trans('cruds.session.fields.assembly') }}</label>
                            <input class="form-control" type="number" name="assembly" id="assembly" value="{{ old('assembly', '') }}" step="1">
                            @if($errors->has('assembly'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assembly') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.session.fields.assembly_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="session">{{ trans('cruds.session.fields.session') }}</label>
                            <input class="form-control" type="number" name="session" id="session" value="{{ old('session', '') }}" step="1">
                            @if($errors->has('session'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('session') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.session.fields.session_helper') }}</span>
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