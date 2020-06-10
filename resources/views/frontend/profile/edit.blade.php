<div class="card card-nav-tabs mt-lg-5" style="display: none">
    <div class="card-header card-header-success">
        Update User
    </div>
    <div class="card-body">

            <form action="{{route('profile.update',[$user->id])}}" method="post">
                @csrf
                <div class="row">
                    @php $input="name"; @endphp
                    <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Username</label>
                            <input type="text" name="{{$input}}" required value="{{isset($user)?$user->$input:''}}"
                                   class="form-control @error($input) is-invalid @enderror">
                            @error('$input')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        @php $input="email"; @endphp
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Email address</label>
                            <input type="email" name="{{$input}}" required value="{{isset($user)?$user->$input:''}}"
                                   class="form-control @error($input) is-invalid @enderror">
                            @error($input)
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php $input="password"; @endphp
                    <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Password</label>
                            <input type="password" name="{{$input}}"  class="form-control @error('$input') is-invalid @enderror">
                            @error('$input')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-auto mb-auto text-center">

                        <button type="submit" class="btn btn-primary pull-center">Update</button>
                        <div class="clearfix"></div>
                    </div>
                </div>


            </form>

    </div>
</div>

