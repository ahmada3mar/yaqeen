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
                                            <th scope="col">المُصدر</th>
                                            <th scope="col">التكلفة</th>
                                            <th scope="col">البيع</th>
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
                                                <td>{{ $policy->inssurance_type }}</td>
                                                <td>{{ $policy->coverage }}</td>
                                                <td>{{ $policy->branch }}</td>
                                                <td>{{ $policy->user }}</td>
                                                <td>{{ $policy->cost }}</td>
                                                <td>{{ $policy->price }}</td>
                                                <td>{{ $policy->created_by }}</td>
                                                <td>
                                                    <ul class="nav ">
                                                        <li class="dropdown">
                                                            <a style="padding: 5px" href="#" class="dropdown-toggle"
                                                                data-toggle="dropdown" role="button" aria-expanded="false"><i
                                                                    class="fa fa-chevron-down"></i></a>
                                                            <ul class="dropdown-menu" style="padding: 8px 5px" role="menu">
                                                                <li><a href="{{ route('edit-branches', $branch->id) }}"> <i
                                                                            class="fa fa-wrench"></i> تعديل</a>
                                                                </li>
                                                                <li><a style="color: rgb(212, 9, 9)" href="#"><i
                                                                            class="fa fa-times"></i> حذف</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
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
