<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */

// Route::get('/', 'App\Http\Controllers\MediquadminController@dashboard_1');
Route::get('/index', 'MediquadminController@dashboard_1');
Route::get('/doctors', 'MediquadminController@doctor_index');
Route::get('/doctors-details', 'MediquadminController@doctors_details');
Route::get('/doctors-review', 'MediquadminController@doctors_review');
Route::get('/patient-details', 'MediquadminController@patient_details');

Route::get('/app-calender', 'MediquadminController@app_calender');
Route::get('/app-profile', 'MediquadminController@app_profile');
Route::get('/chart-chartist', 'MediquadminController@chart_chartist');
Route::get('/chart-chartjs', 'MediquadminController@chart_chartjs');
Route::get('/chart-flot', 'MediquadminController@chart_flot');
Route::get('/chart-morris', 'MediquadminController@chart_morris');
Route::get('/chart-peity', 'MediquadminController@chart_peity');
Route::get('/chart-sparkline', 'MediquadminController@chart_sparkline');
Route::get('/ecom-checkout', 'MediquadminController@ecom_checkout');
Route::get('/ecom-customers', 'MediquadminController@ecom_customers');
Route::get('/ecom-invoice', 'MediquadminController@ecom_invoice');
Route::get('/ecom-product-detail', 'MediquadminController@ecom_product_detail');
Route::get('/ecom-product-grid', 'MediquadminController@ecom_product_grid');
Route::get('/ecom-product-list', 'MediquadminController@ecom_product_list');
Route::get('/ecom-product-order', 'MediquadminController@ecom_product_order');
Route::get('/email-compose', 'MediquadminController@email_compose');
Route::get('/email-inbox', 'MediquadminController@email_inbox');
Route::get('/email-read', 'MediquadminController@email_read');
Route::get('/form-editor-summernote', 'MediquadminController@form_editor_summernote');
Route::get('/form-element', 'MediquadminController@form_element');
Route::get('/form-pickers', 'MediquadminController@form_pickers');
Route::get('/form-validation-jquery', 'MediquadminController@form_validation_jquery');
Route::get('/form-wizard', 'MediquadminController@form_wizard');
Route::get('/map-jqvmap', 'MediquadminController@map_jqvmap');
Route::get('/page-error-400', 'MediquadminController@page_error_400');
Route::get('/page-error-403', 'MediquadminController@page_error_403');
Route::get('/page-error-404', 'MediquadminController@page_error_404');
Route::get('/page-error-500', 'MediquadminController@page_error_500');
Route::get('/page-error-503', 'MediquadminController@page_error_503');
Route::get('/page-forgot-password', 'MediquadminController@page_forgot_password');
Route::get('/page-lock-screen', 'MediquadminController@page_lock_screen');
Route::get('/page-login', 'MediquadminController@page_login');
Route::get('/page-register', 'MediquadminController@page_register');
Route::get('/table-bootstrap-basic', 'MediquadminController@table_bootstrap_basic');
Route::get('/table-datatable-basic', 'MediquadminController@table_datatable_basic');
Route::get('/uc-nestable', 'MediquadminController@uc_nestable');
Route::get('/uc-noui-slider', 'MediquadminController@uc_noui_slider');
Route::get('/uc-select2', 'MediquadminController@uc_select2');
Route::get('/uc-sweetalert', 'MediquadminController@uc_sweetalert');
Route::get('/uc-toastr', 'MediquadminController@uc_toastr');
Route::get('/ui-accordion', 'MediquadminController@ui_accordion');
Route::get('/ui-alert', 'MediquadminController@ui_alert');
Route::get('/ui-badge', 'MediquadminController@ui_badge');
Route::get('/ui-button', 'MediquadminController@ui_button');
Route::get('/ui-button-group', 'MediquadminController@ui_button_group');
Route::get('/ui-card', 'MediquadminController@ui_card');
Route::get('/ui-carousel', 'MediquadminController@ui_carousel');
Route::get('/ui-dropdown', 'MediquadminController@ui_dropdown');
Route::get('/ui-grid', 'MediquadminController@ui_grid');
Route::get('/ui-list-group', 'MediquadminController@ui_list_group');
Route::get('/ui-media-object', 'MediquadminController@ui_media_object');
Route::get('/ui-modal', 'MediquadminController@ui_modal');
Route::get('/ui-pagination', 'MediquadminController@ui_pagination');
Route::get('/ui-popover', 'MediquadminController@ui_popover');
Route::get('/ui-progressbar', 'MediquadminController@ui_progressbar');
Route::get('/ui-tab', 'MediquadminController@ui_tab');
Route::get('/ui-typography', 'MediquadminController@ui_typography');
Route::get('/widget-basic', 'MediquadminController@widget_basic');


//public routes
Route::get('/', function () {
    return response()->json();
});


//admin auth routes
Route::group(['prefix' => 'admin'], function () {
    // Route::get('/create', 'AdminLoginController@create');
    Route::get('/', 'AdminLoginController@index')->name('admin.loginForm');
    Route::post('/', 'AdminLoginController@authenticate')->name('admin.login');
    Route::get('/test', 'AdminController@test');
});

//admin routes
// Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    //games routes
    Route::get('/games', 'GameController@games')->name('admin.games');
    Route::get('/games/create', 'GameController@create')->name('admin.games.create');
    Route::post('/games/store', 'GameController@store')->name('admin.games.store');
    Route::get('/games/settings', 'GameController@settings')->name('admin.games.settings');
    Route::get('/games/{id}', 'GameController@get')->name('admin.games.get');

    //genre routes
    Route::post('/genre/store', 'GameController@storeGenre')->name('admin.genre.store');
    Route::post('/genre/delete/{id}', 'GameController@deleteGenre')->name('admin.genre.delete');

    //gameMode routes
    Route::post('/gameMode/store', 'GameController@storeGameMode')->name('admin.gameMode.store');
    Route::post('/gameMode/delete/{id}', 'GameController@deleteGameMode')->name('admin.gameMode.delete');

    Route::get('/logout', 'AdminLoginController@logout')->name('admin.logout');
});
