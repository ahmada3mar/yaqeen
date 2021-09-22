@extends('admin.layout')
    @section('content')
        <div class="right_col" role="maSSSin">
            <!-- top tiles -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form class="form-horizonta" action="">
                                <div style=" display: inline-flex;" class="form-group">
                                    <label style="display: flex ; align-items: center" class="col-sm-2 control-label">الاسم</label>
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
                        <h3>الافرع</h3>
                        <a href="{{ route('create-branches') }}" style="margin: 5px" class="btn btn-success">اضافة فرع</a>
                      </div>
                      <div class="x_content">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>الاسم</th>
                              <th>صالون</th>
                              <th>(حادث)صالون</th>
                              <th>شحن</th>
                              <th>نقل مشترك</th>
                              <th>شامل صالون (10000)</th>
                              <th>شامل صالون لكل الف</th>
                              <th>شامل شحن (10000)</th>
                              <th>شامل شحن لكل الف</th>
                              <th>شامل نقل مشترك (10000)</th>
                              <th>شامل نقل مشترك لكل الف</th>
                              <th>الاجراءات</th>
                            </tr>
                          </thead>
                          <tbody>
                              @forelse ($branches as $branch )
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->total_los_cars }}</td>
                                    <td>{{ $branch->total_los_cars_accedint }}</td>
                                    <td>{{ $branch->total_los_vans }}</td>
                                    <td>{{ $branch->total_los_pickups }}</td>
                                    <td>{{ $branch->full_cover_cars }}</td>
                                    <td>{{ $branch->full_cover_cars_per_k }}</td>
                                    <td>{{ $branch->full_cover_vans }}</td>
                                    <td>{{ $branch->full_cover_vans_per_k }}</td>
                                    <td>{{ $branch->full_cover_pickups }}</td>
                                    <td>{{ $branch->full_cover_pickups_per_k }}</td>

                                    <td><ul class="nav ">
                                    <li class="dropdown">
                                        <a style="padding: 5px" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-chevron-down"></i></a>
                                        <ul class="dropdown-menu" style="padding: 8px 5px" role="menu">
                                        <li><a href="{{ route('edit-branches' , $branch->id) }}"> <i class="fa fa-wrench"></i> تعديل</a>
                                        </li>
                                        <li><a style="color: rgb(212, 9, 9)" href="#"><i class="fa fa-times"></i> حذف</a>
                                        </li>
                                        </ul>
                                    </li>
                                    </ul></td>
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
        </div>
    @endsection
