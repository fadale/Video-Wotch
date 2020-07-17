@extends('layouts.app')
@section('title',$user->name)
@section('content')
    <div class="section section-buttons">
        <div class="section profile-content" style="margin-top: 100px">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center">
                     <div class="card card-profile border-dark mt-0 shadow-lg" >
                         <div class="avatar card-header bg-white border-bottom-0">
                        <img src="{{url('uploads/'.$user->image)}}" alt="Circle Image" class="shadow-lg w-50 h-50 img-circle img-no-padding img-responsive">
                         </div>
                         <div class="name card-body">
                        <h4 class="title mb-2">{{$user->name}}
                            <br>
                        </h4>
                        <h6 class="description">{{$user->email}}</h6>
                    </div>
                         @if(auth()->user() && $user->id==auth()->user()->id)
                             <a href=""  onclick="$('.cardedit').slideToggle(1000); return false;" class="btn btn-outline-default btn-round ml-auto mr-auto mb-2 mt-2">
                                 <i class="fa fa-cog"></i> Settings</a>

                     </div>
                        </div>
                    <div class="col-md-8">
                        @include('frontend.profile.edit')
                    </div>
                </div>

                         @endif
            </div>
        </div>
        @if(!empty($videos))
        @include('frontend.upload-video.table')
            @endif
    </div>
@endsection
