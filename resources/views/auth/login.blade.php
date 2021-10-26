@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row">
        <img src="/images/logo.png" class="mw-100 mx-auto" alt="">
    </div>
    <div style="max-width: 800px" class="card mx-auto">
        <div class="card-header card-title-dark">
            <h5 class="card-title text-right">تسجيل دخول</h5>
        </div>
        <div class="card-body p-4">
            <form  method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="form-group row">
                        <label class="control-label col-3" for="first-name">اسم المستخدم
                        </label>

                        <div class="col-9">
                            <div class="row">
                                <div class="col-md-7 col-xs-12">
                                <input type="text" name="username" value="{{ old('username') }}"  class="form-control ">
                            </div>
                                @if ($errors->has('username'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                         </div>

                    </div>

                    <div class="form-group row">
                        <label class="control-label col-3" for="first-name">كلمة المرور
                        </label>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-md-7 col-xs-12">
                                    <input type="password" name="password" value="{{ old('password') }}"  class="form-control ">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-9 col-md-offset-3">
                            <button type="submit" class="btn btn-success">تسجيل دخول</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
