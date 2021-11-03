@extends('admin.layout')
@section('content')
    <div class="right_col" role="maSSSin">
        <div style="margin-top: 50px" class="row">
            <div class="col-12">
                <div style="padding: 5px 0" class="d-flex flex-row-reverse">
                    <div class="col-3">
                        تاريخ التسجيل : {{ $policy->created_at->format('d/m/Y') }}
                    </div>
                    <div class="col-3">
                        خسارة كلية
                    </div>
                    <div class="col-6">
                        رقم العــــقد -:  1 / 116 / 29 / 2020 / {{ $policy->policy_number }} / 92 / 1
                    </div>
                </div>
                <table class="table table-bordered-black">
                    <thead>
                        <tr>
                            <td
                                style="color: black ; text-align: center ; background: #c4c4c4 !important ; -webkit-print-color-adjust: exact !important">
                                عقـــد تأميــــــن المركبـــــــــــــات</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="overflow: hidden" scope="row">
                                <div style="display: flex ; justify-content: space-between">
                                    <div style="text-align: right ;  white-space: nowrap;overflow: hidden "
                                        class="col-xs-7">
                                        المؤمن لــــــــــه &nbsp;&nbsp;&nbsp;  {{ $policy->name }}
                                        <br>
                                        العـنـــــــــــــــوان &nbsp;&nbsp;&nbsp;-: O.BOX.p عمان 0 0 الاردن<span
                                            style="margin: 0 60px">0799991230</span>
                                    </div>
                                    <div style="text-align: right ; white-space: nowrap; overflow: hidden"
                                        class="col-xs-5">
                                        المستفيـــــــــد : 
                                        <br>
                                        على حســـــــــاب : مركز اليقين الاردني لاصدار وثائق التأمين /  {{ \App\Models\Policy::$types[$policy->type] }}
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">مبلغ التــــامين &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:<span
                                    style="margin: 0 20px">3000 فقط ثلاثة الاف دينار اردني لا غير</span></td>
                        </tr>
                        <tr>
                            <td style="text-align: right">مـدة التــــامين &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:<span
                                    style="margin: 0 20px">من  {{  date('d/m/Y' , strtotime($policy->start_at)) }} الساعة 12 ظهرا</span><span style="margin: 0 50px">الى
                                     {{ date('d/m/Y' , strtotime($policy->end_at)) }} الساعة 12 ظهرا</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; justify-content: space-between">
                                    <div class="col-xs-5">
                                        <div style="display: flex" class="row">
                                            <div>
                                                رقم اللوحة &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                 {{ $policy->car_number }}
                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                نوع المركبـــة &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                 {{ $policy->car_name }}
                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                نوع الهيكـــــل &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                 {{ $policy->car_type }}
                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                الاستعمال/اللون &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                خصوصي/ &nbsp;&nbsp;&nbsp;&nbsp; حسب الرخصة
                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                م. الجغرافية &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                الاردن فقط
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-5">
                                        <div style="display: flex" class="row">
                                            <div>
                                                شروط الأصلاح &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                خارج الوكالة
                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                سنة الصنــــع &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                 {{ $policy->car_model }}
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
                                        <div style="display: flex" class="row">
                                            <div>
                                                رقم المحــــــرك &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                 {{ $policy->eng_number }}
                                            </div>
                                        </div>
                                        <div style="display: flex" class="row">
                                            <div>
                                                رقم الشاصـــــي &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">
                                                 {{ $policy->body_number }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right ;display: flex">
                                <div class="col-xs-2">
                                    ملاحظـــــــــات &nbsp; &nbsp;-:
                                </div>
                                <div class="col-xs-10">التحمل في حال الخساره الكليه للمركبه10% من القيمة التامينيه او القيمه
                                    الفعليه ايهما اقل / يستثنى من حدود التغطيه الخساره او الاضرار الناتجه عن السرقه الكليه او السرقه
                                    الجزئيه
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0">
                                <div style="display: flex">
                                    <div style="border: black solid 1px" class="col-xs-6">
                                        <div style="text-align: center ; margin-bottom: 5px">
                                            <b style=" border-bottom: black solid 3px ">
                                                الاعفــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــاءات&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </b>
                                        </div>
                                        <div style="border: black solid 1px ; padding: 0 10px;">
                                            <div>
                                                الاعفاء للحادث الاول &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">

                                            </div>
                                            <div>
                                                الاعفاء للحادث الثاني &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">

                                            </div>
                                            <div>
                                                الاعفاء للحادث الثالث &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                            <div style="margin: 0 20px">

                                            </div>
                                        </div>
                                    </div>
                                    <div style="border: black solid 1px" class="col-xs-6">
                                        <div style="text-align: center ; margin-bottom: 5px">
                                            <b style=" border-bottom: black solid 3px ; padding: 0 60px">
                                                القــــــــــــــــــــــســــــــــــــــــــــــــــــــــط&nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </b>
                                        </div>
                                        <div style="border: black solid 1px ;padding: 20px 25px;">
                                            <div>
                                                قسط التامين الاجمالي &nbsp;&nbsp;&nbsp;&nbsp;-:
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="padding: 0 20px" class="row">
                                    <div class="col-xs-3">
                                        الاتحاد العربي الدولي للتامين
                                    </div>
                                    <div class="col-xs-6">
                                        بالدينار اردني
                                    </div>
                                    <div class="col-xs-3">
                                        جميـــع المبالــــغ
                                    </div>
                                </div>
                                <br>
                                <div style="padding: 0 20px ; display: flex" >
                                    <div class="col-xs-6">
                                        دقــق   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...................
                                    </div>
                                    <div class="col-xs-5">
                                        التوقــيع &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...............
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
