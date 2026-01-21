<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AlatSafetyController;
use App\Http\Controllers\User\PeminjamanAlatController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (biar /dashboard nggak dipakai lagi)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');

})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| ROUTE USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/dashboard', [UserController::class, 'index'])
        ->name('user.dashboard');

});

/*
|--------------------------------------------------------------------------
| Profile bawaan Breeze
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('category', CategoryController::class);
});

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function() {
    Route::resource('alat_safety', AlatSafetyController::class);
});


// User
Route::prefix('user')->middleware(['auth'])->name('user.')->group(function(){
    Route::resource('peminjaman', User\PeminjamanAlatController::class)->only(['index','create','store']);
});

// Admin
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function(){
    Route::get('peminjaman', [App\Http\Controllers\Admin\AdminPeminjamanAlatController::class,'index'])->name('peminjaman.index');

    Route::get('peminjaman/{peminjaman}/approve', [App\Http\Controllers\Admin\AdminPeminjamanAlatController::class,'approve'])->name('peminjaman.approve');
    Route::get('peminjaman/{peminjaman}/reject', [App\Http\Controllers\Admin\AdminPeminjamanAlatController::class,'reject'])->name('peminjaman.reject');
    Route::get('peminjaman/{peminjaman}/pdf', [App\Http\Controllers\Admin\AdminPeminjamanAlatController::class,'generatePdf'])->name('peminjaman.pdf');
    Route::get('peminjaman/{peminjaman}/return', [App\Http\Controllers\Admin\AdminPeminjamanAlatController::class,'returnForm'])->name('peminjaman.return');
    Route::post('peminjaman/{peminjaman}/return', [App\Http\Controllers\Admin\AdminPeminjamanAlatController::class,'returnStore'])->name('peminjaman.return.store');
});

Route::prefix('user')->middleware(['auth'])->name('user.')->group(function(){
    Route::resource('peminjaman', PeminjamanAlatController::class)->only(['index','create','store']);
      Route::get('peminjaman/{peminjaman}/pdf', [PeminjamanAlatController::class,'generatePdf'])->name('peminjaman.pdf');
});

require __DIR__.'/auth.php';
