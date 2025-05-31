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

    // Cart routes (pelanggan only)
    $router->group(['prefix' => 'cart'], function () use ($router) {
        $router->get('/', 'CartController@index');
        $router->post('/', 'CartController@store');
        $router->put('/{id}', 'CartController@update');
        $router->delete('/{id}', 'CartController@destroy');
        $router->delete('/clear', 'CartController@clear');
        $router->post('/checkout', 'CartController@checkout');
    });

    // Kategori & Menu: pelanggan boleh akses index (list)
    $router->group(['prefix' => 'kategori'], function () use ($router) {
        $router->get('/', 'KategoriController@index'); // pelanggan bisa akses
    });
    $router->group(['prefix' => 'menu'], function () use ($router) {
        $router->get('/', 'MenuController@index'); // pelanggan bisa akses
        $router->get('/kategoris', 'MenuController@getKategoris'); // pelanggan bisa akses
    });

    // Admin & Manager: full access (tanpa GET index kategori/menu, agar tidak override route pelanggan)
    $router->group(['middleware' => 'role:admin,manager'], function () use ($router) {
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
        // Kategori, Menu, Order, OrderDetail CRUD (admin/manager boleh semua)
        $router->group(['prefix' => 'kategori'], function () use ($router) {
            $router->post('/', 'KategoriController@store');
            $router->get('/{id}', 'KategoriController@show');
            $router->put('/{id}', 'KategoriController@update');
            $router->delete('/{id}', 'KategoriController@destroy');
        });
        $router->group(['prefix' => 'menu'], function () use ($router) {
            $router->post('/', 'MenuController@store');
            $router->get('/{id}', 'MenuController@show');
            $router->put('/{id}', 'MenuController@update');
            $router->delete('/{id}', 'MenuController@destroy');
            // $router->get('/', ...) dan $router->get('/kategoris', ...) sudah di luar group ini
        });
        $router->group(['prefix' => 'orders'], function () use ($router) {
            $router->get('/', 'OrderController@index');
            $router->post('/', 'OrderController@store');
            $router->get('/{id}', 'OrderController@show');
            $router->put('/{id}', 'OrderController@update');
            $router->put('/{id}/status', 'OrderController@updateStatus');
            $router->delete('/{id}', 'OrderController@destroy');
        });
        $router->group(['prefix' => 'orders/{orderId}/details'], function () use ($router) {
            $router->get('/', 'OrderDetailController@index');
            $router->post('/', 'OrderDetailController@store');
            $router->get('/{id}', 'OrderDetailController@show');
            $router->put('/{id}', 'OrderDetailController@update');
            $router->delete('/{id}', 'OrderDetailController@destroy');
        });
    });

    // Kasir: hanya boleh CRUD kategori, menu, order, orderdetail
    $router->group(['middleware' => 'role:kasir'], function () use ($router) {
        $router->group(['prefix' => 'kategori'], function () use ($router) {
            $router->post('/', 'KategoriController@store');
            $router->get('/{id}', 'KategoriController@show');
            $router->put('/{id}', 'KategoriController@update');
            $router->delete('/{id}', 'KategoriController@destroy');
        });
        $router->group(['prefix' => 'menu'], function () use ($router) {
            $router->post('/', 'MenuController@store');
            $router->get('/{id}', 'MenuController@show');
            $router->put('/{id}', 'MenuController@update');
            $router->delete('/{id}', 'MenuController@destroy');
        });
        $router->group(['prefix' => 'orders'], function () use ($router) {
            $router->post('/', 'OrderController@store');
            $router->get('/{id}', 'OrderController@show');
            $router->put('/{id}', 'OrderController@update');
            $router->put('/{id}/status', 'OrderController@updateStatus');
            $router->delete('/{id}', 'OrderController@destroy');
        });
        $router->group(['prefix' => 'orders/{orderId}/details'], function () use ($router) {
            $router->post('/', 'OrderDetailController@store');
            $router->get('/{id}', 'OrderDetailController@show');
            $router->put('/{id}', 'OrderDetailController@update');
            $router->delete('/{id}', 'OrderDetailController@destroy');
        });
    });
});
