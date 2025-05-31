<?php

/** @var Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
$router->group(['prefix' => 'api'], function () use ($router) {
    // Customer auth routes
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');
    });

    // Staff auth routes
    $router->group(['prefix' => 'staff/auth'], function () use ($router) {
        $router->post('register', 'StaffAuthController@register');
        $router->post('login', 'StaffAuthController@login');
    });
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    // Customer auth routes
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('logout', 'AuthController@logout');
        $router->get('me', 'AuthController@me');
    });

    // Staff auth routes
    $router->group(['prefix' => 'staff/auth'], function () use ($router) {
        $router->post('logout', 'StaffAuthController@logout');
        $router->get('me', 'StaffAuthController@me');
    });

    // Cart routes
    $router->group(['prefix' => 'cart'], function () use ($router) {
        $router->get('/', 'CartController@index');
        $router->post('/', 'CartController@store');
        $router->put('/{id}', 'CartController@update');
        $router->delete('/{id}', 'CartController@destroy');
        $router->delete('/clear', 'CartController@clear');
        $router->post('/checkout', 'CartController@checkout');
    });

    // Admin and Manager routes (full access)
    $router->group(['middleware' => ['admin_or_manager']], function () use ($router) {
        // Customer management
        $router->group(['prefix' => 'pelanggan'], function () use ($router) {
            $router->get('/', 'PelangganController@index');
            $router->post('/', 'PelangganController@store');
            $router->get('/{id}', 'PelangganController@show');
            $router->put('/{id}', 'PelangganController@update');
            $router->delete('/{id}', 'PelangganController@destroy');
            $router->post('/{id}/restore', 'PelangganController@restore');
        });

        // Staff management
        $router->group(['prefix' => 'staff'], function () use ($router) {
            $router->get('/', 'StaffController@index');
            $router->post('/', 'StaffController@store');
            $router->get('/{id}', 'StaffController@show');
            $router->put('/{id}', 'StaffController@update');
            $router->delete('/{id}', 'StaffController@destroy');
            $router->post('/{id}/restore', 'StaffController@restore');
        });

        // Reports
        $router->get('/reports', 'ReportController@index');
    });

    // Shared routes for admin, manager, and kasir
    $router->group(['middleware' => 'role:admin,manager,kasir'], function () use ($router) {
        // Category routes
        $router->group(['prefix' => 'kategori'], function () use ($router) {
            $router->get('/', 'KategoriController@index');
            $router->post('/', ['middleware' => 'admin_or_manager', 'uses' => 'KategoriController@store']);
            $router->get('/{id}', 'KategoriController@show');
            $router->put('/{id}', ['middleware' => 'admin_or_manager', 'uses' => 'KategoriController@update']);
            $router->delete('/{id}', ['middleware' => 'admin_or_manager', 'uses' => 'KategoriController@destroy']);
        });

        // Menu routes
        $router->group(['prefix' => 'menu'], function () use ($router) {
            $router->get('/', 'MenuController@index');
            $router->post('/', ['middleware' => 'admin_or_manager', 'uses' => 'MenuController@store']);
            $router->get('/{id}', 'MenuController@show');
            $router->put('/{id}', ['middleware' => 'admin_or_manager', 'uses' => 'MenuController@update']);
            $router->delete('/{id}', ['middleware' => 'admin_or_manager', 'uses' => 'MenuController@destroy']);
            $router->get('/kategoris', 'MenuController@getKategoris');
        });

        // Order routes
        $router->group(['prefix' => 'orders'], function () use ($router) {
            $router->get('/', 'OrderController@index');
            $router->post('/', 'OrderController@store');
            $router->get('/{id}', 'OrderController@show');
            $router->put('/{id}', 'OrderController@update');
            $router->put('/{id}/status', 'OrderController@updateStatus');
            $router->delete('/{id}', ['middleware' => 'admin_or_manager', 'uses' => 'OrderController@destroy']);
        });

        // Order details routes
        $router->group(['prefix' => 'orders/{orderId}/details'], function () use ($router) {
            $router->get('/', 'OrderDetailController@index');
            $router->post('/', 'OrderDetailController@store');
            $router->get('/{id}', 'OrderDetailController@show');
            $router->put('/{id}', 'OrderDetailController@update');
            $router->delete('/{id}', ['middleware' => 'admin_or_manager', 'uses' => 'OrderDetailController@destroy']);
        });
    });
});
