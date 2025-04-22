<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\invetaryController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\menusController;
use App\Http\Controllers\positionController;
use App\Http\Controllers\productsController;

// RUTA DE LOGIN
Route::get('app', function () {
    return view('source.sesion');
})->name('app');


// RUTAS PÚBLICAS DE AUTENTICACIÓN
Route::post('/register', [loginController::class, 'registerUser'])->name('register_u');
Route::post('/login', [loginController::class, 'loginUser'])->name('login');

// Las siguientes rutas están protegidas por auth
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [loginController::class, 'logoutUser'])->name('logout');
    
    // Empleados
    Route::get('/registerEc', [employeesController::class, 'employeeR'])->name('registerEc');
    Route::post('/registerE', [employeesController::class, 'registerEmployee'])->name('register_e');
    Route::get('/employees', [employeesController::class, 'searchEmployee'])->name('employeesList');
    Route::get('/employeesE/{id}', [employeesController::class, 'searchEmployeeE'])->name('employeesEdit');
    Route::post('/editEmp/{id}', [employeesController::class, 'editEmployee'])->name('edit_e');
    Route::get('/deleteEmp/{id}', [employeesController::class, 'deleteEmployee'])->name('delete_e');
    Route::post('/editUser', [employeesController::class, 'editUser'])->name('editUser');

    // Cargos
    Route::get('/positions', [positionController::class, 'positionEmployee'])->name('positionList');
    Route::get('/registerP', [positionController::class, 'positionR'])->name('registerP');
    Route::post('/registerEP', [positionController::class, 'registerPosition'])->name('register_ep');
    Route::get('/getPositions/{areaId}/{roleId}', [positionController::class, 'validateArea'])->name('getPositions');
    Route::get('/positionsE/{id}', [positionController::class, 'searchPositionE'])->name('positionsEdit');
    Route::post('/editPos/{id}', [positionController::class, 'editPosition'])->name('edit_pos');
    Route::get('/deletePos/{id}', [positionController::class, 'deletePosition'])->name('delete_pos');

    // Menús
    Route::get('/index', [menusController::class, 'mainMenus'])->name('index');
    Route::get('/menusL', [menusController::class, 'menusItemsList'])->name('menusList');
    Route::post('/registerMn', [menusController::class, 'createMenu'])->name('register_mn');
    Route::post('/registerIt', [menusController::class, 'createItem'])->name('register_it');
    Route::post('/editMn', [menusController::class, 'editMenu'])->name('edit_mn');
    Route::post('/editIt', [menusController::class, 'editItem'])->name('edit_it');
    Route::get('/deleteMaI/{id}/{mai}', [menusController::class, 'deleteMai'])->name('delete_mai');
    
    // Inventarios
    Route::get('/inventaryI', [invetaryController::class, 'inventaryInList'])->name('inventaryI');
    Route::get('/inventaryO', [invetaryController::class, 'inventaryOutList'])->name('inventaryO');
    Route::get('/inventaryIf', [invetaryController::class, 'inventaryInAdd'])->name('inventaryIf');
    Route::post('/inventaryOf', [invetaryController::class, 'inventaryOutAdd'])->name('inventaryOf');

    // Productos
    Route::get('/productList', [productsController::class, 'productsList'])->name('productList');
    Route::post('/productR', [productsController::class, 'createProduct'])->name('productR');
    Route::post('/productE', [productsController::class, 'editProduct'])->name('productE');

    // Máquina
    Route::get('machine', function () { return view('source.tickets'); })->name('machine');
});
