<div class="row">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="card-header card-header-primary">
                <h4 class="card-title mt-0">Latest Comments</h4>
                <p class="card-category"> Here is you cat show latest comments and anther details</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="">
                        <tr><th>
                                ID
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Video
                            </th>
                            <th>
                                Comment
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Control
                            </th>
                        </tr></thead>
                        <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>
                                {{$comment->id}}
                            </td>
                            <td>
                                {{$comment->user->name}}
                            </td>
                            <td>

                                @if(empty($comment->video))
                               NO Video
                                    @else
                                    {{$comment->video->name}}
                                @endif
                            </td>
                            <td>
                                {{$comment->comment}}
                            </td>
                            <td>
                                {{$comment->created_at}}
                            </td>
                            <td>
                                <a href="{{route('comment.delete',[$comment->id])}}" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Remove Comment">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $comments->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
