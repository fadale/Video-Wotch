
 @php
 $inputName = "name";
 $inputEmail="email";
 $inputPassword="password";
 @endphp
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Username</label>
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
                  <label class="bmd-label-floating">Email address</label>
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
              <div class="col-md-6">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating">Password</label>
                  <input type="password" name="{{$inputPassword}}"  class="form-control @error('$inputPassword') is-invalid @enderror" required>
                  @error('$inputPassword')
                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                  @enderror
                </div>
              </div>
            </div>
@php $input="group"; @endphp
<div class="col-md-6">
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Published</label>
        <select name="{{$input}}" class="form-control @error($input) is-invalid @enderror">
            <option class="text-dark"
                    value="admin"{{isset($row)&&$row->{$input}=="admin"?'selected':''}}>Amin</option>
            <option class="text-dark"
                    value="user"{{isset($row)&&$row->{$input}=="user"?'selected':''}}>User</option>
        </select>
        @error($input)
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
