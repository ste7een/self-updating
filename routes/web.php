<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dd;

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

// Route::get('/update', function () {
//     Artisan::call('newUpdate');
// })->name('update');

Route::get('/', [dd::class, 'dd'])->name('test');
Route::get('/update', [dd::class, 'update'])->name('update');


