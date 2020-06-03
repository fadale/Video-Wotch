<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\Videos\Store;
use App\Http\Requests\Backend\Videos\Update;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Support\Str;

class Videos extends BackEndController
{
    use CommentTrait;
    public function __construct(Video $model)
    {
        parent::__construct($model);
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

    protected function filter($rows){
        if(request()->has('name')&& request()->get('name')!=''){
            $rows =$rows->where('name',request()->get('name'));
        }
        return $rows;
    }

    public function store(Store $request){
        $file=$request->file('image');
        $fileName=time().Str::random('10').'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'),$fileName);
        $requestArray=['user_id'=>auth()->user()->id,'image'=>$fileName]+$request->all();
        $rows = $this->model->create($requestArray);
        $this->syncTagsSkills($rows,$requestArray);

        return redirect()->route('videos.index');

    }

    public function update($id,Update $request){
        $requestArray=$request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=time().Str::random('10').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$fileName);
            $requestArray=['image'=>$fileName]+$requestArray;
        }
        $rows= $this->model->findOrFail($id);

        $rows->update($requestArray);
        $this->syncTagsSkills($rows,$requestArray);
        return redirect()->route('videos.index',['id'=>$rows->id]);
    }
    protected function syncTagsSkills($rows,$requestArray){
        if(isset($requestArray['skills'])&& !empty($requestArray['skills'])){
            $rows->skills()->sync($requestArray['skills']);
        }
        if(isset($requestArray['tags'])&& !empty($requestArray['tags'])){
            $rows->tags()->sync($requestArray['tags']);
        }

    }
}
