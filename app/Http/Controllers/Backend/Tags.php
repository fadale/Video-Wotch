<?php

namespace App\Http\Controllers\Backend;



use App\Http\Requests\Backend\Tags\Store;
use App\Models\Tag;

class Tags extends BackEndController
{
    public function __construct(Tag $model)
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
        return redirect()->route('tags.index');

    }

    public function update($id,Store $request){
        $rows= $this->model->findOrFail($id);

        $rows->update($request->all());

        return redirect()->route('tags.edit',['id'=>$rows->id]);

    }
}
