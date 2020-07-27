<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Users\Update;
use App\User;
use Illuminate\Support\Str;
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
        $requestArray=[
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'group'=>$request->group
        ];
        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=time().Str::random('10').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$fileName);
            $requestArray=$requestArray+['image'=>$fileName];
        }
        $users = User::all();
        $arry=[];
        foreach ($users as $user) {
            if (request()->get('email') != $user->email) {
               $requestArray=$requestArray+['email'=>$request->email];
            }else{
                $arry['email'] = "the Email is Used";
            }
        }
        if (empty($arry)) {
            $this->model->create($requestArray);
        }else{
            alert()->message('The Email is Used Please Try!')->autoclose(5000);
        }
        return redirect()->route('users.index');
    }

    public function update($id,Request $request){
        $user= $this->model->findOrFail($id);
        $RequestArray=[
            'name'=>$request->name
        ];
        if ($user->email == $request->email)
            $RequestArray = $RequestArray + ['email'=>$request->email];

        if(request()->has('password') && request()->get('password')!='')
            $RequestArray =$RequestArray+['password'=>Hash::make($request->password),];


        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=time().Str::random('10').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$fileName);
            $RequestArray=['image'=>$fileName]+$RequestArray;
        }
        $user->update($RequestArray);

        return redirect()->route('users.index');

    }
}
