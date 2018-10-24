<?php
 use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


 // by machumu...
Breadcrumbs::register('home', function ($trail) {
    $trail->push('Home', url('/'));
});
   Breadcrumbs::register('user', function ($trail) {
       $trail->parent('home');
       $trail->push('User', url('/user'));
   });
Breadcrumbs::register('register', function ($trail) {
    $trail->parent('user');
    $trail->push('Register', url('user/register'));
});


Breadcrumbs::register('report',function ($trail){

    $trail->push('Report',url('report'));

});


Breadcrumbs::register('report_select',function ($trail){

    $trail->parent('report');
    $trail->push('Select',url('report'));

});

//fetty
Breadcrumbs::register('role', function ($trait)
{
    $trait->push('Role', url('role'));
});

Breadcrumbs::register('role/create', function ($trail)
{
   $trail->parent('role');
   $trail->push('Create', url('role/create'));
});
Breadcrumbs::register('assign/role', function ($trail) {
    $trail->parent('role');
    $trail->push('roleProfile', url('roleProfile/assign/role'));
});





Breadcrumbs::register('roleProfile', function ($trail) {
    $trail->push('RoleProfile', url('roleProfile'));
});

Breadcrumbs::register('assign/profile', function ($trail) {
    $trail->parent('roleProfile');
    $trail->push('Assign/Profile', url('assign/profile'));
});
