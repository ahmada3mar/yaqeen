@extends('admin.layout')
@section('content')
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form class="form-horizonta" action="">
                                <div style=" display: inline-flex;" class="form-group">
                                    <label style="display: flex ; align-items: center"
                                        class="col-sm-2 control-label">الاسم</label>
                                    <div class="input-group col-sm-9">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">بحث</button>
                                        </span>
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
                                            <th scope="col">التاريخ</th>
                                            <th scope="col">الاجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @forelse ($policies  as $policy )
                                            <tr>
                                                <th scope="row">1</th>
                                                <td class="col-4">{{ $policy->name }}</td>
                                                <td>{{ $policy->car_type }}</td>
                                                <td>{{ \App\models\Policy::$types[$policy->type] }}</td>
                                                <td>{{ $policy->car_price }}</td>
                                                <td>{{ $policy->branch->name }}</td>
                                                <td>{{ $policy->created_at->diffForHumans() }}</td>
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
