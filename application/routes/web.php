<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', '')
->defaults(array(
    'controller' => 'auth',
    'action'     => 'index',
));
Route::set('create-invoice', 'invoice/create')
    ->defaults(array(
        'controller' => 'user_paymentinvoice',
        'action'     => 'create',
    ))->filter(function ($route, $params, $request) {
        if ($request->method() !== HTTP_Request::POST || !Security::check($request->headers('x-csrf-token'))) {
            return false; // This route only matches POST requests
        }
    });

Route::set('invoice-update-status', 'invoice/update-status')
    ->defaults(array(
        'controller' => 'admin_paymentinvoice',
        'action'     => 'update',
    ))->filter(function ($route, $params, $request) {
        if ($request->method() !== HTTP_Request::POST || !Security::check($request->headers('x-csrf-token'))) {
            return false; // This route only matches POST requests
        }
    });
    Route::set('update-payment-systems', 'systems/update')
    ->defaults(array(
        'controller' => 'admin_paymentsystem',
        'action'     => 'update',
    ))->filter(function ($route, $params, $request) {
        if ($request->method() !== HTTP_Request::POST || !Security::check($request->headers('x-csrf-token'))) {
            return false; // This route only matches POST requests
        }
    });
Route::set('create-payment-systems', 'systems/create')
    ->defaults(array(
        'controller' => 'admin_paymentsystem',
        'action'     => 'create',
    ))->filter(function ($route, $params, $request) {
        if ($request->method() !== HTTP_Request::POST || !Security::check($request->headers('x-csrf-token'))) {
            return false; // This route only matches POST requests
        }
    });



Route::set('systems', 'systems')
    ->defaults(array(
        'controller' => 'admin_paymentsystem',
        'action'     => 'index',
    ));

Route::set('download-pdf', 'download-pdf/<invoice>', array('invoice' => '\d+'))
    ->defaults(array(
        'controller' => 'admin_paymentinvoice',
        'action'     => 'pdf',
    ));

Route::set('user-dashboard', 'user/dashboard')
    ->defaults(array(
        'controller' => 'user_dashboard',
        'action'     => 'index',
    ));

Route::set('admin-dashboard', 'admin/dashboard')
    ->defaults(array(
        'controller' => 'admin_dashboard',
        'action'     => 'index',
    ));

Route::set('auth', 'auth')
    ->defaults(array(
        'controller' => 'auth',
        'action'     => 'store',
    ))->filter(function ($route, $params, $request) {
        if ($request->method() !== HTTP_Request::POST || !Security::check($request->headers('x-csrf-token'))) {
            return false; // This route only matches POST requests
        }
    });

Route::set('logout', 'logout')
    ->defaults(array(
        'controller' => 'auth',
        'action'     => 'destroy',
    ))->filter(function ($route, $params, $request) {
        if ($request->method() !== HTTP_Request::POST || !Auth::instance()->logged_in() || !Security::check($request->headers('x-csrf-token'))) {
            return false; // This route only matches POST requests and logged users
        }
    });
