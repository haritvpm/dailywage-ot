@extends('layouts.admin')

@section('content')
    <h3 class="page-title">@lang('cruds.routing.title')</h3>
    
    <form method="POST" action="{{ route('admin.routings.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="panel-heading">
            @lang('global.create')
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">

                    <label for="user_id">{{ trans('cruds.routing.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>

                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="route">{{ trans('cruds.routing.fields.route') }}</label>
                <input class="form-control {{ $errors->has('route') ? 'is-invalid' : '' }}" type="text" name="route" id="route" value="{{ old('route', '') }}">
            
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                       <label for="last_forwarded_to">{{ trans('cruds.routing.fields.last_forwarded_to') }}</label>
                <input class="form-control {{ $errors->has('last_forwarded_to') ? 'is-invalid' : '' }}" type="text" name="last_forwarded_to" id="last_forwarded_to" value="{{ old('last_forwarded_to', '') }}">
            
                 
                </div>
            </div>
            
        </div>
    </div>
    <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
    </form>
@endsection

