<?php



$menu =  [

    'title' => 'Complaints',

    'title_prefix' => '',

    'title_postfix' => '',



    'logo' => '<b>Complaints</b>',

    'logo_mini' => '<b>A</b>LT',



    'skin' => 'blue',



    'layout' => null,

    'collapse_sidebar' => false,



    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',


    'menu' => [
        [
            'text' => 'Home',
            'url'  => 'dashboard',
            'icon' => 'home',
        ],

        [
            'text' => 'Advanced Search',
            'url'  => 'search/form',
            'icon' => 'th',
        ],
        [
            'text' => 'Fuatilia Lalamiko',
            'url'  =>'#',
            'icon' => 'th',


        ],
        [
            'text' => 'Registration',
            'url'  => 'complaints/create',
            'icon' => 'th',
            'can'=>'islogin'
        ],
        [
            'text'    => 'Complaints',
            'icon'    => 'th',
            'url'      => 'complaint/tab',
            'url'     =>'complaints/tab',
            'can'=>'islogin'



        ],


        [
            'text'    => 'Report',
            'url'     =>'report/select',
            'icon'    => 'th',
            'can'=>'islogin'
        ],
        [
            'text'    => 'System user Setting',
            'icon'    => 'th',
            'submenu' => [

                [
                    'text' => 'Register Complaints Type',
                    'url'  => 'complaints-types/create',
                ],
                [
                    'text' => 'Register User',
                    'url'  => 'user/register',
                ],

                [
                    'text' => 'View All User',
                    'url'  => '#',
                ],

                [
                    'text' => 'Create Role',
                    'url'  => 'role/create',
                ],

                [
                    'text' => 'Create Profile',
                    'url'  => 'profile/create',
                ],
                [
                    'text' => 'View Role Profile',
                    'url'  => 'roleProfile',
                ],
                [
                    'text' => 'View User Profile',
                    'url'  => 'userProfile/',
                ],





            ],
            'can'=>'islogin'
        ],

    ],



    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],


    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];


    return $menu;
