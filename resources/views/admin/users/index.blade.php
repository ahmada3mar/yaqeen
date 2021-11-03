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
                            <h3>المستخدمين</h3>
                            <a href="{{ route('create-user') }}" style="margin: 5px" class="btn btn-success">اضافة
                                مستخدم</a>
                        </div>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover  align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المستحدم</th>
                                        <th>الاسم</th>
                                        <th>الايميل</th>
                                        <th>الفرع</th>
                                        <th>الصفة</th>
                                        <th>تاريخ الانشاء</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user )
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->branch->name }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <ul class="nav ">
                                                    <li class="dropdown">
                                                        <a style="padding: 5px" href="#" class="dropdown-toggle"
                                                            data-toggle="dropdown" role="button" aria-expanded="false"><i
                                                                class="fa fa-chevron-down"></i></a>
                                                        <ul class="dropdown-menu" style="padding: 8px 5px" role="menu">
                                                            <li><a href="{{ route('edit-users', $user->id) }}"> <i
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
