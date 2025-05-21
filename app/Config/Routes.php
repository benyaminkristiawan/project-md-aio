<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 */
$routes->get('/', 'AuthController::login', ['as' => 'login']);
$routes->get('register', 'AuthController::register');
$routes->get('login', 'AuthController::login');
$routes->post('register/send', 'AuthController::registration');
$routes->post('login/auth', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

// // User routes (non-admin users)
// $routes->group('user', ['filter' => 'role:user'], function ($routes) {
//     $routes->get('products/step1', 'UsersController::step1');
//     // Other user routes
// });

// Authentication routes
$routes->get('login', 'AuthController::login', ['as' => 'login']);
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');


$routes->group('reset', ['filter' => 'auth'], function ($routes) {
    $routes->get('reset-password', 'AuthController::resetPassword');
    $routes->post('reset_password', 'AuthController::updatePassword');
});
// Routes for Superadmins
$routes->group('superadmin', ['filter' => 'role:superadmin'], function ($routes) {
    $routes->get('dashboard', 'SuperadminController::dashboard');

    $routes->get('product', 'SuperadminController::product');



    $routes->get('sellout', 'Admin\SelloutController::index');
    $routes->post('sellout/save', 'Admin\SelloutController::save');
    $routes->post('sellout/update/(:num)', 'Admin\SelloutController::update/$1');
    $routes->get('sellout/delete/(:num)', 'Admin\SelloutController::delete/$1');


    // User management routes for superadmin
    $routes->get('user', 'Superadmin\UserController::index'); // This should match your directory structure
    $routes->get('user/addUser', 'Superadmin\UserController::addUser');
    $routes->post('user/saveUser', 'Superadmin\UserController::saveUser');
    $routes->get('user/editUser/(:num)', 'Superadmin\UserController::editUser/$1');
    $routes->post('user/resetPassword/(:num)', 'Superadmin\UserController::resetPassword/$1');
    $routes->post('user/updateUser/(:num)', 'Superadmin\UserController::updateUser/$1');
    $routes->get('user/deleteUser/(:num)', 'Superadmin\UserController::deleteUser/$1'); // Correct namespace

    $routes->get('marketplace', 'SuperadminController::marketplace');
    $routes->post('marketplace/saveMarketplace', 'SuperadminController::saveMarketplace');
    $routes->post('marketplace/updateMarketplace/(:num)', 'SuperadminController::updateMarketplace/$1');
    $routes->get('marketplace/deleteMarketplace/(:num)', 'SuperadminController::deleteMarketplace/$1');
});

// Routes for Admin and Superadmin (Admin Management)
$routes->group('admin', ['filter' => 'role:admin,superadmin'], function ($routes) {

    // Admin Dashboard
    $routes->get('dashboard', 'AdminController::dashboard');


    // $routes->get('sellout', 'Admin\SelloutController::index');
    // $routes->post('sellout/save', 'Admin\SelloutController::save');
    // $routes->post('sellout/update/(:num)', 'Admin\SelloutController::update/$1');
    // $routes->get('sellout/delete/(:num)', 'Admin\SelloutController::delete/$1');

    // Program Sellout
    $routes->get('program-sellout', 'Admin\ProgramSelloutController::index');                         // list semua program
    $routes->get('program-sellout/create', 'Admin\ProgramSelloutController::create');                 // form create program
    $routes->post('program-sellout', 'Admin\ProgramSelloutController::store');                        // submit program baru
    $routes->get('program-sellout/detail/(:num)', 'Admin\ProgramSelloutController::detail/$1');       // detail program + form input sellout
    $routes->post('program-sellout/store-sellout/(:num)', 'Admin\ProgramSelloutController::storeSellout/$1'); // submit sellout
    $routes->get('program-sellout/delete/(:num)', 'Admin\ProgramSelloutController::delete/$1');       // hapus program

    $routes->post('program-sellout/import/(:num)', 'Admin\ProgramSelloutController::importExcel/$1');
    $routes->get('program-sellout/export/(:num)', 'Admin\ProgramSelloutController::exportExcel/$1');





    $routes->get('sellin', 'Admin\SellinController::index');
    $routes->post('sellin/create', 'Admin\SellinController::create');
    $routes->post('sellin/add-detail', 'Admin\SellinController::addDetail');
    $routes->get('sellin/delete-detail/(:num)', 'Admin\SellinController::deleteDetail/$1');
    $routes->post('sellin/submit', 'Admin\SellinController::submit');

    // Brand Management
    $routes->get('brand', 'Admin\BrandController::index');
    $routes->post('brand/saveBrand', 'Admin\BrandController::saveBrand');
    $routes->post('brand/updateBrand/(:num)', 'Admin\BrandController::updateBrand/$1');
    $routes->get('brand/deleteBrand/(:num)', 'Admin\BrandController::deleteBrand/$1');

    // Kategori Management
    $routes->get('kategori', 'Admin\KategoriController::index');
    $routes->post('kategori/saveKategori', 'Admin\KategoriController::saveKategori');
    $routes->post('kategori/updateKategori/(:num)', 'Admin\KategoriController::updateKategori/$1');
    $routes->get('kategori/deleteKategori/(:num)', 'Admin\KategoriController::deleteKategori/$1');

    // Campaign Management
    $routes->get('campaign', 'Admin\CampaignController::index');
    $routes->post('campaign/saveCampaign', 'Admin\CampaignController::saveCampaign');
    $routes->post('campaign/updateCampaign/(:num)', 'Admin\CampaignController::updateCampaign/$1');
    $routes->get('campaign/deleteCampaign/(:num)', 'Admin\CampaignController::deleteCampaign/$1');

    // Reward Management
    $routes->get('reward', 'Admin\RewardController::index');
    $routes->post('admin/reward/saveReward', 'Admin\RewardController::saveReward');
    $routes->post('admin/reward/updateReward/(:num)', 'Admin\RewardController::updateReward/$1');
    $routes->get('admin/reward/deleteReward/(:num)', 'Admin\RewardController::deleteReward/$1');

    // Subkategori Management
    $routes->get('subkategori', 'Admin\SubkategoriController::index');
    $routes->post('subkategori/saveSubkategori', 'Admin\SubkategoriController::saveSubkategori');
    $routes->post('subkategori/updateSubkategori/(:num)', 'Admin\SubkategoriController::updateSubkategori/$1');
    $routes->get('subkategori/deleteSubkategori/(:num)', 'Admin\SubkategoriController::deleteSubkategori/$1');

    // Kapasitas Management
    $routes->get('kapasitas', 'Admin\KapasitasController::index');
    $routes->post('kapasitas/saveKapasitas', 'Admin\KapasitasController::saveKapasitas');
    $routes->post('kapasitas/updateKapasitas/(:num)', 'Admin\KapasitasController::updateKapasitas/$1');
    $routes->get('kapasitas/deleteKapasitas/(:num)', 'Admin\KapasitasController::deleteKapasitas/$1');
});



$routes->get('no-access', 'AuthController::NoAccess');
