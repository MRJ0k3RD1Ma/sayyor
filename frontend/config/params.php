<?php
return [
    'bsDependencyEnabled' => false,
    'adminEmail' => 'admin@example.com',
    'gender'=>[
        0=>'Urg\'ochi',
        1=>'Erkak'
    ],
    'hamsa'=>[
        'username'=>'sayyor',
        'password'=>'rc5n08qpwfnts4Wzt',
        'url'=>[
            'token'=>'http://hamsa.vetgov.uz/api/gettoken',
            'getjurinfo'=>'http://hamsa.vetgov.uz/api/getjurinfo',
            'getfizinfo'=>'http://hamsa.vetgov.uz/api/getfizinfo',
            'getanimalinfo'=>'http://hamsa.vetgov.uz/api/getanimalinfo',
        ],
    ],
    'eskiz'=>[
        'email'=>'info@vetgov.uz',
        'password'=>'wu6Ifz4Y1ps7bMVgXTpxnZX0pvw8ZvV5Li7ILFa1'
    ],
    'is_vaccination'=>[
        0=>Yii::t('lab','Yo\'q'),
        1=>Yii::t('lab','Ha')
    ],
    'result'=>[
        0=>Yii::t('lab','Yo\'q'),
        1=>Yii::t('lab','Ha'),
        3=>Yii::t('lab','Киритилмаган')
    ],
    'unit_belgi'=>[
        0=>'Musbat',
        1=>'Manfiy',
        2=>'Shubhali'
    ]
];
