@extends('layouts.app')
@section('title','Home')
@section('pageheader')

   @include('frontend.homepage-sections.home-image')
   @include('frontend.homepage-sections.video-last')
   @include('frontend.homepage-sections.states')
   @include('frontend.homepage-sections.contact-us')

@endsection
