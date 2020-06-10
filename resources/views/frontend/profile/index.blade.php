@extends('layouts.app')
@section('title',$user->name)
@section('content')
    <div class="section section-buttons">
        <div class="section profile-content" style="margin-top: 150px">
            <div class="container">
                <div class="owner">
                    <div class="avatar">
                        <img src="/frontend/img/faces/joe-gardner-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                    </div>
                    <div class="name">
                        <h4 class="title">{{$user->name}}
                            <br>
                        </h4>
                        <h6 class="description">{{$user->email}}</h6>
                    </div>
                </div>
                @if(auth()->user() && $user->id==auth()->user()->id)
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">
                        <a href=""  onclick="$('.card').slideToggle(1000); return false;" class="btn btn-outline-default btn-round"><i class="fa fa-cog"></i> Settings</a>
                    </div>
                </div>
                    @include('frontend.profile.edit')
                @endif
            </div>
        </div>
    </div>
@endsection
