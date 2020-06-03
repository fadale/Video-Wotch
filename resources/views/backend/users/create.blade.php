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

@component('backend.shared.create',['pageTitle'=>$pageTitle,'pageDes'=>$pageDes])
    <form action="{{route($routeName.'.store')}}" method="POST">
        @csrf
        @include('backend.'.$folderName.'.form')
        <button type="submit" class="btn btn-primary pull-right">Add {{$modelName}}</button>
        <div class="clearfix"></div>
    </form>
@endcomponent



@endsection
