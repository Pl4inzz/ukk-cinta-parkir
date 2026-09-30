<?php

use App\Controllers\Core\AuthController;
use App\Controllers\Core\DashboardController;
use App\Controllers\Core\DatabaseController;
use App\Controllers\Core\DocsController;
use App\Controllers\Core\RoleController;
use App\Controllers\Core\UserController;
use App\Controllers\AreaParkirController;
use App\Controllers\TransaksiController;
use Sakuci\Route;

/*
|--------------------------------------------------------------------------
| Route Web
|--------------------------------------------------------------------------
| Daftarkan seluruh route aplikasi di sini.
|
| Cara menulis action:
|   [HomeController::class, 'index']   -> disarankan
|   'HomeController@index'             -> namespace App\Controllers otomatis
|   function () { ... }                -> closure
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/docs', [DocsController::class, 'index'])->name('docs');

/*
|--------------------------------------------------------------------------
| Login multi-role
|--------------------------------------------------------------------------
| Lihat /docs untuk penjelasan lengkap langkah demi langkah.
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt')->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('core.admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('core.admin.users.destroy');
    

    Route::get('/database/export', [DatabaseController::class, 'export'])->name('admin.database.export');

    //Tarif Routes
    Route::get('/tarif', [\App\Controllers\TarifController::class, 'index'])->name('admin.tarif.index');
    Route::get('/tarif/create', [\App\Controllers\TarifController::class, 'create'])->name('admin.tarif.create');
    Route::post('/tarif', [\App\Controllers\TarifController::class, 'store'])->name('admin.tarif.store');
    Route::get('/tarif/{id}/edit', [\App\Controllers\TarifController::class, 'edit'])->name('admin.tarif.edit');
    Route::put('/tarif/{id}', [\App\Controllers\TarifController::class, 'update'])->name('admin.tarif.update');
    Route::delete('/tarif/{id}', [\App\Controllers\TarifController::class, 'destroy'])->name('admin.tarif.destroy');

    //Area Routes
    Route::get('/area', [AreaParkirController::class, 'index'])->name('area.index');
    Route::get('/area/create', [AreaParkirController::class, 'create'])->name('area.create');
    Route::post('/area', [AreaParkirController::class, 'store'])->name('area.store');
    Route::get('/area/{id}/edit', [AreaParkirController::class, 'edit'])->name('area.edit');
    Route::put('/area/{id}', [AreaParkirController::class, 'update'])->name('area.update');
    Route::delete('/area/{id}', [AreaParkirController::class, 'destroy'])->name('area.destroy');

    //Member Routes
    Route::get('/admin/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/admin/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/admin/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/admin/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/admin/members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/admin/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
});

/*
|--------------------------------------------------------------------------
| Route role dinamis
|--------------------------------------------------------------------------
| Blok di bawah ini dikelola otomatis oleh RoleController saat admin
| menambah, mengganti nama, atau menghapus role lewat /admin/roles.
| Jangan diedit manual -- perubahan bisa tertimpa.
*/
// @generated-roles:start

// @role:owner:start
Route::group(['prefix' => 'owner', 'middleware' => 'owner'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('owner.dashboard');
});
// @role:owner:end
// @role:petugas:start
Route::group(['prefix' => 'petugas', 'middleware' => 'petugas'], function () {

    //Dashboard Routes
    Route::get('/', [DashboardController::class, 'petugas'])->name('petugas.dashboard');

    //Parkir Routes
    Route::get('/petugas/transaksi', [TransaksiController::class, 'index'])->name('petugas.transaksi.index');
    Route::get('/petugas/transaksi/masuk', [TransaksiController::class, 'createMasuk'])->name('petugas.transaksi.masuk');
    Route::post('/petugas/transaksi/masuk', [TransaksiController::class, 'storeMasuk'])->name('petugas.transaksi.storeMasuk');

    Route::get('/petugas/transaksi/{id}/keluar', [TransaksiController::class, 'editKeluar'])->name('petugas.transaksi.keluar');
    Route::put('/petugas/transaksi/{id}/keluar', [TransaksiController::class, 'updateKeluar'])->name('petugas.transaksi.updateKeluar');

    Route::get('/petugas/transaksi/{id}/tiket', [TransaksiController::class, 'cetakTiket'])->name('petugas.transaksi.cetakTiket');
    Route::get('/petugas/transaksi/{id}/struk', [TransaksiController::class, 'cetakStruk'])->name('petugas.transaksi.cetakStruk');
    
});
// @role:petugas:end
// @generated-roles:end

/*
|--------------------------------------------------------------------------
| Contoh (hapus/ubah sesuai kebutuhan)
|--------------------------------------------------------------------------
|
| use App\Controllers\BukuController;
|
| Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
|
| // Tujuh route CRUD sekaligus: index, create, store, show, edit, update, destroy
| // Route::resource
|
| // Group dengan prefix dan middleware bersama
| Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
|     Route::get('/dashboard', [DashboardController::class, 'index']);
| });
*/

