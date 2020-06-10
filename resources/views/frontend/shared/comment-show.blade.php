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
                        <div class="col-md-8"><i class="nc-icon nc-chat-33"></i> :
                            <a href="{{route('front.profile',[$comment->user->id,slug($comment->user->name)])}}">{{$comment->user->name}}
                            </a></div>
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
