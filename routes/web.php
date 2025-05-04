<?php

use App\Http\Controllers\clientsController;
use App\Http\Controllers\collectorsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\invetaryController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\menusController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\providersController;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

// RUTA DE LOGIN
Route::get('app', function () {
    return view('source.sesion');
})->name('app');


// RUTAS PÚBLICAS DE AUTENTICACIÓN
Route::post('/login', [loginController::class, 'loginUser'])->name('login');

// Las siguientes rutas están protegidas por auth
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [loginController::class, 'logoutUser'])->name('logout');

    // Menús
    Route::get('/index', [menusController::class, 'mainMenus'])->name('index');
    Route::get('/menusL', [menusController::class, 'menusItemsList'])->name('menusList');
    Route::post('/registerMn', [menusController::class, 'createMenu'])->name('register_mn');
    Route::post('/registerIt', [menusController::class, 'createItem'])->name('register_it');
    Route::post('/editMn', [menusController::class, 'editMenu'])->name('edit_mn');
    Route::post('/editIt', [menusController::class, 'editItem'])->name('edit_it');
    Route::get('/deleteMaI/{id}/{mai}', [menusController::class, 'deleteMai'])->name('delete_mai');

    // Empleados
    Route::get('/registerEc', [employeesController::class, 'employeeR'])->name('registerEc');
    Route::post('/registerE', [employeesController::class, 'registerEmployee'])->name('register_e');
    Route::get('/employees', [employeesController::class, 'searchEmployee'])->name('employeesList');
    Route::get('/employeesE/{id}', [employeesController::class, 'searchEmployeeE'])->name('employeesEdit');
    Route::post('/editEmp/{id}', [employeesController::class, 'editEmployee'])->name('edit_e');
    Route::get('/deleteEmp/{id}', [employeesController::class, 'deleteEmployee'])->name('delete_e');
    Route::post('/editUser', [employeesController::class, 'editUser'])->name('editUser');

    // Inventarios Entrada
    Route::get('/inventaryI', [invetaryController::class, 'inventaryInList'])->name('inventaryI');
    Route::get('/inventaryIf/{tp}', [invetaryController::class, 'inventaryInAdd'])->name('inventaryIf');
    Route::post('/addMovimentIn', [invetaryController::class, 'regMovimentsIn'])->name('addMovimentIn');
    Route::post('/delMov', [invetaryController::class, 'delMoviment'])->name('delMov');
    Route::get('/descInvIn/{id}', [invetaryController::class, 'descInventaryIn'])->name('descInvIn');
    Route::get('/descFac/{id}', [invetaryController::class, 'dwnlBill'])->name('descFac');
    
    
    // Inventarios Salida
    Route::get('/inventaryO', [invetaryController::class, 'inventaryOutList'])->name('inventaryO');
    Route::get('/inventaryOf', [invetaryController::class, 'inventaryOutAdd'])->name('inventaryOf');
    Route::post('/addMovimentOut', [invetaryController::class, 'regMovimentsOut'])->name('addMovimentOut');


    // Productos
    Route::get('/productList', [productsController::class, 'productsList'])->name('productList');
    Route::post('/productR', [productsController::class, 'createProduct'])->name('productR');
    Route::post('/productE', [productsController::class, 'editProduct'])->name('productE');

    // Fuentes
    Route::get('/clientList', [clientsController::class, 'clientsList'])->name('clientList');
    Route::post('/clientR', [clientsController::class, 'createClient'])->name('clientR');
    Route::post('/clientE', [clientsController::class, 'editClient'])->name('clientE');
    
    // Recolectores
    Route::get('/collectorList', [collectorsController::class, 'collectorsList'])->name('collectorList');
    Route::post('/collectorR', [collectorsController::class, 'createCollector'])->name('collectorR');
    Route::post('/collectorE', [collectorsController::class, 'editCollector'])->name('collectorsE');
    
    // Provedores
    Route::get('/providersList', [providersController::class, 'providersList'])->name('providersList');
    Route::post('/providerR', [providersController::class, 'createProvider'])->name('providerR');
    Route::post('/providerE', [providersController::class, 'editProvider'])->name('providerE');
    



});
