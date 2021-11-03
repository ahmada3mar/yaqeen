@extends('admin.layout')
    @section('content')

<div class="row">
    <div class="col-7">
        <div class="card ">
            <div class="card-header card-title-dark">
                <h5 class="card-title text-right">بيانات البوليصة</h5>
            </div>
            <div class="card-body p-4">
                <form method="post"  @if($policy->status == 0 )  action="{{ route('update-policy'  , $policy->id) }}" @else  action="{{ route('show-policy'  , $policy->id) }}"  @endif>
                    @csrf
                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">على حســـاب</label>
                        <div class="col-md-6 col-xs-12">
                            <select @if($policy->status != 0 ) disabled @endif  name="account_id" class="form-control ">
                                @foreach ($accounts as $account )
                                    <option @if(($account->id == $policy->account_id)) selected @endif value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-3" for="first-name">الاسم <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group-prepend">
                                <input @if($policy->status != 0 ) disabled @endif  @if($policy->status != 0 ) disabled @endif type="text" name="name" value="{{ old('name') ?? $policy->name }}"  class="form-control">
                                <a data-toggle="popover" data-bs-placement="left"  data-content="تم النسخ" style="border-top-right-radius: 0 ; border-bottom-right-radius: 0" class="input-group-text bg-info cursor-pointe">نسخ</a>
                            </div>
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
                                <input @if($policy->status != 0 ) disabled @endif   @if($policy->type == 1) checked @endif class="custom-control-input" type="radio" value="1" id="customRadio1" name="type">
                                <label for="customRadio1" class="custom-control-label">خسارة كلية</label>
                            </div>
                            <div class="custom-control-inline custom-radio">
                                <input @if($policy->status != 0 ) disabled @endif  @if($policy->type == 2) checked @endif class="custom-control-input" type="radio" value="2" id="customRadio2" name="type">
                                <label for="customRadio2" class="custom-control-label">شامــل</label>
                            </div>
                            <div class="custom-control-inline custom-radio">
                                <input @if($policy->status != 0 ) disabled @endif  @if($policy->type == 3) checked @endif class="custom-control-input" type="radio" value="3" id="customRadio2" name="type">
                                <label for="customRadio2" class="custom-control-label">ملاحق</label>
                            </div>

                        </div>
                        @if ($errors->has('type'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-3" for="last-name">قيمة التعويض<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-xs-12">
                        <input @if($policy->status != 0 ) disabled @endif  type="text"  value="{{ old('car_price') ?? $policy->car_price }}"  name="car_price"  class="form-control">
                        </div>
                        @if ($errors->has('car_price'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('car_price') }}</strong>
                        </span>
                    @endif
                    </div>
                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">نوع الهيكل</label>
                        <div class="col-md-6 col-xs-12">
                            <select @if($policy->status != 0 ) disabled @endif  name="car_type" class="form-control">
                            <option @if( old('car_type') == 'ركوب صغير' || (!old('car_type') && $policy->car_type == 'ركوب صغير')) selected @endif value="ركوب صغير">ركوب صغير</option>
                            <option @if( old('car_type') == 'شحن' || (!old('car_type') && $policy->car_type == 'شحن')) selected @endif value="شحن">شحن</option>
                            <option @if( old('car_type') == 'نقل مشترك' || (!old('car_type') && $policy->car_type == 'نقل مشترك')) selected @endif value="نقل مشترك">نقل مشترك</option>
                            </select>
                        </div>
                        @if ($errors->has('car_type'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('car_type') }}</strong>
                        </span>
                    @endif
                    </div>
                    <div class="form-group row">
                            <label for="middle-name" class="control-label col-3">
                                رقم اللوحة
                            </label>
                        <div class="col-md-6 col-xs-12">
                        <input @if($policy->status != 0 ) disabled @endif  value="{{ old('car_number') ?? $policy->car_number }}"  class="form-control" type="text" name="car_number">
                        </div>
                        @if ($errors->has('car_number'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('car_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">نوع المركبة</label>
                        <div class="col-md-6 col-xs-12">
                            <select @if($policy->status != 0 ) disabled @endif  name="car_name" class="form-control selectpicker" >
                                <option  selected disabled value="" >اختر ....</option>
                                @foreach ($cars as $car )
                                    <option @if( old('car_name') == $car->name || (!old('car_name') && $policy->car_name == $car->name)) selected @endif value="{{ $car->name }}" >{{ $car->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('car_name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('car_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">سنة الصنع</label>
                        <div class="col-md-6 col-xs-12">
                            <input @if($policy->status != 0 ) disabled @endif  value="{{ old('car_model') ?? $policy->car_model }}" class="form-control" type="text" name="car_model">
                        </div>
                        @if ($errors->has('car_model'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('car_model') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">رقم الشاصــي</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group-prepend">
                                <input @if($policy->status != 0 ) disabled @endif  style="border-top-left-radius: 0 ; border-bottom-left-radius: 0" value="{{ old('body_number') ?? $policy->body_number }}" class="form-control" type="text" name="body_number">
                                <a data-toggle="popover" data-bs-placement="left"  data-content="تم النسخ" style="border-top-right-radius: 0 ; border-bottom-right-radius: 0" class="input-group-text bg-info cursor-pointe">نسخ</a>
                            </div>
                        </div>
                        @if ($errors->has('body_number'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('body_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">رقم المــحرك</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group-prepend">
                                <input @if($policy->status != 0 ) disabled @endif  value="{{ old('eng_number') ?? $policy->eng_number }}" class="form-control" type="text" name="eng_number">
                                <a data-toggle="popover" data-placement="right"  data-content="تم النسخ" style="border-top-right-radius: 0 ; border-bottom-right-radius: 0" class="input-group-text bg-info cursor-pointe">نسخ</a>
                            </div>
                        </div>
                        @if ($errors->has('eng_number'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('eng_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">المـــدة</label>
                        <div class="row pl-0 col-md-6 col-xs-12">
                            <label for="middle-name" class="col-2">من</label>
                            <input @if($policy->status != 0 ) disabled @endif  value="{{ old('start_at') ?? \Carbon\Carbon::parse($policy->start_at)->format('Y-m-d') }}" aria-placeholder="dd-mm-yyyy" class="form-control col-md-10 col-xs-12" type="date" max="2030-12-31" name="start_at">
                            @if ($errors->has('start_at'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('start_at') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                       <label for="middle-name" class="control-label col-3"></label>
                        <div class="row pl-0 col-md-6 col-xs-12">
                            <label for="middle-name" class="col-2">الى</label>
                            <input @if($policy->status != 0 ) disabled @endif  value="{{ old('end_at') ??  \Carbon\Carbon::parse($policy->end_at)->format('Y-m-d') }}" aria-placeholder="dd-mm-yyyy" class="form-control col-md-10 col-xs-12" type="date" max="2030-12-31" name="end_at">
                            @if ($errors->has('end_at'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('end_at') }}</strong>
                            </span>
                            @endif
                        </div>
                        </div>

                    <div class="form-group row">
                        <label for="middle-name" class="control-label col-3">رقم العقد</label>
                        <div class="row pl-0 col-md-6 col-xs-12">
                                <div class="col-4">
                                    <input @if($policy->status != 0 ) disabled @endif  value="{{ old('policy_date') ?? 2021 }}" class="form-control col-12" type="text" name="policy_date">
                                    @if ($errors->has('policy_date'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('policy_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-8 pl-0">
                                    <input @if($policy->status != 0 ) disabled @endif  value="{{ old('policy_number') ?? $policy->policy_number }}" class="form-control col-12" type="text" name="policy_number">
                                    @if ($errors->has('policy_number'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('policy_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                        </div>
                    </div>
                    @if($policy->status == 0 )
                        <div class="form-group row">
                            <div class="col-3"></div>
                            <div class="row col-6 pl-0">
                                <div class="col-6">
                                    <button name="status" type="submit" value="1" class="btn btn-success col-12">اصدار</button>
                                </div>
                                <div class="col-6  pl-0">
                                    <button name="status" type="submit" value="-1" class="btn btn-danger col-12">رفض</button>
                                </div>
                            </div>
                        </div>
                    @elseif($policy->status == 1)
                        <div class="form-group row">
                            <div class="col-3"></div>
                            <div class="row col-6 pl-0">
                                <div class="col-12">
                                    <button name="status" type="submit" value="1" class="btn btn-success col-12">طباعة</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="col-5">
        <div class="card ">
            <div class="card-header card-title-dark">
                <h5 class="card-title text-right">المرفقات</h5>
            </div>
            <div class="card-body p-4">
                <form >
                    <div class="form-group row">
                        <div class="row pl-0 col-md-12 col-xs-12">
                            <img src="/file_storage/{{$policy->front_id}}" class="col-12 img-thumbnail" alt="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="row pl-0 col-md-12 col-xs-12">
                            <img src="/file_storage/{{$policy->back_id}}" class="col-12 img-thumbnail" alt="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    @endsection
