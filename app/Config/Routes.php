<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultNamespace(false);
$routes->setDefaultController('Home');
// $routes->setDefaultController(false);
$routes->setDefaultMethod('index');
// $routes->setDefaultMethod(false);
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');

$routes->get('pages/pinjam', 'peminjaman::index');
// $routes->get('/pages/pinjam', 'peminjaman::cr_aset');

// $routes->get('pages/pdfFormatPinjam', 'peminjaman::filePdf');
// $routes->get('pages/pinjam', 'peminjaman::sendEmail');

$routes->get('pages/inventaris', 'inventaris::index');
$routes->get('/inventaris/(:any)', 'inventaris::detail/$1');

// $routes->get('/pages/admin', 'Pages::index');
// $routes->get('/pages/admin/(:num)', 'Pages::edit/$2');
// $routes->delete('/admin/(:num)', 'Pages::delete/$2');

// routes for CRUD admin BEM
$routes->get('pages/admin/adm_bem', 'admin/adm_bem::index', ['filter' => 'role:adm_bem']);
$routes->get('admin/adm_bem', 'admin/adm_bem::index', ['filter' => 'role:adm_bem']);
$routes->get('/pages/admin/adm_bem/:num', 'admin/adm_bem::index');
$routes->get('/pages/admin/adm_bem', 'admin/adm_bem::edit/$1');
$routes->delete('/admin/adm_bem(:num)', 'admin/adm_bem::delete/$1');
// routes for CRUD admin BEM->agenda ormawa
$routes->get('/pages/admin/adm_bem', 'admin/adm_bem::ubah/$1');
$routes->delete('/admin/adm_bem(:num)', 'admin/adm_bem::hapus/$1');
// routes for CRUD admin BEM->peminjaman aset
$routes->get('/pages/admin/adm_bem(:num)', 'admin/adm_bem::edit_a/$1');
$routes->delete('/admin/adm_bem(:num)', 'admin/adm_bem::remove/$1');

// routes for CRUD admin DPM
$routes->get('pages/admin/adm_dpm', 'admin/adm_dpm::index', ['filter' => 'role:adm_dpm']);
$routes->get('admin/adm_dpm', 'admin/adm_dpm::index', ['filter' => 'role:adm_dpm']);
$routes->get('/pages/admin/adm_dpm/:num', 'admin/adm_dpm::index');
$routes->get('/pages/admin/adm_dpm', 'admin/adm_dpm::edit/$1');
$routes->delete('/admin/adm_dpm(:num)', 'admin/adm_dpm::delete/$1');
// routes for CRUD admin DPM->peminjaman aset
$routes->get('/pages/admin/adm_dpm(:num)', 'admin/adm_dpm::edit_a/$1');
$routes->delete('/admin/adm_dpm(:num)', 'admin/adm_dpm::remove/$1');

// routes for CRUD admin LPM
$routes->get('pages/admin/adm_lpm', 'admin/adm_lpm::index', ['filter' => 'role:adm_lpm']);
$routes->get('admin/adm_lpm', 'admin/adm_lpm::index', ['filter' => 'role:adm_lpm']);
$routes->get('/pages/admin/adm_lpm/:num', 'admin/adm_lpm::index');
$routes->get('/pages/admin/adm_lpm', 'admin/adm_lpm::edit/$1');
$routes->delete('/admin/adm_lpm(:num)', 'admin/adm_lpm::delete/$1');
// routes for CRUD admin LPM->peminjaman aset
$routes->get('/pages/admin/adm_lpm(:num)', 'admin/adm_lpm::edit_a/$1');
$routes->delete('/admin/adm_lpm(:num)', 'admin/adm_lpm::remove/$1');

// routes for CRUD admin HIMATIF
$routes->get('pages/admin/adm_himatif', 'admin/adm_himatif::index', ['filter' => 'role:adm_himatif']);
$routes->get('admin/adm_himatif', 'admin/adm_himatif::index', ['filter' => 'role:adm_himatif']);
$routes->get('/pages/admin/adm_himatif/:num', 'admin/adm_himatif::index');
$routes->get('/pages/admin/adm_himatif', 'admin/adm_himatif::edit/$1');
$routes->delete('/admin/adm_himatif(:num)', 'admin/adm_himatif::delete/$1');
// routes for CRUD admin HIMATIF->peminjaman aset
$routes->get('/pages/admin/adm_himatif(:num)', 'admin/adm_himatif::edit_a/$1');
$routes->delete('/admin/adm_himatif(:num)', 'admin/adm_himatif::remove/$1');

// routes for CRUD admin HIMAKOM
$routes->get('pages/admin/adm_himakom', 'admin/adm_himakom::index', ['filter' => 'role:adm_himakom']);
$routes->get('admin/adm_himakom', 'admin/adm_himakom::index', ['filter' => 'role:adm_himakom']);
$routes->get('/pages/admin/adm_himakom/:num', 'admin/adm_himakom::index');
$routes->get('/pages/admin/adm_himakom', 'admin/adm_himakom::edit/$1');
$routes->delete('/admin/adm_himakom(:num)', 'admin/adm_himakom::delete/$1');
// routes for CRUD admin HIMAKOM->peminjaman aset
$routes->get('/pages/admin/adm_himakom(:num)', 'admin/adm_himakom::edit_a/$1');
$routes->delete('/admin/adm_himakom(:num)', 'admin/adm_himakom::remove/$1');

// routes for CRUD admin FINIC
$routes->get('pages/admin/adm_finic', 'admin/adm_finic::index', ['filter' => 'role:adm_finic']);
$routes->get('admin/adm_finic', 'admin/adm_finic::index', ['filter' => 'role:adm_finic']);
$routes->get('/pages/admin/adm_finic/:num', 'admin/adm_finic::index');
$routes->get('/pages/admin/adm_finic', 'admin/adm_finic::edit/$1');
$routes->delete('/admin/adm_finic(:num)', 'admin/adm_finic::delete/$1');
// routes for CRUD admin FINIC->peminjaman aset
$routes->get('/pages/admin/adm_finic(:num)', 'admin/adm_finic::edit_a/$1');
$routes->delete('/admin/adm_finic(:num)', 'admin/adm_finic::remove/$1');

// routes for CRUD admin KINE
$routes->get('pages/admin/adm_kine', 'admin/adm_kine::index', ['filter' => 'role:adm_kine']);
$routes->get('admin/adm_kine', 'admin/adm_kine::index', ['filter' => 'role:adm_kine']);
$routes->get('/pages/admin/adm_kine/:num', 'admin/adm_kine::index');
$routes->get('/pages/admin/adm_kine', 'admin/adm_kine::edit/$1');
$routes->delete('/admin/adm_kine(:num)', 'admin/adm_kine::delete/$1');
// routes for CRUD admin KINE->peminjaman aset
$routes->get('/pages/admin/adm_kine(:num)', 'admin/adm_kine::edit_a/$1');
$routes->delete('/admin/adm_kine(:num)', 'admin/adm_kine::remove/$1');

// routes for CRUD admin FOSTI
$routes->get('pages/admin/adm_fosti', 'admin/adm_fosti::index', ['filter' => 'role:adm_fosti']);
$routes->get('admin/adm_fosti', 'admin/adm_fosti::index', ['filter' => 'role:adm_fosti']);
$routes->get('/pages/admin/adm_fosti/:num', 'admin/adm_fosti::index');
$routes->get('/pages/admin/adm_fosti', 'admin/adm_fosti::edit/$1');
$routes->delete('/admin/adm_fosti(:num)', 'admin/adm_fosti::delete/$1');
// routes for CRUD admin FOSTI->peminjaman aset
$routes->get('/pages/admin/adm_fosti(:num)', 'admin/adm_fosti::edit_a/$1');
$routes->delete('/admin/adm_fosti(:num)', 'admin/adm_fosti::remove/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
