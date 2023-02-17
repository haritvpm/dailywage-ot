@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{$session}}</h2>
            <router-view />
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