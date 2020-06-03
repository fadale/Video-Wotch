@extends('layouts.app')
@section('title','Home')
<div class="page-header section-dark" style="background-image: url('frontend/img/antoine-barres.jpg')">
    <div class="filter"></div>
    <div class="content-center">
        <div class="container">
            <div class="title-brand">
                <h1 class="presentation-title">AWSAAL</h1>
                <div class="fog-low">
                    <img src="frontend/img/fog-low.png" alt="">
                </div>
                <div class="fog-low right">
                    <img src="frontend/img/fog-low.png" alt="">
                </div>
            </div>

        </div>
    </div>
    <div class="moving-clouds" style="background-image: url('frontend/img/clouds.png'); "></div>

</div>
@section('content')
    <div class="section section-buttons">
        <div class="container">
            <div class="title">
                <h2>Latest Videos</h2>
            </div>
            @include('frontend.shared.video-row')
    </div>
@endsection
