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
   @include('backend.home-sections.statics')
  @include('backend.home-sections.latest-comment')
@endsection

@push('js')
    @endpush
