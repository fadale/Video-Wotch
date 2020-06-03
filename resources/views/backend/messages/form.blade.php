 {{ csrf_field() }}
 @php
 $inputName = "name";
 $inputEmail="email";
 $inputMessage="message";
 @endphp
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">User Name</label>
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
                  <label class="bmd-label-floating">Email</label>
                    <input type="email" name="{{$inputEmail}}" required value="{{isset($row)?$row->$inputEmail:''}}"
                           class="form-control @error($inputEmail) is-invalid @enderror">
                  @error($inputEmail)
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
                        <label class="bmd-label-floating">Message</label>
                        <textarea name="{{$inputMessage}}" id="" cols="30" rows="5"
                                  required class="form-control @error($inputMessage) is-invalid @enderror">
                        {{isset($row)?$row-> $inputMessage:''}}</textarea>
                        @error(' $inputMessage')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

            </div>
