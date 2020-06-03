@extends('backend.layout.app')
@section('title')
  {{$modelName}}
@endsection

@section('content')
@component('backend.layout.header')
@slot('nav_title')
{{$pageTitle}}
@endslot
@endcomponent
@component('backend.shared.edit',['pageTitle'=>$pageTitle,'pageDes'=>$pageDes])
          <form action="{{route($routeName.'.update',[$row->id])}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
           @include('backend.'.$folderName.'.form')
            <button type="submit" class="btn btn-primary pull-right">Update {{$modelName}}</button>
            <div class="clearfix"></div>
          </form>
         @slot('md4')
             @php $url=getYoutubeId($row->youtube) @endphp
             @if($url)
             <iframe width="300"src="https://www.youtube.com/embed/{{$url}}" frameborder="0" allowfullscreen></iframe>
                @endif
             <img src="{{url('uploads/'.$row->image)}}" width="250">
         @endslot
      @endcomponent

@component('backend.shared.edit',['pageTitle'=>'Comments','pageDes'=>'Her we can comments'])

    @include('backend.comments.index')
    @slot('md4')
        @include('backend.comments.create')
    @endslot
@endcomponent

@endsection
