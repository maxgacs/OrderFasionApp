<?php

use Illuminate\Support\Facades\Route;
use Manager\usersController;

use App\Http\Livewire\Crud;

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

Route::get('/', function () {
    return view('fashion');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/charts2', function () {
    return view('charts2');
})->name('charts2');

Route::middleware(['auth:sanctum', 'verified'])->get('/products', function () {
    return view('products');
})->name('products');

Route::middleware(['auth:sanctum', 'verified'])->get('/members', function () {
    return view('members');
})->name('members');

Route::middleware(['auth:sanctum', 'verified'])->get('/emps', function () {
    return view('emps');
})->name('emps');

Route::middleware(['auth:sanctum', 'verified'])->get('/materials', function () {
    return view('materials');
})->name('materials');

Route::middleware(['auth:sanctum', 'verified'])->get('/material_sps', function () {
    return view('material_sps');
})->name('material_sps');

Route::middleware(['auth:sanctum', 'verified'])->get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/redirects', [App\Http\Controllers\HomeController::class, 'index']);



Route::resource('manager/users', usersController::class);

Route::resource('userss', Crud::class);