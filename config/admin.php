<?php

return [
    'menu' => [
        [
            'name' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'fas fa-home',
            'permission' => null,
        ],
        [
            'name' => 'Admins',
            'route' => 'admins.index',
            'icon' => 'fas fa-users',
            'permission' => 'admin-list',
        ],
        [
            'name' => 'Roles',
            'route' => 'roles.index',
            'icon' => 'fas fa-user-tag',
            'permission' => 'role-list',
        ],
        [
            'name' => 'Customers',
            'route' => 'customers.index',
            'icon' => 'fas fa-users',
            'permission' => 'user-list',
        ],
        [
            'name' => 'Categories',
            'route' => 'categories.index',
            'icon' => 'fas fa-list',
            'permission' => 'category-list',
        ],
    ],
];
