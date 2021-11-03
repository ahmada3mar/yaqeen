@extends('admin.layout')
    @section('content')

<div class="container">
        <div class="card">
            <div class="card-header card-title-dark">
                <h5 class="card-title text-right">أضافة مستخدم</h5>
            </div>
        <div class="card-body p-4">
            <form  method="POST" action="{{ route('update-user' , $user->id) }}">
                @csrf
                <div class="form-group row">
                    <label class="control-label col-3" for="first-name">الاسم <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" name="name" value="{{ old('name') ?? $user->name }}"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middle-name" class="control-label col-3">الفرع</label>
                    <div class="col-9">
                        <select  name="branch_id" class="form-control col-md-7 col-xs-12">
                            @foreach ($branches as $branch )
                                <option @if((old('branch_id') == $branch->id)) selected @endif value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('branch_id'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('branch_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-3" for="first-name">اسم المستحدم <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" name="username" value="{{ old('username')  ?? $user->username }}"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('username'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="first-name">الصفة <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" name="role" value="{{ old('role')  ?? $user->role }}"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('role'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-3" for="last-name">الايميل <span class="required">*</span>
                    </label>
                    <div class="col-9">
                    <input type="text" value="{{ old('email')  ?? $user->email }}" name="email"  class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-9 col-md-offset-3">
                        <button type="submit" class="btn btn-success">اضافة</button>
                        <button class="btn btn-primary" type="reset">افراغ الحقول</button>
                        <a class="btn btn-primary" href="{{ route('users') }}">الغاء</a>
                    </div>
                </div>

            </form>
            </div>
        </div>
</div>
    @endsection
