<?php

return [
    'page_title' => 'LMT role manage list',
    'page_header' => 'Role manage list',
    'fields' => [
        'level' => 'Level',
        'name'  => 'Name',
        'role_rank'  => 'Role rank',
        'description'  => 'Description',
        'role_setting' => 'Role setting'
    ],
    'permission_role' => [
        'page_title' => 'Permission setting',
        'page_header' => 'Set permission for role',
        'permission' => 'Permission'
    ],
    
    //label
    'role' => 'Role',
    'role_rank' => 'Role rank',
    'permission' => 'Permission',
    'level' => 'Level',

    //message
    'role_not_found' => 'Role not found!',
    'alert_no_role' => 'Do not have Role, create Role first to create User',
    'warning_role_system' => 'This is a system role, not edited!',
    'no_one_has_permission_set_role' => 'No one has permission set role!',

];
