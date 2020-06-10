@extends('layouts.app')
@section('title',$cat->name)
@section('meta_des',$cat->meta_des)
@section('meta_keywords',$cat->meta_keywords)
@section('content')
    <div class="section section-buttons">
        <div class="container">
            <div class="title">
                <h2>{{$cat->name}}</h2>
            </div>
            @include('frontend.shared.video-row')
        </div>
    </div>
@endsection
