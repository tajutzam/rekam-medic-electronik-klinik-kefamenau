<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'role']);
$routes->get('/dashboard', 'Home::index', ['filter' => 'role']);
$routes->post('/dashboard', 'Home::cetak', ['filter' => 'role']);
$routes->post('/dashboard/filter', 'Home::filter', ['filter' => 'role']);

$routes->get('/user', 'UserController::index', ['filter' => 'role']);
$routes->post('/user', 'UserController::store', ['filter' => 'role']);
$routes->put('/user/update', 'UserController::update', ['filter' => 'role']);
$routes->get('/user/delete/(:num)', 'UserController::delete/$1', ['as' => 'user.delete', 'filter' => 'role']);

$routes->get('/dokter', 'DokterController::index', ['filter' => 'role']);

$routes->get('/apotik', 'ApotikController::index', ['filter' => 'role']);

$routes->get('/diagnosa', 'DiagnosaController::index', ['filter' => 'role']);
$routes->get('/diagnosa/delete/(:num)', 'DiagnosaController::delete/$1', ['as' => 'diagnosa.delete', 'filter' => 'role'],);
$routes->post('/diagnosa', 'DiagnosaController::store', ['filter' => 'role']);
$routes->post('/diagnosa/update', 'DiagnosaController::update', ['filter' => 'role']);


$routes->get('/obat', 'ObatController::index', ['filter' => 'role']);
$routes->post('/obat', 'ObatController::store', ['filter' => 'role']);
$routes->post('/obat/update', 'ObatController::update', ['filter' => 'role']);
$routes->get('/obat/delete/(:num)', 'ObatController::delete/$1', ['as' => 'obat.delete', 'filter' => 'role'],);

$routes->get('/tindakan', 'TindakanController::index', ['filter' => 'role']);
$routes->post('/tindakan', 'TindakanController::store', ['filter' => 'role']);
$routes->post('/tindakan/update', 'TindakanController::update', ['filter' => 'role']);
$routes->get('/tindakan/delete/(:num)', 'TindakanController::delete/$1', ['filter' => 'role']);


$routes->get('/pendaftaran', 'PendaftaranController::index', ['filter' => 'role']);
$routes->get('/pendaftaran/create', 'PendaftaranController::create', ['filter' => 'role']);
$routes->post('/pendaftaran/create', 'PendaftaranController::store', ['filter' => 'role']);



$routes->get('/rekam-medis', 'RekamMedisController::index', ['filter' => 'role']);
$routes->get('/rekam-medis/cetak-kib/(:segment)', 'RekamMedisController::cetakKib/$1', ['filter' => 'role']);
$routes->get('/rekam-medis/pelayanan/(:segment)', 'RekamMedisController::pelayanan/$1', ['filter' => 'role']);
$routes->get('/rekam-medis/pelayanan/export/pdf/(:segment)', 'AssesmenController::generate_pdf/$1', ['filter' => 'role']);

$routes->get('/rekam-medis/pelayanan/(:segment)/create', 'RekamMedisController::pelayanan_create/$1', ['filter' => 'role']);
$routes->post('/rekam-medis/pelayanan/(:segment)/store', 'RekamMedisController::pelayanan_store/$1', ['filter' => 'role']);
$routes->get('/rekam-medis/anamnesa/(:any)/(:any)', 'RekamMedisController::anamnesa_create/$1/$2', ['filter' => 'role']);
$routes->post('/rekam-medis/anamnesa/(:any)/(:any)', 'AssesmenController::store/$1/$2', ['filter' => 'role']);
$routes->get('/rekam-medis/diagnosa/(:any)/(:any)', 'AssesmenController::diagnosa_create/$1/$2', ['filter' => 'role']);
$routes->post('/rekam-medis/diagnosa/(:any)/(:any)', 'AssesmenController::diagnosa_store/$1/$2', ['filter' => 'role']);

$routes->get('/rekam-medis/obat/(:any)/(:any)', 'AssesmenController::obat_edit/$1/$2', ['filter' => 'role']);
$routes->post('/rekam-medis/obat/(:any)/(:any)', 'AssesmenController::obat_updates/$1/$2', ['filter' => 'role']);
$routes->post('/rekam-medis/tambahobat/(:any)/(:any)', 'AssesmenController::addObat/$1/$2', ['filter' => 'role']);


$routes->post('/rekam-medis/total/(:any)/(:any)', 'AssesmenController::update_total/$1/$2', ['filter' => 'role']);
$routes->get('/rekam-medis/authentikasi/(:any)/(:any)', 'AssesmenController::authentikasi/$1/$2', ['filter' => 'role']);
$routes->post('/rekam-medis/authentikasi/(:any)/(:any)', 'AssesmenController::authentikasi_add/$1/$2', ['filter' => 'role']);


$routes->get("/rekam-medis/pelayanan/delete/(:any)/(:any)" , 'AssesmenController::delete_pelayanan/$1/$2');



$routes->get('/api/rekam-medis/pelayanan/detail/(:any)', 'AssesmenController::getPelayananDetails/$1', ['filter' => 'role']);


$routes->get('/laporan', 'Home::laporan',);
$routes->post('/laporan/cetak', 'Home::cetakLaporanKunjungan');

$routes->post('/laporan/cetak/diagnosa', 'Home::cetakLaporanDiagnosa');
$routes->post('/laporan/cetak/tindakan', 'Home::cetakLaporanTindakan');



$routes->get('/icd', 'IcdController::index');


$routes->get('/pasien', 'PasienController::index');
$routes->get('/pasien/create', 'PasienController::create');
$routes->post('/pasien/store', 'PasienController::store');
$routes->get('/pasien/edit/(:num)', 'PasienController::edit/$1');
$routes->get('/pasien/detail/(:num)', 'PasienController::detail/$1');
$routes->post('/pasien/update/(:num)', 'PasienController::update/$1');
$routes->get('/pasien/delete/(:num)', 'PasienController::delete/$1');

$routes->get('/pasien/print/(:num)', 'PasienController::generatePdf/$1');



// auth

$routes->get('/login', 'AuthenticationController::index');
$routes->post('/login', 'AuthenticationController::login');


$routes->get('logout', 'AuthenticationController::logout');
