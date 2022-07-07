@extends('layouts.main')

@section('container')

<p> {{Auth::User()->model}}</p>
@endsection