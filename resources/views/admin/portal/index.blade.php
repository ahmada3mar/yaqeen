@extends('admin.layout')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ count($all_policy) }}</h3>

                            <p>عدد بوالص اليوم</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <a href="#" class="small-box-footer">عرض المزيد <i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $all_policy->sum('price') }}<sup style="font-size: 20px"> JOD</sup></h3>

                            <p>مجموع البيع</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">عرض المزيد <i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $all_policy->sum('cost') }}<sup style="font-size: 20px"> JOD</sup></h3>

                            <p>تسليم الشركة</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <a href="#" class="small-box-footer">عرض المزيد <i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $all_policy->sum('price') - $all_policy->sum('cost') }}<sup style="font-size: 20px"> JOD</sup></h3>

                            <p>الربح</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">عرض المزيد <i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
            </div>
            <!-- Main row -->
            <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                الأفرع
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>
                        <div class="card-footer bg-transparent  d-none">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div id="sparkline-1"></div>
                                </div>
                                <div class="col-4 text-center">
                                    <div id="sparkline-2"></div>
                                </div>
                                <div class="col-4 text-center">
                                    <div id="sparkline-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card py-5">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                المبيعات
                            </h3>
                            <div class="card-body p-0">
                                <div class="tab-content p-0">
                                    <div class="chart tab-pane active" id="revenue-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">


                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                التقويم
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                    </div>




                    <div class="card bg-gradient-info">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                رسم بياني للمبيعات
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="chart" id="line-chart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" data-readonly="true" value="20"
                                        data-width="60" data-height="60" data-fgColor="#39CCCC">

                                    <div class="text-white">Mail-Orders</div>
                                </div>
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" data-readonly="true" value="50"
                                        data-width="60" data-height="60" data-fgColor="#39CCCC">

                                    <div class="text-white">Online</div>
                                </div>
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" data-readonly="true" value="30"
                                        data-width="60" data-height="60" data-fgColor="#39CCCC">

                                    <div class="text-white">In-Store</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </section>
@endsection
