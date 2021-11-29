@extends('admin.layout')
@section('content')
    <div class="right_col" role="maSSSin">
        <div style="margin-top: 50px ; line-height: 35px" class="row">
            <div class="col-12">
                <div style="padding: 5px" class="d-flex flex-row-reverse mt-4">

                    <div class="col">
                        عقد خدمة المساعدة على الطريق
                    </div>
                    <div class="col-5">
                     فرع : {{ Auth::user()->branch->name }}
                    </div>
                </div>
                <table  border="black" class="table table-striped ">
                    <thead>
                        <tr>
                            <td
                                style="color: black ; text-align: center ; background: #c4c4c4 !important ; -webkit-print-color-adjust: exact !important">
                               شـــــــــركة صد رد للمــــــــساعدة على الطــــــــريق</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="overflow: hidden" scope="row">
                                <div style="display: flex ; justify-content: space-between">
                                    <div style="text-align: right ;  white-space: nowrap;overflow: hidden "
                                        class="col-7">
                                        المؤمن لــــــــــه &nbsp;&nbsp;&nbsp; -: {{ $vip->name }}
                                        <br>
                                        العـنـــــــــــــــوان &nbsp;&nbsp;&nbsp;-: عمان
                                        <br>
                                        رقـــــم الهـــاتف &nbsp;&nbsp;&nbsp;-: {{ $vip->mobile }}
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">تاريخ انتهاء التأمين &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:<span
                                    style="margin: 0 20px">{{ $vip->end_at }}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; justify-content: space-between">
                                    <div class="col-5">
                                        <div style="display: flex" class="row">
                                            <div>
                                                رقم اللوحة &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-: {{ $vip->car_number }}
                                            </div>
                                            <div style="margin: 0 20px">

                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                نوع المركبـــة &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-: {{ $vip->car_type }}
                                            </div>
                                            <div style="margin: 0 20px">

                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                اللـــــون &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-: {{ $vip->color }}
                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                سنة الصنــــع &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-: {{ $vip->car_model }}
                                            </div>
                                            <div style="margin: 0 20px">

                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                عدد الركــــــاب &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                حسب الرخصـــة
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right ;display: flex">
                                <div class="col-2">
                                    ملاحظـــــــــات &nbsp; &nbsp;-:
                                </div>
                                <div class="col-10">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0">
                                <div style="display: flex">
                                    <div style="border: black solid 1px" class="col-4 my-5">
                                        <div style="text-align: center ; margin-bottom: 5px">
                                            <b style=" border-bottom: black solid 3px ; padding: 0 60px">
                                                القــــــــــــــــــــــســــــــــــــــــــــــــــــــــط -:
                                            </b>
                                        </div>
                                        <div style="border: black solid 1px ;padding: 20px 25px;">
                                            <div>
                                                  القسط الاجمالي &nbsp;&nbsp;&nbsp;&nbsp;-: {{ $vip->price }} فقط لا غير
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div  class="row flex-row">
                                    <div class="col-6">
                                        جميع المبــــالغ
                                    </div>
                                    <div class="col-3">
                                       بالديــــنار الاردني
                                    </div>
                                </div>
                                <br>
                                <div style="padding: 0 20px ; display: flex" >
                                    <div class="col-5">
                                        الختم &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...............
                                    </div>
                                    <div class="col-5 font-weight-bold">
                                        اسم المستخدم &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ Auth::user()->name }}
                                    </div>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
