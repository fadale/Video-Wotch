@extends('layouts.app')
@section('title',$video->name)
@section('meta_des',$video->meta_des)
@section('meta_keywords',$video->meta_keyword)
@section('content')
    <div class="section section-buttons">
        <div class="container">
            <div class="title">
                <h2>{{$video->name}}</h2>
            </div>
           <div class="row">
               <div class="col-md-12">
               @php $url=getYoutubeId($video->youtube) @endphp
               @if($url)
                   <iframe width="100%" height="500"  src="https://www.youtube.com/embed/{{$url}}" frameborder="0" allowfullscreen></iframe>
               @endif
               </div>
           </div>
            <div class="row">
                <div class="col-md-12">
                    <p>{{$video->user->name}}</p>
                    <p>{{$video->created_at}}</p>
                    <p>{{$video->des}}</p>
                    <p>
                        Category:

                            <a href="{{route('front.category',['id'=>$video->cat->id])}}">
                                {{$video->cat->name}}
                            </a>

                    </p>
                    <p>
                        Tags:
                        @foreach($video->tags as $tag)
                            <a href="{{route('front.tags',['id'=>$tag->id])}}"
                               class="badge badge-pill badge-info">{{$tag->name}}</a>
                            @endforeach
                    </p>
                    <p>
                        Skills:
                        @foreach($video->skills as $skill)
                            <a href="{{route('front.skill',['id'=>$skill->id])}}"
                               class="badge badge-pill badge-primary">{{$skill->name}}</a>
                        @endforeach
                    </p>
                </div>
            </div>

         @include('frontend.shared.comment-show')

           @include('frontend.shared.comment-form')
        </div>
    </div>
@endsection
