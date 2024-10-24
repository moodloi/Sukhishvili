<?php

return [

    'label' => 'გვერდების ნავიგაცია',

    'overview' => '{1} ნაჩვენებია 1 შედეგი|[2,*] ნაჩვენებია :first-დან :last-მდე (სულ :total)',

    'fields' => [

        'records_per_page' => [

            'label' => 'ნაჩვენებია',

            'options' => [
                'all' => 'ყველა',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'პირველი',
        ],

        'go_to_page' => [
            'label' => 'გადასვლა :page გვერდზე',
        ],

        'last' => [
            'label' => 'ბოლო',
        ],

        'next' => [
            'label' => 'შემდეგი',
        ],

        'previous' => [
            'label' => 'წინა',
        ],

    ],

];
