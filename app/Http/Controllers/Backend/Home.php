<?php

namespace App\Http\Controllers\BackEnd;
use App\Models\Comment;
use App\User;

class Home extends BackEndController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    public function index(){
        $comments = Comment::with('user','video')->orderBy('id','desc')->paginate(10);


        return view('backend.home',compact('comments'));
    }
}
