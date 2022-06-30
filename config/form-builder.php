<?php
return [
    'layout'         => [
        'groups'    => false,
        'inline'    => false,
        'grid'      => true
    ],
    'defaults'      => [
        'wrapper_class'       => 'form-row',
        'wrapper_error_class' => 'has-error',
        'label_class'         => ['col-sm-3', 'col-form-label'],
        'field_wrapper'       => 'col-sm-9',
        'field_class'         => 'form-control',
        'field_error_class'   => '',
        'help_block_class'    => 'help-block',
        'error_class'         => 'text-danger',
        'required_class'      => 'required'

        // Override a class from a field.
        //'text'                => [
        //    'wrapper_class'   => 'form-field-text',
        //    'label_class'     => 'form-field-text-label',
        //    'field_class'     => 'form-field-text-field',
        //]
        //'radio'               => [
        //    'choice_options'  => [
        //        'wrapper'     => ['class' => 'form-radio'],
        //        'label'       => ['class' => 'form-radio-label'],
        //        'field'       => ['class' => 'form-radio-field'],
        //],
    ],

    'custom_fields' => [
//        'datetime' => App\Forms\Fields\Datetime::class
    ]
];
