@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('duty_form_create')
              
             
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.dutyForm.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">

              
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ mix('js/app.js') }}"></script>

@endsection