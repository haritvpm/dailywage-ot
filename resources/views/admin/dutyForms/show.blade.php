@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
        <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.duty-forms.download') }}">
                Download
            </a>
            <a class="ml-1 btn btn-danger" href="{{ route('admin.duty-forms.download2') }}">
                Download (Original)
            </a>
        </div>
    </div>
            <router-view :session='{{$active_session}}' :isadmin ='true' :user='{{Auth::user()->name}}' :user_id='{{Auth::id()}}'/>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
  
</script>
<script src="{{ mix('js/app.js') }}"></script>

@endsection