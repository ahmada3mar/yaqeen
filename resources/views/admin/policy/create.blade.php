@extends('admin.layout')
    @section('content')

<div class="container">
        <div class="card">
            <div class="card-header card-title-dark">
                <h5 class="card-title text-right">أضافة بوليصة</h5>
            </div>
        <div class="card-body p-4">
            <form  action="{{ route('store-branches') }}">
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">على حســـاب</label>
                    <div class="col-md-6 col-xs-12">
                        <select class="form-control ">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                    </div>
                    @if ($errors->has('total_los_pickups'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('total_los_pickups') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="first-name">الاسم <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-xs-12">
                        <input type="text" name="name" value="{{ old('name') }}"  class="form-control">
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="last-name">نوع التأمين<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-xs-12">
                        <div class="custom-control-inline custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                            <label for="customRadio1" class="custom-control-label">خسارة كلية</label>
                        </div>
                        <div class="custom-control-inline custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                            <label for="customRadio2" class="custom-control-label">شامــل</label>
                        </div>

                    </div>
                    @if ($errors->has('total_los_cars'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('total_los_cars') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="last-name">قيمة التعويض<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-xs-12">
                    <input type="text" disabled value="{{ old('total_los_cars_accedint') ?? '3000' }}"  name="total_los_cars_accedint"  class="form-control">
                    </div>
                    @if ($errors->has('total_los_cars_accedint'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('total_los_cars_accedint') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">نوع الهيكل</label>
                    <div class="col-md-6 col-xs-12">
                        <select class="form-control">
                          <option>صــــالون</option>
                          <option>شــــحن</option>
                          <option>نـــقل مشترك</option>
                        </select>
                    </div>
                    @if ($errors->has('total_los_pickups'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('total_los_pickups') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">
                        رقم اللوحة
                        </label>
                    <div class="col-md-6 col-xs-12">
                    <input value="{{ old('total_los_vans') }}"  class="form-control" type="text" name="total_los_vans">
                    </div>
                    @if ($errors->has('total_los_vans'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('total_los_vans') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">نوع المركبة</label>
                    <div class="col-md-6 col-xs-12">
                        <select class="form-control ">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                    </div>
                    @if ($errors->has('total_los_pickups'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('total_los_pickups') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">سنة الصنع</label>
                    <div class="col-md-6 col-xs-12">
                        <input value="{{ old('full_cover_cars') }}" class="form-control" type="text" name="full_cover_cars">
                    </div>
                    @if ($errors->has('full_cover_cars'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_cars') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">رقم الشاصــي</label>
                    <div class="col-md-6 col-xs-12">
                    <input value="{{ old('full_cover_cars_per_k') }}" class="form-control" type="text" name="full_cover_cars_per_k">
                    </div>
                    @if ($errors->has('full_cover_cars_per_k'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_cars_per_k') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">رقم المــحرك</label>
                    <div class="col-md-6 col-xs-12">
                    <input value="{{ old('full_cover_vans') }}" class="form-control" type="text" name="full_cover_vans">
                    </div>
                    @if ($errors->has('full_cover_vans'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_vans') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">المـــدة</label>
                    <div class="row pl-0 col-md-6 col-xs-12">
                            <label for="middle-name" class="col-2">من</label>
                            <input value="1996-12-15" aria-placeholder="dd-mm-yyyy" class="form-control col-md-4 col-xs-12" type="date" max="2030-12-31" name="full_cover_vans_per_k">

                            <label for="middle-name" class=" col-2 text-center">الى</label>
                            <input data-date-format="mm/dd/yy" value="{{ old('full_cover_vans_per_k') }}" class="form-control col-md-4 col-xs-12 datepicker" type="date" name="full_cover_vans_per_k">
                    </div>
                    @if ($errors->has('full_cover_vans_per_k'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_vans_per_k') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">رقم العقد</label>
                    <div class="row pl-0 col-md-6 col-xs-12">
                            <div class="col-4">
                                <input value="{{ old('full_cover_pickups') ?? 2021 }}" class="form-control col-12" type="text" name="full_cover_pickups">
                            </div>
                            <div class="col-8 pl-0">
                                <input value="{{ old('full_cover_pickups') }}" class="form-control col-12" type="text" name="full_cover_pickups">
                            </div>
                    </div>
                    @if ($errors->has('full_cover_pickups'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_pickups') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">سعر البـــيع</label>
                    <div class="col-md-6 col-xs-12">
                        <input value="{{ old('full_cover_pickups_per_k') }}" class="form-control " type="text" name="full_cover_pickups_per_k">
                    </div>
                    @if ($errors->has('full_cover_pickups_per_k'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('full_cover_pickups_per_k') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">اضافة</button>
                        <button class="btn btn-primary" type="reset">افراغ الحقول</button>
                        <a class="btn btn-primary" href="{{ route('branches') }}">الغاء</a>
                    </div>
                </div>

            </form>
            </div>
        </div>
</div>
    @endsection
