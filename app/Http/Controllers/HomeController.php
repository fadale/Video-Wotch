<?php

namespace App\Http\Controllers;


use App\Http\Requests\FrontEnd\Messages\Store;
use App\Http\Requests\FrontEnd\Users\Update;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Page;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



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
        $videos = $videos->paginate(20);
        return view('home',compact('videos'));
    }
    public  function  profile($id,$slug=null){
        $user = User::findOrFail($id);
        $videos = Video::all()->where('user_id',$id);
        return view('frontend.profile.index',compact('user','videos'));
    }

    /**
     * The profileUpdate Function is not working fixed
     * @param $id
     * @param Update $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate($id ,Update $request){
        $user=User::findOrFail($id);
        $arry=[];
        $file=$request->file('image');
        $fileName=time().Str::random('10').'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'),$fileName);
        $requestArray=['user_id'=>auth()->user()->id,'image'=>$fileName]+$request->all();
        $arry['image']=$requestArray;

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
        if (!empty($arry)){
            $user->update($arry);
        }
        alert()->message('You Profile have been saved')->autoclose(2000);
        return redirect()->route('front.profile',[$user->id,slug($user->name)]);

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
    public function commentStore($id,\App\Http\Requests\FrontEnd\Comments\Store $request){
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

    protected function append()
    {
        $array= ['categories'=>Category::get(),
            'skills'=>Skill::get(),
            'tags'=>Tag::get(),
            'selectedSkills'=>[],
            'selectedTags'=>[],
            'comments'=>[]
        ];
        if(request()->route()->parameter('video')){
            $array['selectedSkills'] = $this->model->find(request()->route()->parameter('video'))->
            skills()->get()->pluck('id')->toArray();
        }
        if(request()->route()->parameter('video')){
            $array['selectedTags'] = $this->model->find(request()->route()->parameter('video'))->
            tags()->get()->pluck('id')->toArray();
        }
        if(request()->route()->parameter('video')){
            $array['comments'] = $this->model->find(request()->route()->parameter('video'))->
            comments()->orderby('id','desc')->with('user')->get();
        }
        return $array;
    }
    protected function syncTagsSkills($rows,$requestArray){
        if(isset($requestArray['skills'])&& !empty($requestArray['skills'])){
            $rows->skills()->sync($requestArray['skills']);
        }
        if(isset($requestArray['tags'])&& !empty($requestArray['tags'])){
            $rows->tags()->sync($requestArray['tags']);
        }

    }
    protected function with(){
        return[];
    }
    public function createUpload($id){
        $user = User::findOrFail($id);
        $append = $this->append();
        return view('frontend.upload-video.index',compact('user'))->with($append);
    }
    public function uploadStore(\App\Http\Requests\FrontEnd\Videos\Store $request){
        $file=$request->file('image');
        $fileName=time().Str::random('10').'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'),$fileName);
        $requestArray=['user_id'=>auth()->user()->id,'image'=>$fileName]+$request->all();
        $rows = Video::create($requestArray);
        $this->syncTagsSkills($rows,$requestArray);

        return redirect()->route('home');

    }
    public function videoUploadEdit($id){
        $video= Video::findOrFail($id);
        $append = $this->append();
        return  view('frontend.upload-video.edit',compact('video'))->with($append);
    }

    public function videoUploadUpdate($id,\App\Http\Requests\FrontEnd\Videos\Update $request){
        $requestArray=$request->all();

        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=time().Str::random('10').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$fileName);
            $requestArray=['image'=>$fileName]+$requestArray;
        }
        $rows= Video::findOrFail($id);
        $rows->update($requestArray);
        $this->syncTagsSkills($rows,$requestArray);
        $user = auth()->user();
        $videos = Video::all()->where('user_id',$user->id);
        return view('frontend.profile.index',compact('user','videos'));

    }
    public function videoUploadDelete($id,$slug=null){

        Video::findOrFail($id)->delete();
        $id= User::where('id',Auth::users()->id);
        $slug=User::where('name',Auth::users()->name);
        $modelName=Video::class;
        if($modelName == 'Video'){
            $requesat = Comment::where('video_id',$id);
            $requesat->delete();
        }
        return redirect()->route('front.profile',compact('id','slug'));

    }
}
