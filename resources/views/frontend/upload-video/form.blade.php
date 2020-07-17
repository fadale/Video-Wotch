<form action="{{route('frontVideo.Update',[$video->id])}}" method="POST"enctype="multipart/form-data">
    @csrf
    {{method_field('POST')}}
    @php

        $inputMetaDesc="meta_des";
        $inputMetaKeyword="meta_keyword";
        $inputYoutube="youtube";
        $inputCategories ="cat_id";
    @endphp
    @php $input="name"; @endphp
    <div class="row">
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Video Name</label>
                <input type="text" name="{{$input}}" required value="{{isset($video)?$video->$input:''}}"
                       class="form-control @error($input) is-invalid @enderror">
                @error('$input')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Meta Keywords</label>
                <input type="text" name="{{$inputMetaKeyword}}" required value="{{isset($video)?$video->$inputMetaKeyword:''}}"
                       class="form-control @error($inputMetaKeyword) is-invalid @enderror">
                @error($inputMetaKeyword)
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Youtube url</label>
                <input type="url" name="{{$inputYoutube}}" required value="{{isset($video)?$video->$inputYoutube:''}}"
                       class="form-control @error($inputYoutube) is-invalid @enderror">
                @error($inputYoutube)
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>
        @php $input="image";@endphp
        <div class="col-md-6">
            <label>Youtube image</label>
            <div class="custom-file">

                <input type="file" class="custom-file-input" name="{{$input}}" id="customFile">
                <label class="custom-file-label" for="customFile">Choose image</label>
                @error($input)
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Categories</label>

                <select name="{{$inputCategories}}" class="form-control @error($inputCategories) is-invalid @enderror">
                    @foreach($categories as $category):

                    <option class="text-dark"
                            value="{{$category->id}}"
                        {{isset($video)&&$video->{$inputCategories} == $category->id?'selected':''}}>
                        {{$category->name}}</option>

                    @endforeach
                </select>
                @error($inputCategories)
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
    </div>
    @php  $input="des"; @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Page Description</label>
                <textarea name="{{$input}}" id="" cols="30" rows="5"
                          required class="form-control @error($input) is-invalid @enderror">
                        {{isset($video)?$video->$input:''}}</textarea>
                @error('$input')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Meta Description</label>
                <textarea name="{{$inputMetaDesc}}" id="" cols="30" rows="2"
                          required class="form-control @error($inputMetaDesc) is-invalid @enderror">
                        {{isset($video)?$video->$inputMetaDesc:''}}</textarea>
                @error('$inputMetaDesc')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        @php $input="skills[]"; @endphp
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Skills</label>

                <select name="{{$input}}" class="form-control @error($input) is-invalid @enderror" multiple style="height: 100px">
                    @foreach($skills as $skill):

                    <option class="text-dark" value="{{$skill->id}}" {{in_array($skill->id,$selectedSkills)?'selected':''}}>
                        {{$skill->name}}
                    </option>

                    @endforeach
                </select>
                @error($input)
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        @php $input="tags[]"; @endphp
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Tags</label>

                <select name="{{$input}}" class="form-control @error($input) is-invalid @enderror" multiple style="height: 100px">
                    @foreach($tags as $tag):

                    <option class="text-dark" value="{{$tag->id}}" {{in_array($tag->id,$selectedTags)?'selected':''}}>
                        {{$tag->name}}
                    </option>

                    @endforeach
                </select>
                @error($input)
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary justify-content-center ml-auto mr-auto d-block">Update Video</button>
    <div class="clearfix"></div>
</form>
