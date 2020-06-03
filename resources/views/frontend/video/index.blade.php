@extends('layouts.app')
@section('title',$video->name)
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

            <div class="row" id="comment">
                <div class="col-md-12">
                        <div class="card text-left">
                            <div class="card-header card-header-rose">
                                @php $comments=$video->comments; @endphp
                                <h5>Comments {{count($comments)}}</h5>
                            </div>
                            <div class="card-body">
                                @foreach($comments as $comment)
                                    <div class="row">
                                        <div class="col-md-8"><i class="nc-icon nc-chat-33"></i> :{{$comment->user->name}}</div>
                                        <div class="col-md-4 text-right">
                                            <i class="nc-icon nc-calendar-60"></i> :{{$comment->user->created_at}} |

                                        </div>
                                    </div>


                                <p class="card-text"> {{$comment->comment}}</p>
                                @if(auth()->user())
                                    @if((auth()->user()->group == 'admin') || auth()->user()->id==$comment->user->id)
                                        <a href="" onclick="$(this).next('div').slideToggle(1000); return false;">Edit</a>
                                        <div style="display: none">
                                            <form action="{{route('front.commentUpdate',['id'=>$comment->id])}}" method="post">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                <textarea class="form-control mb-2" name="comment" rows="4">{{$comment->comment}}</textarea>
                                                </div>
                                                    <button type="submit" class="btn btn-primary">Edit</button>


                                            </form>
                                        </div>
                                    @endif
                                    @endif
                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>

            <div class="row-cols-6">
               @if(auth()->user())
            <form action="{{route('front.commentStore',['id'=>$video->id])}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">Add Comment</label>
                    <textarea class="form-control mb-2" name="comment" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Add</button>
            </form>
                   @endif
            </div>
        </div>
    </div>
@endsection
