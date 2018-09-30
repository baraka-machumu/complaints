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

Breadcrumbs::register('roleProfile', function ($trail) {
    $trail->push('RoleProfile', url('roleProfile'));
});

Breadcrumbs::register('assign/profile', function ($trail) {
    $trail->parent('roleProfile');
    $trail->push('Assign/Profile', url('assign/profile'));
});
