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
