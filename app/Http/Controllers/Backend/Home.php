<?php

namespace App\Http\Controllers\BackEnd;

use App\User;

class Home extends BackEndController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    public function index(){
        return view('backend.home');
    }
}
