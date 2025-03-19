<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CsvExportController;

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

Route::get('/', [ContactController::class, 'index'])->name('index');
Route::post('confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('store', [ContactController::class, 'store'])->name('store');
Route::post('/thanks', [ContactController::class, 'thanks'])->name('thanks');

Route::get('/admin', [CategoryController::class, 'admin'])->name('admin');
Route::delete('/api/contacts/{id}', [ContactController::class, 'destroy']);

Route::get('/export-csv', [CsvExportController::class, 'export'])->name('export.csv');
