<?php

return [
    'shield_resource' => [
        'should_register_navigation' => true,
        'slug' => 'system/roles',
        'navigation_sort' => 2,
        'navigation_badge' => true,
        'navigation_group' => true,
        'is_globally_searchable' => false,
        'show_model_path' => false,
    ],

    'auth_provider_model' => [
        'fqcn' => 'App\\Models\\User',
    ],

    'super_admin' => [
        'enabled' => false,
        'name' => 'super_admin',
        'define_via_gate' => false,
        'intercept_gate' => 'before', // after
    ],

    'filament_user' => [
        'enabled' => false,
        'name' => 'filament_user',
    ],

    'permission_prefixes' => [
        'resource' => [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
        ],

        'page' => 'page',
        'widget' => 'widget',
    ],

    'entities' => [
        'pages' => true,
        'widgets' => true,
        'resources' => true,
        'custom_permissions' => false,
    ],

    'generator' => [
        'option' => 'policies_and_permissions',
    ],

    'exclude' => [
        'enabled' => true,

        'pages' => [],

        'widgets' => [
            'AccountWidget',
        ],

        'resources' => [],
    ],

    'register_role_policy' => [
        'enabled' => true,
    ],
];
