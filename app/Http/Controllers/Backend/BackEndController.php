<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class BackEndController extends Controller
{
    protected $model;
    protected $modelName;
    protected $pageTitle;
    protected $pageDes;


    public function __construct(Model $model){
        $this->model=$model;
    }

    public function index(){
        $rows =$this->model;
        $rows=$this->filter($rows);
        $with = $this->with();
        if(!empty($with)){
            $rows=$rows->with($with);
        }
        $rows=$rows->paginate(10);
        $modelName=$this->pluralModelName();
        $smodelName=$this->getModelName();
        $routeName=$this->getClassNameFromModel();
        $pageTitle="Control ".$modelName;
        $pageDes="Here you add / edit / delete ".$modelName;

        return view('backend.'.$this->getClassNameFromModel().'.index',
            compact('rows',
                'modelName',
                'smodelName',
                'pageTitle',
                'pageDes',
                'routeName'
            ));
    }
    public function create(){
        $modelName=$this->getModelName();
        $pageTitle="Create ".$modelName;
        $pageDes="Here you can create ".$modelName;
        $folderName=$this->getClassNameFromModel();
        $routeName=$folderName;
        $append = $this->append();
        return view('backend.'.$folderName.'.create'
            ,compact(
                'modelName','pageTitle','pageDes','folderName','routeName'
                ))->with($append);
    }
    public function edit($id){
        $row= $this->model->findOrFail($id);
        $modelName=$this->getModelName();
        $pageTitle="Edit ".$modelName;
        $pageDes="Here you can Edit ".$modelName;
        $folderName=$this->getClassNameFromModel();
        $routeName= $folderName;
        $append = $this->append();
        return  view('backend.'.$folderName.'.edit',compact('row',
            'pageTitle','pageDes','modelName','folderName','routeName'))->with($append);

    }
    public function destroy($id){
         $this->model->findOrFail($id)->delete();
        $modelName=$this->getModelName();
        if($modelName == 'Video'){
            $requesat = Comment::where('video_id',$id);
                $requesat->delete();
        }
        return redirect()->route($this->getClassNameFromModel().'.index');
    }
    protected function filter($rows){
        return $rows;
    }

    protected function with(){
        return[];
    }
    protected function getClassNameFromModel(){
        return Str::lower($this->pluralModelName());
    }

    protected function pluralModelName(){
        return Str::plural($this->getModelName());
    }
    protected function getModelName()
    {
        return class_basename($this->model);
    }
    protected function append(){
        return[];
    }
}
