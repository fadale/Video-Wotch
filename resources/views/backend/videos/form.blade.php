 {{ csrf_field() }}
 @php
 $inputName = "name";
 $inputDes="des";
 $inputMetaDesc="meta_des";
 $inputMetaKeyword="meta_keyword";
 $inputYoutube="youtube";
 $inputPublished="published";
 $inputCategories ="cat_id";
 @endphp
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Video Name</label>
                <input type="text" name="{{$inputName}}" required value="{{isset($row)?$row->$inputName:''}}"
                       class="form-control @error($inputName) is-invalid @enderror">
                  @error('$inputName')
                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Meta Keywords</label>
                    <input type="text" name="{{$inputMetaKeyword}}" required value="{{isset($row)?$row->$inputMetaKeyword:''}}"
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
         <input type="url" name="{{$inputYoutube}}" required value="{{isset($row)?$row->$inputYoutube:''}}"
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
                    <div class="mb-2">
                        <label>Youtube image</label>
                        <input class="" type="file" name="{{$input}}">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Published</label>
                        <select name="{{$inputPublished}}" class="form-control @error($inputYoutube) is-invalid @enderror">
                            <option class="text-dark"
                                    value="1"{{isset($row)&&$row->{$inputPublished}==1?'selected':''}}>Publish</option>
                            <option class="text-dark"
                                    value="0"{{isset($row)&&$row->{$inputPublished}==0?'selected':''}}>UnPublish</option>
                        </select>
                        @error($inputYoutube)
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
                                    {{isset($row)&&$row->{$inputCategories} == $category->id?'selected':''}}>
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
            <div class="row">
              <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Page Description</label>
                        <textarea name="{{$inputDes}}" id="" cols="30" rows="5"
                                  required class="form-control @error($inputDes) is-invalid @enderror">
                        {{isset($row)?$row->$inputDes:''}}</textarea>
                        @error('$inputMetaDesc')
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
                        {{isset($row)?$row->$inputMetaDesc:''}}</textarea>
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