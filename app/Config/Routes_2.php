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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
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
$routes->get('/', 'Home::index');


$routes->group('person', ['filter' => 'UserActionSaved'], function ($routes) {
    $routes->get('show/delete', 'Person::show_delete');
    $routes->get('show/active/(:num)/(:num)', 'Person::active_not_active/$1/$2');
    $routes->get('show', 'Person::index');
    $routes->get('add', 'Person::add');
    $routes->get('add/(:num)', 'Person::add/$1');
    $routes->post('insert', 'Person::insert');
    $routes->get('editPerson/(:num)', 'Person::editPerson/$1');
    $routes->post('update/(:num)', 'Person::update/$1');

    $routes->get('upload/file', 'Person::uploadFile');
    $routes->post('upload/csv', 'Person::uploadCsv');
    $routes->post('chickPid/pid', 'Person::chickPid');

    $routes->get('upload/file/block', 'Person::uploadFile_block');
    $routes->post('upload/csv/block', 'Person::uploadCsv_block');

    $routes->get('data/search', 'Person::felter');
    $routes->post('data/felter/get', 'Person::get_table_data');

    $routes->get('upload/file/Block', 'Person::uploadFileBlock');
    $routes->post('upload/csv/Block', 'Person::uploadCsvBlock');

    $routes->post('data/search/export', 'Person::get_table_data_export');

});
$routes->group('export', ['filter' => 'UserActionSaved'], function ($routes) {
    $routes->get('filter/pid/data', 'exportControler::filter');
    $routes->post('filterExportData', 'exportControler::filterExportData');
    $routes->get('exportAidsFromPerson/(:num)', 'exportControler::exportAidsFromPerson/$1');
    $routes->get('filter/generalReport', 'exportControler::general_report');
    $routes->post('filterExportData/without/pid', 'exportControler::filterExportDataWithoutPid');

});

$routes->group('block', ['filter' => 'UserActionSaved'], function ($routes) {
    $routes->get('show', 'blockControler::show');
    $routes->get('ExportData/(:num)', 'blockControler::ExportData/$1');
    $routes->get('showPerson/(:num)', 'blockControler::showPerson/$1');

    $routes->get('add', 'blockControler::add');
    $routes->post('insert', 'blockControler::insert');

    $routes->get('edit/(:num)', 'blockControler::edit/$1');
    $routes->post('update/(:num)', 'blockControler::update/$1');

});

$routes->group('AdisManage', ['filter' => 'UserActionSaved'], function ($routes) {
    $routes->get('show', 'AdisManageControler::index');
    $routes->get('addCobon', 'AdisManageControler::addCobon');
    $routes->post('add', 'AdisManageControler::insert');

    $routes->get('updateCobon/(:num)', 'AdisManageControler::updateCobon/$1');
    $routes->post('update', 'AdisManageControler::update');

    $routes->post('addAidsFromGroup', 'AdisManageControler::addAidsFromGroup');

    $routes->get('addAidsFromPerson/(:num)', 'AdisManageControler::addAidsFromPerson/$1');
    $routes->get('addAidsFromPerson/(:num)/(:num)', 'AdisManageControler::addAidsFromPerson/$1/$1');
    $routes->post('addAidsFromPersonInsert', 'AdisManageControler::addAidsFromPersonInsert');
    $routes->post('deleteAidsFromPersonInsert', 'AdisManageControler::deleteAidsFromPersonInsert');
    $routes->get('viewAidsFromPerson/(:num)/(:num)', 'AdisManageControler::showAidsFromPerson/$1/$1');
    $routes->get('viewAidsFromPerson/(:num)', 'AdisManageControler::showAidsFromPerson/$1');
    $routes->get('viewAidsPerson/(:num)', 'AdisManageControler::viewAidsPerson/$1');
    $routes->get('addAidsPersonIds/(:num)', 'AdisManageControler::addAidsIdsPerson/$1');
    $routes->post('addAidsPersonIds/add/(:num)', 'AdisManageControler::addAidsIdsPersonAdd/$1');
});

$routes->group('Report', ['filter' => 'UserActionSaved'], function ($routes) {
    $routes->get('aid_p/(:num)', 'ReportController::aid_p/$1');
    $routes->get('aid/person/(:num)/(:num)', 'ReportController::aid_person/$1/$2');
    $routes->get('aid_p/person/(:num)', 'ReportController::aid_p_person/$1');
    $routes->get('block/person/(:num)/(:num)/(:num)', 'ReportController::block_person/$1/$2/$3');
});

$routes->group('personBlock', ['filter' => 'UserActionSaved'], function ($routes) {
    $routes->get('show', 'blockPersonControler::index');
    $routes->get('add', 'blockPersonControler::add');
    $routes->get('add/(:num)', 'blockPersonControler::add/$1');
    $routes->post('insert', 'blockPersonControler::insert');
    $routes->get('editPerson/(:num)', 'blockPersonControler::editPerson/$1');
    $routes->post('update/(:num)', 'blockPersonControler::update/$1');

    $routes->get('upload/file', 'blockPersonControler::uploadFile');
    $routes->post('upload/csv', 'blockPersonControler::uploadCsv');

});


$routes->group('User', ['filter' => 'UserActionSaved'], function ($routes) {
    $routes->get('change/status/(:num)/(:num)', 'userControler::change_status/$1/$2');
    $routes->get('show', 'userControler::index');
    $routes->get('Group/(:num)', 'userControler::Group/$1');
    $routes->post('update/block/group', 'userControler::insert_update_group_blocks');

    $routes->get('update/(:num)', 'userControler::editUser/$1');
    $routes->post('update/data/(:num)', 'userControler::update/$1');

    $routes->get('add', 'userControler::add/$1');
    $routes->post('insert/data', 'userControler::insert');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
