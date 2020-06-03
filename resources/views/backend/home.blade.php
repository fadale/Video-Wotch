@extends('backend.layout.app')
@section('title')
    Home Page
@endsection

@push('css')
    <style>

    </style>
    @endpush
@section('content')
    @component('backend.layout.header')
        @slot('nav_title')
            Home Page
        @endslot
    @endcomponent
@endsection

@push('js')
    @endpush
