@extends('admin.layout')
@section('content')
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form class="form-horizonta" action="{{ route('policy') }}">
                                <div  class="form-group row col-4">
                                    <label style="display: flex ; align-items: center"
                                        class="col-sm-3 control-label">الاسم</label>
                                    <div class="input-group col-sm-9">
                                        <input value="{{ $request->name }}" name="name" type="text" class="form-control">
                                    </div>
                                </div>

                                <div  class="form-group row col-4">
                                    <label style="display: flex ; align-items: center"
                                        class="col-sm-3 control-label">من تاريخ</label>
                                    <div class="input-group col-sm-9">
                                        <input value="{{ $request->from }}" name="from" type="date"  class="form-control">
                                    </div>
                                </div>

                                <div  class="form-group row col-4">
                                    <label style="display: flex ; align-items: center"
                                        class="col-sm-3 control-label">الى تاريخ</label>
                                    <div class="input-group col-sm-9">
                                        <input value="{{ $request->to }}" name="to" type="date"  class="form-control">
                                    </div>
                                </div>

                                <div  class="form-group row col-4">
                                    <div class="col-6">
                                        <button class="btn btn-primary col-12" >بحث</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="reset" class="btn btn-primary col-12" >اعادة تعين</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /top tiles -->

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div style="display: flex ; justify-content: space-between" class="x_title col-12">
                            <h3>البوالص</h3>
                            <a href="{{ route('create-policy') }}" style="margin: 5px" class="btn btn-success">اضافة
                                بوليصة</a>
                        </div>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover  align-middle">
                                    <thead >
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">نوع المركة</th>
                                            <th scope="col">نوع التامين</th>
                                            <th scope="col">قيمة التعويض</th>
                                            <th scope="col">الفرع</th>
                                            <th scope="col">الحالة</th>
                                            <th scope="col">التاريخ</th>
                                            <th scope="col">الاجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @forelse ($policies  as $policy )
                                            <tr>
                                                <th scope="row">{{ $loop->index+1 }}</th>
                                                <td class="col-4">{{ $policy->name }}</td>
                                                <td>{{ $policy->car_type }}</td>
                                                <td>{{ \App\models\Policy::$types[$policy->type] }}</td>
                                                <td>{{ $policy->car_price }}</td>
                                                <td>{{ $policy->branch->name }}</td>
                                                <td>
                                                    @if($policy->status == -1)
                                                        <span class="badge p-2 bg-danger">مرفوضة</span>
                                                    @elseif ($policy->status == 0)
                                                        <span class="badge p-2 bg-warning text-dark ">معلقة</span>
                                                    @else
                                                        <span class="badge p-2 bg-success">مصدرة</span>
                                                    @endif
                                                    </td>
                                                <td>
                                                    <div >
                                                        <div dir="ltr" style="text-align:right">
                                                            {{ $policy->created_at->format('h:i:a ') }}
                                                        </div>
                                                        <div>
                                                            {{ $policy->created_at->format('Y/m/d') }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit-policy' , $policy->id) }}" class="btn btn-info">عرض المزيد</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="13">لا يوجد معلومات</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>

            </div>

@endsection
