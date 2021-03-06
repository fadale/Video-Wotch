<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\Pages\Store;
use App\Models\Page;

class Pages extends BackEndController
{
    public function __construct(Page $model)
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
        $rows= $this->model->findOrFail($id);

        $rows->update($request->all());

        return redirect()->route('pages.index',['id'=>$rows->id]);

    }
}
