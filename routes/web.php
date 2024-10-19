<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'login'])->name('login');
// verifikasi
Route::post('/login/auth', [UserController::class, 'loginAuth'])->name('login.auth');

Route::middleware(['isLogin'])->group(function() {
    // untuk logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    // url : kebab case, name : snack case, controller&function : camel case
    Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing_page');

    // mengelola data laptops
    Route::get('/laptops', [LaptopController::class, 'index'])->name('laptops');
    Route::get('/laptops/add', [LaptopController::class, 'create'])->name('laptops.add');
    Route::post('/laptops/add', [LaptopController::class, 'store'])->name('laptops.add.store');
    // /{namaPathDinamis} : path dinamis, nilainya akan berubah-ubah (harus diisi ketika mengakses route) -> ketika akses di blade nya menjadi href="{{ route('name_route', $isiPathDinamis) }}" atau action="{{ route('name_route', $isiPathDinamis) }}"
    // fungsi path dinamis : spesifikasi data yg akan diproses
    Route::delete('/laptops/delete/{id}', [LaptopController::class, 'destroy'])->name('laptops.delete');
    // edit pake {id} karna perlu spesifikasi data mana yg mau diedit
    Route::get('/laptops/edit/{id}', [LaptopController::class, 'edit'])->name('laptops.edit');
    Route::patch('/laptops/edit/{id}', [LaptopController::class, 'update'])->name('laptops.edit.update');
    // Route::get('laptops/stock', [LaptopController::class, 'updateEdit'])->name('medicine.stok.edit');
    Route::put('/laptops/update-stock/{id}', [LaptopController::class, 'stockEdit'])->name('laptops.stock.edit');

    // halaman login
    // Route::get('/login', [UserController::class, 'pagesLogin'])->name('login');
    Route::get('/akun', [UserController::class, 'index'])->name('akun');
    Route::get('akun/add', [UserController::class, 'create'])->name('akun.add');
    Route::post('akun/add', [UserController::class, 'store'])->name('akun.add.store');
    Route::delete('akun/delete/{id}', [UserController::class, 'destroy'])->name('akun.delete');
    Route::get('akun/edit/{id}', [UserController::class, 'edit'])->name('akun.edit');
    Route::patch('akun/edit/{id}', [UserController::class, 'update'])->name('akun.edit.update');
});

