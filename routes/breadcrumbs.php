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