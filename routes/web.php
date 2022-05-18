<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdminController;

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
Route::view('/', 'cliente.cliente-inicio');
Route::view('/inicio', 'cliente.cliente-inicio');

////////////Cliente////////////
Route::view('/cliente-login', 'cliente.cliente-login')
    ->middleware('ClienteLogin');
Route::post('/cliente-login', [ClienteController::class, 'login'])
    ->middleware('ClienteLogin');
Route::get('/cliente/logout', [ClienteController::class, 'logout'])
    ->middleware('ClienteAuth');
Route::post('/cliente-login/googleLogin', [ClienteController::class, 'googleLogin'])
    ->middleware('ClienteLogin');
Route::view('/cliente-registrar', 'cliente.cliente-registrar')
    ->middleware('ClienteLogin');
Route::post('/cliente-registrar', [ClienteController::class, 'registrar'])
    ->middleware('ClienteLogin');
Route::get('/cliente-pedidos', [ClienteController::class, 'pedidos'])
    ->middleware('ClienteAuth');
Route::post('/cliente-pedidos', [ClienteController::class, 'pedirCita'])
    ->middleware('ClienteAuth');
Route::post('/cliente-pedidos/cancelar', [ClienteController::class, 'cancelarCita'])
    ->middleware('ClienteAuth');
Route::view('/cliente-perfil', 'cliente.cliente-perfil')
    ->middleware('ClienteAuth');
Route::post('/cliente-perfil', [ClienteController::class, 'editarPerfil'])
    ->middleware('ClienteAuth');

////////////Admin////////////
Route::get('/admin', [AdminController::class, 'inicio'])
    ->middleware('TrabajadorAuth');
Route::view('/admin-login', 'admin.admin-login');
Route::post('/admin-login', [AdminController::class, 'login']);
Route::post('/admin-login/googleLogin', [AdminController::class, 'googleLogin']);
Route::get('/trabajador/logout', [AdminController::class, 'logout']);
Route::view('/admin-registrar', 'admin.admin-registrar');
Route::post('/admin-registrar', [AdminController::class, 'registrar']);
Route::post('/admin/editarCita', [AdminController::class, 'editarCita'])
    ->middleware('TrabajadorAuth');
Route::post('/admin/editarTrabajador', [AdminController::class, 'editarTrabajador'])
    ->middleware('AdministradorAtuh');
