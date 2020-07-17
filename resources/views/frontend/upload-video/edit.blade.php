@extends('layouts.app')
@section('title','Edit Video')
@section('content')
    <div class="section section-buttons">
        <div class="section profile-content" style="margin-top: 150px">
            <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Upload Video</h4>
                                    <p class="card-category">Upload Video form your Chanel</p>
                                </div>
                                <div class="card-body">
                                    @include("frontend.upload-video.form")
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
