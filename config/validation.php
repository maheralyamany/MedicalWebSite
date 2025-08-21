<?php
return [
    'patients' => [
        'rules' => [
            'patientname' => [
                'required' => true,
                'maxlength' => 255,
            ],
            'gender' => [
                'required' => true
            ],
            'mobile' => [
                'required' => false,
                'digits' => true,
            ],
            'age' => [
                'required' => false,
                'digits' => true,
            ],
            'email' => [
                'required' => false,
                'email' => true,
            ],
            'city_id' => [
                'required' => true,
            ]
        ],
        'messages' => [],
    ]
];
