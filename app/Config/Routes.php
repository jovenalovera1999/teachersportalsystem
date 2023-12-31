<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
# $routes->get('/', 'Home::index');

$routes->get('/', 'Login::login');
$routes->post('/', 'Login::login');

$routes->group('', ['filter' => 'AuthUser'], function($routes) 
{
    $routes->get('/dean/dashboard', 'Dean::dashboard');
    $routes->get('/teacher/dashboard', 'Teacher::dashboard');
    $routes->get('/teacher/list', 'Teacher::list');
    $routes->get('/teacher/register', 'Teacher::register');
    $routes->post('/teacher/register', 'Teacher::register');
    $routes->get('/teacher/view/(:num)', 'Teacher::view/$1');
    $routes->get('/teacher/edit/(:num)', 'Teacher::edit/$1');
    $routes->post('/teacher/edit/(:num)', 'Teacher::edit/$1');
    $routes->get('teacher/delete/(:num)', 'Teacher::delete/$1');
    $routes->post('teacher/delete/(:num)', 'Teacher::delete/$1');
    $routes->get('/student/list', 'Student::list');
    $routes->get('/student/add', 'Student::add');
    $routes->post('/student/add', 'Student::add');
    $routes->get('/student/view/(:num)', 'Student::view/$1');
    $routes->get('/student/edit/(:num)', 'Student::edit/$1');
    $routes->post('/student/edit/(:num)', 'Student::edit/$1');
    $routes->get('/student/delete/(:num)', 'Student::delete/$1');
    $routes->post('/student/delete/(:num)', 'Student::delete/$1');
    $routes->get('/confirm_logout', 'Login::confirmLogout');
    $routes->get('/logout', 'Login::logout');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
