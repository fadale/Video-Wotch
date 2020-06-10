<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Requests\Backend\Comments\store;
use App\Models\Comment;

trait  CommentTrait{

    public function commentStore(store $request){

        $requestArray=$request->all()+['user_id'=>auth()->user()->id];
        Comment::create($requestArray);

        return redirect()->route('videos.edit',['id'=>$requestArray['video_id'],'#comments']);

    }
    public function commentDelete($id){

        $request=Comment::findOrFail($id);
        $request->delete();

        return redirect()->route('videos.edit',['id'=>$request->video_id,'#comments']);

    }
    public function commentUpdate($id,Store $request){

        $row=Comment::findOrFail($id);
        $row->update($request->all());
        return redirect()->route('videos.edit',['id'=>$row->video_id,'#comments']);

    }
}
