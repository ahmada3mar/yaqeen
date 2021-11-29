@extends('admin.layout')
    @section('content')

<div class="container">
        <div class="card">
            <div class="card-header card-title-dark">
                <h5 class="card-title text-right">اصدار عقد اشتراك مساعدة على الطريق</h5>
            </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('store-vip') }}">
                @csrf
                <div class="form-group row">
                    <label class="control-label col-3" for="first-name">الاسم <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" name="name" value="{{ old('name') }}"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="mobile">رقم الهاتف <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" name="mobile" value="{{ old('mobile') }}"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('mobile'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="car_type">نوع المركبة<span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" value="{{ old('car_type') }}" name="car_type"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('car_type'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('car_type') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="car_model">سنة الصنع<span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" value="{{ old('car_model') }}"  name="car_model"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('car_model'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('car_model') }}</strong>
                    </span>
                @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">اللون</label>
                    <div class="col-9">
                    <input value="{{ old('color') }}"  class="form-control col-md-7 col-xs-12" type="text" name="color">
                    @if ($errors->has('color'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('color') }}</strong>
                    </span>
                @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">رقم اللوحة</label>
                    <div class="col-9">
                    <input value="{{ old('car_number') }}"  class="form-control col-md-7 col-xs-12" type="text" name="car_number">
                    @if ($errors->has('car_number'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('car_number') }}</strong>
                    </span>
                @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="last-name">تاريخ انتهاء التأمين<span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" value="{{ old('end_at') }}"  name="end_at"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('end_at'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('end_at') }}</strong>
                    </span>
                @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">نوع التأمين</label>
                    <div class="col-9">
                        <select name="inssurance_type" class="form-control col-7">
                            <option>خسارة كلية</option>
                            <option>شامل</option>
                          </select>
                          @if ($errors->has('inssurance_type'))
                          <span class="text-danger">
                              <strong>{{ $errors->first('inssurance_type') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="control-label col-3" for="last-name">القسط<span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" value="{{ old('price') }}"  name="price"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('price'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
                    </div>
                </div>


                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-9 col-md-offset-3">
                        <button type="submit" class="btn btn-success">اضافة</button>
                        <button class="btn btn-primary" type="reset">افراغ الحقول</button>
                        <a class="btn btn-primary" href="{{ route('vip') }}">الغاء</a>
                    </div>
                </div>

            </form>
            </div>
        </div>
</div>
    @endsection
