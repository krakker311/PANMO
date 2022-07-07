@extends('layouts.main')

@section('container')
<div class="text-center mb-5 mt-5">
        <h1><strong> Hello {{Auth::User()->model->name}}</strong></h1>
        
        <input type="button" value="Track" onClick="track('{{Auth::User()->email}}')"/><br/>
    </div>
@yield('javascript')
<script type="text/javascript">
function track(value) {
    console.log(value);
    Android.track(value);
    }
</script>
@endsection