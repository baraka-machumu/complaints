<?php
 use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

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



