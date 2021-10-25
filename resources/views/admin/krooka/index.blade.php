@extends('admin.layout')
    @section('content')

<div class="container">
        <div class="card">
            <div class="card-header card-title-dark">
                <h5 class="card-title text-right">استعلام حوادث</h5>
            </div>
        <div class="card-body p-4">
            <form  action="{{ route('getkrooka') }}" method="post">
            @csrf
                <div class="form-group row">
                    <label class="control-label col-3" for="first-name">رقم التسجيل <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" name="name" value="{{ old('name') }}"  class="form-control col-md-7 col-xs-12">
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                @if($cc)
                    <div class="form-group row">
                        {!! $cc !!}
                    </div>
                @endif
                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-9 col-md-offset-3">
                        <button type="submit" class="btn btn-success">استعلام</button>
                        <button class="btn btn-primary" type="reset">افراغ الحقول</button>
                        <a class="btn btn-primary" href="{{ route('branches') }}">الغاء</a>
                    </div>
                </div>

            </form>
            </div>
        </div>
</div>
    @endsection
