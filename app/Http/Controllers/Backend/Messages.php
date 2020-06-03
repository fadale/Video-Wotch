<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\FrontEnd\Messages\Store;
use App\Models\Message;


class Messages extends BackEndController
{

    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
    protected function filter($rows){
        if(request()->has('name')&& request()->get('name')!=''){
            $rows =$rows->where('name',request()->get('name'));
        }
        return $rows;
    }

    public function store(Store $request){
        $this->model->create($request->all());
        return redirect()->route('pages.index');

    }

    public function update($id,Store $request){
        $rows= $this->model->FindOrFail($id);

        $rows->update($request->all());

        return redirect()->route('pages.index',['id'=>$rows->id]);

    }
}
