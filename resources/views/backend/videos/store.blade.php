@extends('backend.layout.app')
@section('title')
    store
@endsection

@section('content')
@component('backend.layout.header')
@slot('nav_title')
store
@endslot
@endcomponent
@endsection