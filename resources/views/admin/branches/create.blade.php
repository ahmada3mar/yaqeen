@extends('admin.layout')
    @section('content')

<div class="container">
        <div class="card">
            <div class="card-header card-title-dark">
                <h5 class="card-title text-right">أضافة فرع</h5>
            </div>
        <div class="card-body p-4">
            <form  action="{{ route('store-branches') }}">
                <div class="form-group row">
                    <label class="control-label col-3" for="first-name">الاسم <span class="required">*</span>
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
                <div class="form-group row">
                    <label class="control-label col-3" for="last-name">خسارة كلية صالون <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" value="{{ old('total_los_cars') }}" name="total_los_cars"  class="form-control col-md-7 col-xs-12">
                    </div>
                    @if ($errors->has('total_los_cars'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('total_los_cars') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="last-name">خسارة كلية صالون (حادث)<span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" value="{{ old('total_los_cars_accedint') }}"  name="total_los_cars_accedint"  class="form-control col-md-7 col-xs-12">
                    </div>
                    @if ($errors->has('total_los_cars_accedint'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('total_los_cars_accedint') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">خسارة كلية شحن</label>
                    <div class="col-9">
                    <input value="{{ old('total_los_vans') }}"  class="form-control col-md-7 col-xs-12" type="text" name="total_los_vans">
                    </div>
                    @if ($errors->has('total_los_vans'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('total_los_vans') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">خسارة كلية نقل مشترك</label>
                    <div class="col-9">
                    <input value="{{ old('total_los_pickups') }}" class="form-control col-md-7 col-xs-12" type="text" name="total_los_pickups">
                    </div>
                    @if ($errors->has('total_los_pickups'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('total_los_pickups') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">شامل صالون (10000)</label>
                    <div class="col-9">
                    <input value="{{ old('full_cover_cars') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_cars">
                    </div>
                    @if ($errors->has('full_cover_cars'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_cars') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">شامل صالون لكل الف</label>
                    <div class="col-9">
                    <input value="{{ old('full_cover_cars_per_k') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_cars_per_k">
                    </div>
                    @if ($errors->has('full_cover_cars_per_k'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_cars_per_k') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">شامل شحن (10000)</label>
                    <div class="col-9">
                    <input value="{{ old('full_cover_vans') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_vans">
                    </div>
                    @if ($errors->has('full_cover_vans'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_vans') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">شامل شحن لكل الف</label>
                    <div class="col-9">
                    <input value="{{ old('full_cover_vans_per_k') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_vans_per_k">
                    </div>
                    @if ($errors->has('full_cover_vans_per_k'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_vans_per_k') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">شامل نقل مشترك (10000)</label>
                    <div class="col-9">
                    <input value="{{ old('full_cover_pickups') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_pickups">
                    </div>
                    @if ($errors->has('full_cover_pickups'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_pickups') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">شامل نقل مشترك لكل الف</label>
                    <div class="col-9">
                    <input value="{{ old('full_cover_pickups_per_k') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_pickups_per_k">
                    </div>
                    @if ($errors->has('full_cover_pickups_per_k'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('full_cover_pickups_per_k') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-9 col-md-offset-3">
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
