<div class="card" style="width: 20rem;">
    <img class="card-img-top" src="{{url('uploads/'.$video->image)}}" alt="Card image cap" style="max-height: 160px">
    <div class="card-body">
         <a href="{{route('frontend.video',['id'=>$video->id])}}" title="{{$video->name}}">

        <p class="card-text">{{$video->name}}</p>
             <span>{{$video->created_at}}</span>
         </a>
    </div>
</div>
