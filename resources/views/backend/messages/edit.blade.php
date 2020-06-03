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
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">{{$pageTitle}}</h4>
          <p class="card-category">{{$pageDes}}</p>
        </div>
        <div class="card-body">

           @include('backend.'.$folderName.'.form')
        </div>
      </div>
    </div>

  </div>
@endsection
