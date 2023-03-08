@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <router-view :session='{{$active_session}}' isadmin ='true' :user='{{Auth::user()->name}}' :user_id='{{Auth::id()}}'/>
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