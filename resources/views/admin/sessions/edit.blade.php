@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.session.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sessions.update", [$session->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.session.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $session->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assembly">{{ trans('cruds.session.fields.assembly') }}</label>
                <input class="form-control {{ $errors->has('assembly') ? 'is-invalid' : '' }}" type="number" name="assembly" id="assembly" value="{{ old('assembly', $session->assembly) }}" step="1">
                @if($errors->has('assembly'))
                    <span class="text-danger">{{ $errors->first('assembly') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.assembly_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="session">{{ trans('cruds.session.fields.session') }}</label>
                <input class="form-control {{ $errors->has('session') ? 'is-invalid' : '' }}" type="number" name="session" id="session" value="{{ old('session', $session->session) }}" step="1">
                @if($errors->has('session'))
                    <span class="text-danger">{{ $errors->first('session') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.session_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.session.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Session::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $session->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.status_helper') }}</span>
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