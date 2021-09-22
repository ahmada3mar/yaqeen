<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */
    'accepted' => 'يجب الموافقة على :attribute.',
    'active_url' => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash' => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array' => 'يجب أن يكون :attribute ًمصفوفة.',
    'before' => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between' => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date' => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format' => 'لا يتوافق :attribute مع الشكل :format.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute صحيح.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values',
    'exists' => 'القيمة المحددة :attribute غير موجودة.',
    'file' => 'الـ :attribute يجب أن يكون ملفاً.',
    'filled' => ':attribute إجباري.',
    'gt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ.',
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string' => 'يجب أن يكون طول  :attribute على الأقل :value حروفٍ.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image' => 'يجب أن يكون :attribute صورةً.',
    'in' => ':attribute غير موجود.',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'lt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ.',
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => 'يجب أن يكون ملفًا من نوع: :values.',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع: :values.',
    'min' => [
        'numeric' => 'يجب أن تكون القيمة مساوية أو أكبر من :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يكون طول :attribute على الأقل :min حروفٍ.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in' => 'العنصر :attribute غير صحيح.',
    'not_regex' => 'صيغة :attribute غير صحيحة.',
    'numeric' => 'يجب أن يكون رقمًا.',
    'present' => 'يجب تقديم :attribute.',
    'regex' => 'صيغة :attribute .غير صحيحة.',
    'required' => ' الحقل مطلوب',
    'required_if' => ' الحقل مطلوب',
    'required_unless' => 'الحقل مطلوب',
    'required_with' => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all' => ':attribute مطلوب إذا توفّر :values.',
    'required_without' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other.',
    'size' => [
        'numeric' => 'يجب أن تكون حقل :attribute مساوية لـ :size.',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ بالضبط.',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique' => ':attribute مُستخدم من قبل.',
    'uploaded' => 'فشل في تحميل الـ :attribute.',
    'url' => 'صيغة الرابط :attribute غير صحيحة.',
    'invalid' => ':attribute  غير صحيح',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom' => [
        'name_2' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'email_2' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'password_2' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'citizenship_2' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'country_2' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'post_code_2' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'phone_2' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'name_3' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'email_3' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'password_3' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'citizenship_3' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'country_3' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'post_code_3' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'phone_3' => [
            'required_with' => ':attribute الحقل مطلوب.',
        ],
        'english_only' => ':attribute يجب ان يتكون من حروف انجليزية.',
        'arabic_only' => ':attribute يجب ان يتكون من حروف عربية',
        'phone_used' => ':attribute مُستخدم من قبل.',
        'validation_decimal' => 'The :attribute must be an appropriately formatted decimal.',
        'unsigned_number' => 'The :attribute format is invalid, you can use the number only.',
        'less_lan_equal_amount' => 'The :attribute should be less than or equal to the equivalent requested amount. (Ex. Rate: :ex_rate).',
        'without_number' => ' :attribute لا يمكن ان يحتوي على ارقام',
        'strong_pass' => 'يجب أن تحتوي :attribute على أحرف وأرقام باللغة الانجليزية',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
     */

    'attributes' => [
        'title' => 'اللقب',
        'name' => 'الاسم',
        'email' => 'البريد الالكتروني',
        'country' => 'الدولة',
        'language' => 'االغة',
        'phone' => 'رقم الهاتف',
        'password' => 'كلمة المرور',
        'wallet_currency' => 'عملة المحفظة',
        'confirm1' => 'الاتفاقية',
        'confirm2' => 'Tax Declarations',
        'confirm3' => 'قراءة وفهم سياسة الخصوصيّة',
        'referral' => 'إحالة',
        'first_name' => 'الاسم الاول',
        'last_name' => 'الاسم الأخير',
        'first_name_0' => 'الاسم الاول',
        'last_name_0' => 'الاسم الأخير',
        'first_name_1' => 'الحساب الثاني - الاسم الاول',
        'last_name_1' => 'الحساب الثاني - الاسم الاخير',
        'first_name_2' => 'third holder first name',
        'last_name_2' => 'third holder ast name',
        'first_name_3' => 'forth holder first name',
        'last_name_3' => 'forth holder last name',
        'name_0' => 'holder name',
        'email_0' => 'البريد الإلكتروني',
        'gender_0' => 'holder gender',
        'birthdate_0' => 'holder birthdate',
        'citizenship_0' => 'holder citizenship ',
        'country_0' => 'البلد',
        'city_0' => 'المدينة',
        'address_0' => 'العنوان',
        'post_code_0' => 'الرمز البريدي',
        'phone_0' => 'رقم الهاتف',
        'password_0' => 'كلمة المرور ',
        'passport_id_0' => 'holder pasport ID',
        'name_1' => 'second holder Name',
        'email_1' => 'الحساب الثاني - البريد الالكتروني',
        'gender_1' => 'second holder gender',
        'birthdate_1' => 'second holder birthdate',
        'citizenship_1' => 'second holder Citizenship ',
        'country_1' => 'الحساب الثاني - البلد',
        'city_1' => 'second holder city ',
        'address_1' => 'second holder address ',
        'post_code_1' => 'الحساب الثاني - الرمز البريدي',
        'phone_1' => 'الحساب الثاني - رقم الهاتف',
        'password_1' => 'الحساب الثاني - كلمة المرور',
        'passport_id_1' => 'second holder pasport ID',
        'name_2' => 'third holder Name',
        'email_2' => 'البريد الإلكتروني للمالك الثالث',
        'gender_2' => 'third holder gender',
        'birthdate_2' => 'third holder birthdate',
        'citizenship_2' => 'third holder Citizenship ',
        'country_2' => 'third holder Country ',
        'city_2' => 'third holder city ',
        'address_2' => 'third holder address ',
        'post_code_2' => 'الرمز البريدي لصاحب الحساب الثالث',
        'phone_2' => 'third holder Phone ',
        'password_2' => 'كلمة المرور لصاحب الحساب الثالث',
        'passport_id_2' => 'third holder pasport ID',
        'name_3' => 'forth holder Name',
        'email_3' => 'forth holder Email',
        'gender_3' => 'forth holder gender',
        'birthdate_3' => 'forth holder birthdate',
        'citizenship_3' => 'forth holder Citizenship ',
        'country_3' => 'forth holder Country ',
        'city_3' => 'forth holder city ',
        'address_3' => 'forth holder address ',
        'post_code_3' => 'الرمز البريدي لصاحب الحساب الرابع',
        'phone_3' => 'forth holder Phone ',
        'password_3' => 'forth holder password ',
        'passport_id_3' => 'forth holder pasport ID',
        'b_phone_post_code' => 'Business phone code',
        'business_phone' => 'Business phone number',
        'b_fax_post_code' => 'Business fax code',
        'business_fax' => 'Business fax number',
        'company_name' => 'اسم الشركة',
        'company_type' => 'نوع الشركة',
        'country_of_registration' => 'بلد تسجيل',
        'trading_platform' => 'منصة التداول',
        'balance' => 'الرصيد',
        'city' => 'المدينة',
        'subject' => 'الموضوع',
        'phone_code' => 'رمز الهاتف',
        'phone_number' => 'رقم الهاتف',
        'message' => 'الرسالة',
        'gender' => 'الجنس',
        'marital_status' => 'الحالة الاجتماعية',
        'nationality_id' => 'الجنسية',
        'years_of_experience' => 'سنوات الخبرة العملية',
        'country_id' => 'الدولة',
        'attachment' => 'المرفقات',
        'subscribe' => 'الإشتراك',
        'group' => 'نوع الحساب',
        'post_code' => 'الرمز البريدي',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'address' => 'العنوان',
        'citizenship_id' => 'الجنسيّة',
        'payment_gateway_id' => 'بوابة الدفع الالكتروني',
        'account_number' => 'رقم الحساب',
        'current_password' => 'كلمة المرور الحالية',
        'new_password' => 'كلمة المرور الجديدة',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'metatrader_password' => 'كلمة مرور ميتاتريدر',
        'leverage' => 'الرافعة المالية',
        'deposit_amount' => 'الرصيد',
        'transfer_from' => 'من',
        'transfer_to' => 'الى',
        'transfer_amount' => 'مبلغ التحويل',
        'amount' => 'المبلغ',
        'currency' => 'عملة',
        'subject_id' => 'الموضوع',
        'description' => 'المحتوى',
        'english_name' => 'الاسم',
        'arabic_name' => 'الاسم',
        'id_number' => 'الهوية الوطنية / جواز السفر',
        'job_title' => 'المسمى الوظيفي',
        'zip_code' => 'الرمز البريدي',
        'source_of_income.expected_fund_country' => 'بلد مصدر رأس المال',
        'source_of_income.annual_income' => 'اختيار الاجابة المناسبة',
        'source_of_income.estimated_net_worth' => 'اختيار الاجابة المناسبة',
        'source_of_income.source_of_wealth' => 'اختيار الاجابة المناسبة',
        'source_of_income.yearly_expect_deposits' => 'اختيار الاجابة المناسبة',
        'us_citizen_question.us_born_inside' => 'اختيار الاجابة المناسبة',
        'us_citizen_question.us_born_outside' => 'اختيار الاجابة المناسبة',
        'us_citizen_question.us_citizen_origin' => 'اختيار الاجابة المناسبة',
        'us_citizen_question.us_green_card' => 'اختيار الاجابة المناسبة',
        'us_citizen_question.us_reside' => 'اختيار الاجابة المناسبة',
        'us_citizen_question.us_mailbox' => 'اختيار الاجابة المناسبة',
        'us_citizen_question.us_investments' => 'اختيار الاجابة المناسبة',
        'trading_on_behalf' => 'التداول بالنيابة عن شخص آخر',
        'politically_person_question' => 'الاجابة على السؤال هل أنت شخصية سياسية معروفة',
        'trading_poa' => 'وكالة التداول بالنيابة عن شخص آخر',
        'proof_of_payment' => 'إثبات الدفع',
        'swift_code_BSB' => 'السويفت كود',
        'account_currency' => 'عملة الحساب',
        'bank_name' => 'اسم المصرف',
        'beneficiary_name' => 'اسم المستفيد',
        'mt_account' => 'حساب ميتاتريدر',
        'confirmation' => 'التاكيد',
        'politically_person' =>  'اختيار الاجابة المناسبة',
        'us_citizen' => 'المواطنون الأمريكيون',
    ],

    'credit_card' => [
        'card_invalid' => ':attribute غير صحيح',
        'card_pattern_invalid' => ':attribute النمط غير مناسب',
        'card_length_invalid' => ':attribute الطول غير مناسب',
        'card_checksum_invalid' => ':attribute المجموع الاختباري غير مناسب',
    ],
];
