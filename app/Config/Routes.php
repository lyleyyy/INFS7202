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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
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
$routes->get('/', 'Home::index');

// auth routes
$routes->get('/auth', 'Auth::index');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/registerUser', 'Auth::registerUser');
$routes->post('/auth/loginUser', 'Auth::loginUser');
$routes->post('/auth/uploadImage', 'Dashboard::uploadImage');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/auth/forgotpassword', 'Auth::forgotPassword');
$routes->post('/auth/resetpassword', 'Auth::resetPassword');
$routes->post('/auth/resetvalidation', 'Auth::resetValidation');

// login with google
$routes->get('/auth/loginWithGoogle', 'Auth::loginWithGoogle');

// dashboard routes
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/update_email', 'Dashboard::updateEmail');
$routes->post('/dashboard/update_email_action', 'Dashboard::updateEmailAction');
$routes->get('/dashboard/myfavorites', 'Dashboard::myFavorites');
$routes->post('/dashboard/removefavorite', 'Dashboard::removeFavorite');

//Check if user already logged
// $routes->group('', ['filter' => 'AuthCheck'], function($routes) {
//     $routes->get('/dashboard', 'Dashboard::index');
// });

// forum routes
$routes->get('/forum', 'Forum::index');
$routes->get('/forum/create', 'Forum::create');
$routes->post('/forum/store', 'Forum::store');
$routes->post('/forum/search_results', 'Forum::search');
$routes->post('/forum/question_details', 'Forum::questionDetails');
$routes->post('/forum/question_details/storecomment', 'Forum::storeComment');
$routes->get('/forum/question_details/fetchcomment', 'Forum::fetchComment');

$routes->get('/forum/note', 'Forum::note');
$routes->get('/forum/create_note', 'Forum::createNote');
$routes->post('/forum/upload_note', 'Forum::uploadNote');
$routes->get('/forum/note/download', 'Forum::download');

$routes->post('/forum/addtofavorite', 'Forum::addToFavorite');
// ajax
$routes->post('/forum/ajaxstore', 'Forum::ajaxStore');
$routes->get('/forum/ajaxfetch', 'Forum::ajaxFetch');
$routes->get('/forum/autocomplete', 'Forum::autoComplete');
// Donation
$routes->get('/donation', 'Donation::index');

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
