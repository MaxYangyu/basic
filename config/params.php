<?php

return [
    'adminEmail' => 'admin@example.com',
    //设置分页显示数据数量
    'pageSize'   =>[
        'manage'=>10,
        'user'  =>10,
        'product' => 10,
        'frontproduct' => 9,
        'order' => 10,
    ],
    'defaultValue' =>[
        'avatar' =>'assets/admin/img/contact-img.png',
    ],
    'express' => [
    1 => '中通快递',
    2 => '顺丰快递',
],
    'expressPrice' => [
    1 => 15,
    2 => 20,
],
];
