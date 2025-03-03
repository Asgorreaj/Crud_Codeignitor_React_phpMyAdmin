<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ✅ CORS-Enabled API Routes for Products
$routes->group('', ['filter' => 'cors'], function ($routes) {
    $routes->resource('products');  // RESTful Routes for Product CRUD
    $routes->get('products', 'ProductController::index');  // Get product list
    $routes->post('products', 'ProductController::store'); // Add a new product
    $routes->put('products/(:num)', 'ProductController::update/$1'); // Update product
    $routes->delete('products/(:num)', 'ProductController::delete/$1'); // Delete product
});

// ✅ CORS-Enabled API Routes for Users
$routes->group('api', ['filter' => 'cors'], function ($routes) {
    $routes->get('users', 'UserController::index');
});

// ✅ Additional API Versioning (if needed)
$routes->group('api/v1', ['filter' => 'cors'], function ($routes) {
    // Add versioned routes here...
});
