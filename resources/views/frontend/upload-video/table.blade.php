<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-header card-header-primary">
                    <h4 class="card-title mt-0">Video Chanel</h4>
                    <p class="card-category"> Here is an All Video by your Chanel</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="">
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Published
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Upload Date
                                </th>
                                <th>
                                    Control
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $video)
                            <tr>
                                <td>{{$video->id}}</td>
                                <td> <img src="{{url('uploads/'.$video->image)}}" width="100px"></td>
                                <td>{{$video->name}}</td>
                                <td>@if($video->published == 1)<span class="text-info font-weight-bolder">Published</span> @else <span class="text-danger font-weight-bolder">UnPublished </span> @endif</td>
                                <td>{{$video->cat->name}}</td>
                                <td>
                                    {{$video->created_at->format('D/M/Y')}}</td>
                                <td class="td-actions text-right">
                                    <a href="{{route('video-upload.edit',[$video->id])}}"
                                       rel="tooltip" title="" class="btn btn-white btn-link btn-sm"
                                       data-original-title="Edit Video">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form action="{{route('video-upload.destroy',[$video->id])}}" method="post">
                                        {{ csrf_field() }}
                                        @method('delete')
                                        <button type="submit" rel="tooltip" title="" class="btn btn-white btn-link btn-sm">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
