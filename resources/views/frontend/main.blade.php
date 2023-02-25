@extends('layouts.frontend')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <router-view :session={{$session}} />
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    var session = {{ Js::from($session) }};

</script>
<script src="{{ mix('js/app.js') }}"></script>

@endsection