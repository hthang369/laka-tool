<?php

return [
    'page_title' => 'LMT user manage',
    'page_header' => 'LMT user manage',
    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'address' => 'Address',
        'password' => 'Password',
        'confirm_password' => 'Password confirmation',
        'roles' => 'Roles'
    ],
    'laka' => [
        'page_title' => 'LAKA user manage',
        'page_header' => 'LAKA user manage',
        'disable' => 'User has disable',
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'company_name' => 'Company Name',
            'company' => 'Company',
            'type_of_user' => 'Type of user',
        ],
        'user_default' => 'User default',
        'is_user_bot' => 'User bot',
        'add_contact_option' => 'Add contact option',
        'add_all_contacts' => 'Add all contact',
        'add_to_all_rooms' => 'Add to all room',
        'contact_header' => 'Laka user update contact',
        'list_contact' => 'Laka user manage',
        'list_approval' => 'Laka user approval',
        'confirm_code' => 'Laka user confirm code',
        'label_confirm_code' => 'Verification code',
        'placeholder_confirm_code' => 'Check email and fill code here',
        'add_all_contact_in_company'=>'Total user has added: :total',
        'approval-token'=>[
            'activate'=>'Token activated',
            'stop'=>'Token stopped',
            'no-accepted'=>'No accepted',
            'accepted'=>'Accepted',
            'pause'=>'Pause',
        ]
    ],
    'validator' => [
        'user_has_been_disabled' => 'User is has been disabled'
    ]
];
