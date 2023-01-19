<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); //ini penting kalian masukkan supaya controller otomatis bisa dipanggil di url tanpa harus di daftarkan di route
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

//auth
$routes->get('/', 'Login::index');
$routes->post('/check', 'Login::checkLogin');
$routes->get('/logout', 'Login::logout');
$routes->get('/regist', 'Register::index');
$routes->get('/register/create', 'Register::create');


//admin
$routes->get('/admin', 'Admin::index');

//admin->guru
$routes->get('/guru', 'Guru::index');
$routes->post('/guru/delete', 'Guru::delete');
$routes->get('/guru/create', 'Guru::pcreate');
$routes->post('/guru/save', 'Guru::create');
$routes->post('/guru/edit', 'Guru::edit');

//admin->general user
$routes->get('/user', 'User::index');
$routes->post('/user/save', 'User::create');

//kepsek
$routes->get('/kepsek', 'Kepsek::index');

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
