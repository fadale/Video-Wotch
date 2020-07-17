<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\Users\Store;
use App\Http\Requests\Backend\Users\Update;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Users extends BackEndController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    protected function filter($rows){
        if(request()->has('name')&& request()->get('name')!=''){
            $rows =$rows->where('name',request()->get('name'));
        }
        return $rows;
    }


    public function store(Request $request){
        $requestArray= $request->all();
        $requestArray['password'] =  Hash::make($requestArray['password']);
        $this->model->create($requestArray);
        return redirect()->route('users.index');
    }

    public function update($id,Update $request){
        $user= $this->model->findOrFail($id);
        $RequestArray=[
            'name'=>$request->name,
            'email'=>$request->email,
        ];
        if(request()->has('password') && request()->get('password')!='')
            $RequestArray =$RequestArray+['password'=>Hash::make($request->password),];

        $user->update($RequestArray);

        return redirect()->route('users.index');

    }
}
