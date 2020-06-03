 {{ csrf_field() }}
 @php
 $inputName = "name";

 @endphp
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Tag Name</label>
                <input type="text" name="{{$inputName}}" required value="{{isset($row)?$row->$inputName:''}}"
                       class="form-control @error($inputName) is-invalid @enderror">
                  @error('$inputName')
                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                  @enderror
                </div>
              </div>
            </div>
