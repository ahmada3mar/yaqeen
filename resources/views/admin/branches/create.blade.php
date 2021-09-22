@extends('admin.layout')
    @section('content')
        <div class="right_col" role="maSSSin">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                       <div class="x_content">
                            <br />
                            <div class="row">
                                <form action="{{ route('store-branches') }}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-right col-xs-11 ">
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">الاسم <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="name" value="{{ old('name') }}"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">خسارة كلية صالون <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="{{ old('total_los_cars') }}" name="total_los_cars"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                        @if ($errors->has('total_los_cars'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('total_los_cars') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">خسارة كلية صالون (حادث)<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="{{ old('total_los_cars_accedint') }}"  name="total_los_cars_accedint"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                        @if ($errors->has('total_los_cars_accedint'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('total_los_cars_accedint') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">خسارة كلية شحن</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('total_los_vans') }}"  class="form-control col-md-7 col-xs-12" type="text" name="total_los_vans">
                                        </div>
                                        @if ($errors->has('total_los_vans'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('total_los_vans') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">خسارة كلية نقل مشترك</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('total_los_pickups') }}" class="form-control col-md-7 col-xs-12" type="text" name="total_los_pickups">
                                        </div>
                                        @if ($errors->has('total_los_pickups'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('total_los_pickups') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">شامل صالون (10000)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('full_cover_cars') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_cars">
                                        </div>
                                        @if ($errors->has('full_cover_cars'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('full_cover_cars') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">شامل صالون لكل الف</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('full_cover_cars_per_k') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_cars_per_k">
                                        </div>
                                        @if ($errors->has('full_cover_cars_per_k'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('full_cover_cars_per_k') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">شامل شحن (10000)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('full_cover_vans') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_vans">
                                        </div>
                                        @if ($errors->has('full_cover_vans'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('full_cover_vans') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">شامل شحن لكل الف</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('full_cover_vans_per_k') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_vans_per_k">
                                        </div>
                                        @if ($errors->has('full_cover_vans_per_k'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('full_cover_vans_per_k') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">شامل نقل مشترك (10000)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('full_cover_pickups') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_pickups">
                                        </div>
                                        @if ($errors->has('full_cover_pickups'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('full_cover_pickups') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">شامل نقل مشترك لكل الف</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{ old('full_cover_pickups_per_k') }}" class="form-control col-md-7 col-xs-12" type="text" name="full_cover_pickups_per_k">
                                        </div>
                                        @if ($errors->has('full_cover_pickups_per_k'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('full_cover_pickups_per_k') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">اضافة</button>
                                            <button class="btn btn-primary" type="reset">افراغ الحقول</button>
                                            <a class="btn btn-primary" href="{{ route('branches') }}">الغاء</a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
