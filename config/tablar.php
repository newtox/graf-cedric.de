<?php

return [


    'title' => 'Tablar',
    'title_prefix' => '',
    'title_postfix' => '',
    'bottom_title' => 'Tablar',
    'current_version' => 'v4.8',


    'logo' => '<b>Tab</b>LAR',
    'logo_img_alt' => 'Admin Logo',


    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'assets/tablar-logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],


    'views_path' => null,


    'layout' => 'horizontal',


    'layout_light_sidebar' => null,
    'layout_light_topbar' => true,
    'layout_enable_top_header' => false,


    'sticky_top_nav_bar' => false,


    'classes_body' => '',


    'use_route_url' => true,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password.request',
    'password_email_url' => 'password.email',
    'profile_url' => false,
    'setting_url' => false,


    'display_alert' => false,


    'menu' => [

        [
            'text' => 'Home',
            'icon' => 'ti ti-home',
            'url' => 'home'
        ],

        [
            'text' => 'Support 1',
            'url' => '#',
            'icon' => 'ti ti-help',
            'active' => ['support1'],
            'submenu' => [
                [
                    'text' => 'Ticket',
                    'url' => 'support1',
                    'icon' => 'ti ti-article',
                ]
            ],
        ],

        [
            'text' => 'Support 2',
            'url' => '#',
            'icon' => 'ti ti-help',
            'active' => ['support2'],
            'submenu' => [
                [
                    'text' => 'Ticket',
                    'url' => 'support2',
                    'icon' => 'ti ti-article',
                ]
            ],
        ],

        [
            'text' => 'Support 3',
            'url' => '#',
            'icon' => 'ti ti-help',
            'active' => ['support3'],
            'submenu' => [
                [
                    'text' => 'Ticket',
                    'url' => 'support3',
                    'icon' => 'ti ti-article',
                ]
            ],
        ],

    ],


    'filters' => [
        TakiElias\Tablar\Menu\Filters\GateFilter::class,
        TakiElias\Tablar\Menu\Filters\HrefFilter::class,
        TakiElias\Tablar\Menu\Filters\SearchFilter::class,
        TakiElias\Tablar\Menu\Filters\ActiveFilter::class,
        TakiElias\Tablar\Menu\Filters\ClassesFilter::class,
        TakiElias\Tablar\Menu\Filters\LangFilter::class,
        TakiElias\Tablar\Menu\Filters\DataFilter::class,
    ],


    'vite' => true,
];
