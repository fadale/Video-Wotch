<?php

namespace App\Http\Controllers;


use App\Http\Requests\FrontEnd\Messages\Store;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Page;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('commentUpdate','commentStore','profileUpdate');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $videos = Video::published()->orderBy('id','desc');
        if(request()->has('search')&&request()->get('search')!=''){
            $videos = $videos->where('name','like','%'.request()->get('search').'%');
        }
        $videos = $videos->paginate(30);
        return view('home',compact('videos'));
    }
    public function category($id)
    {
        $cat= Category::findOrFail($id);
        $videos = Video::published()->where('cat_id',$id)->orderBy('id','desc')->paginate(30);
        return view('frontend.category.index',compact('videos','cat'));
    }
    public function video($id)
    {
        $video= Video::published()->with('skills','tags','cat','user','comments.user')->findOrFail($id);
        return view('frontend.video.index',compact('video'));
    }

    public function skill($id)
    {
        $skill= Skill::findOrFail($id);
        $videos = Video::published()->whereHas('skills',function($query)use($id){
            $query->where('skill_id',$id);
        })->orderBy('id','desc')->paginate(30);
        return view('frontend.skill.index',compact('videos','skill'));
    }
    public function tags($id)
    {
        $tag= Skill::findOrFail($id);
        $videos = Video::published()->whereHas('tags',function($query)use($id){
            $query->where('tag_id',$id);
        })->orderBy('id','desc')->paginate(30);
        return view('frontend.tag.index',compact('videos','tag'));
    }

    public function commentUpdate($id,Store $request){
            $comment=Comment::findOrFail($id);
            if(($comment->user_id ==auth()->user()->id)|| auth()->user()->group =='admin'){
                $comment->update(['comment'=>$request->comment]);
            }

            return redirect()->route('frontend.video',['id'=>$comment->video_id,'#comment']);
    }
    public function commentStore($id,Store $request){
        $video=Video::published()->findOrFail($id);
        Comment::create([
            'user_id'=>auth()->user()->id,
            'video_id'=>$video->id,
            'comment'=>$request->comment
        ]);

        return redirect()->route('frontend.video',['id'=>$video->id,'#comment']);
    }
    public function messageStore(Store $request)
    {
        Message::create($request->all());
        alert()->message('You Message have been saved ,we will can you in 24 hour')->autoclose(2000);
        return redirect()->route('frontend.landing');
    }
    public function welcome(){
        $videos = Video::published()->orderBy('id','desc')->paginate(9);
        $videos_count = Video::published()->count();
        $comments_count=Comment::count();
        $tags_count=Tag::count();
        return view('welcome',compact('videos','videos_count','comments_count','tags_count'));
    }
    public  function  page($id,$slug=null){
        $page = Page::findOrFail($id);
        return view('frontend.page.index',compact('page'));
    }
    public  function  profile($id,$slug=null){
        $user = User::findOrFail($id);
        return view('frontend.profile.index',compact('user'));
    }

    public function profileUpdate(\App\Http\Requests\FrontEnd\Users\Store $request){
        $user=User::findOrFail(auth()->user()->id);
        $arry=[];
        if($request->email != $user->email){
            $email = User::where('email',$request->email)->first();
            if ($email == null){
                $arry['email']=$request->email;
            }
        }
        if($request->name != $user->name){
            $email = User::where('name',$request->name);
                $arry['name']=$request->name;
        }
        if($request->password != ''){

            $arry['password']=$request->password;
        }
        if (!empty($arry)){
            $user->update($arry);
        }
        alert()->message('You Profile have been saved')->autoclose(2000);
        return redirect()->route('front.profile',[$user->id,slug($user->name)]);

    }


}
