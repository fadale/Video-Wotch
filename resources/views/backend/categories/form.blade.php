 {{ csrf_field() }}
 @php
 $inputName = "name";
 $inputMetaDesc="meta_des";
 $inputMetaKeyword="meta_keyword";
 @endphp
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Name</label>
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
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Meta Description</label>
                    <textarea name="{{$inputMetaDesc}}" id="" cols="30" rows="10"
                              required class="form-control @error($inputMetaDesc) is-invalid @enderror">
                        {{isset($row)?$row->$inputMetaDesc:''}}</textarea>
                  @error('$inputMetaDesc')
                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                  @enderror
                </div>
              </div>
            </div>