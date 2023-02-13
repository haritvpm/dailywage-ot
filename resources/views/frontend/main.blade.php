@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <router-view />
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ mix('js/app.js') }}"></script>

@endsection