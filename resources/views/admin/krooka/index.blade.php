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
                        <div class="form-group row ">
                            <label class="control-label col-3" for="first-name">رقم اللوحة
                            </label>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-1">
                                        <input type="text" name="ter" value="{{ old('ter') }}"  class="form-control ">
                                    </div>

                                    <div class="col-6">
                                        <input type="text" name="num" value="{{ old('num') }}"  class="form-control ">
                                    </div>

                                    @if ($errors->has('num') || $errors->has('ter') )
                                        <span class="text-danger">
                                            <strong>{{ $errors->first()  }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-3" for="first-name">رقم التسجيل
                            </label>

                            <div class="col-9">
                                <div class="row">
                                    <div class="col-md-7 col-xs-12">

                                    <input type="text" name="reg" value="{{ old('reg') }}"  class="form-control ">
                                </div>

                                    @if ($errors->has('reg'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('reg') }}</strong>
                                        </span>
                                    @endif
                                </div>
                             </div>

                        </div>

                        <div class="form-group row">
                            <label class="control-label col-3" for="first-name">رقم الشاصي
                            </label>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-md-7 col-xs-12">
                                        <input type="text" name="body" value="{{ old('body') }}"  class="form-control ">
                                    </div>
                                    @if ($errors->has('body'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-9 col-md-offset-3">
                                <button type="submit" class="btn btn-success">استعلام</button>
                                <button class="btn btn-primary" type="reset">افراغ الحقول</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        @if(Session::get('krooka'))
        @php
            $krooka = Session::get('krooka') ;
        @endphp
            <div class="card">
                <div class="card-header card-title-dark">
                    <h5 class="card-title text-right">النتائج</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group row">
                        @if (array_key_exists('children' ,  $krooka))
                            <div class="table-responsive">
                                <table class="table able-striped table-hover  align-middle">
                                    @foreach ($krooka['children'] as $r )
                                        <tr>
                                            @foreach ($r['children'] as $td )

                                                @if(array_key_exists('html' , $td)  && !in_array($loop->index ,[0 , 1] ))
                                                    <{{ $td['tag'] }} >
                                                    {{ $td['html'] }}
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            {{ $krooka['html'] }}
                        @endif
                    </div>
                </div>
            </div>
        @endif

</div>
    @endsection
