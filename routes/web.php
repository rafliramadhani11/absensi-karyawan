<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\AdminController;

Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('CheckUser');
Route::post('/', [AuthController::class, 'authentication']);
Route::post('logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');

/**
Route::get('/hadir/{user:id}', function (User $user) {
    dd($user);
})->name('user.hadir');
 */

Route::middleware(['auth', 'user'])->controller(UserController::class)->group(function () {
    Route::get('/profile', 'profile')->name('user.profile');
    Route::get('/profile/{user:slug}', 'edit')->name('user.edit');
    Route::put('/profile/{user:slug}/update', 'update')->name('user.update');

    Route::get('/data-kehadiran', 'kehadiran')->name('user.kehadiran');
    Route::get('/data-kehadiran/izin-hadir', 'izin')->name('user.izin');
    Route::get('/pemantauan-gaji', 'pemantauanGaji')->name('user.pemantauanGaji');
    Route::get('/data-absensi-pegawai', 'absensi')->name('user.absensi');

    Route::get('/hadir', 'hadir')->name('user.hadir');
    Route::get('/pulang', 'pulang')->name('user.pulang');

    Route::post('/izin', 'izinAction')->name('user.aksi.izin');
});

Route::middleware(['auth', 'admin'])->controller(AdminController::class)->group(function () {
    Route::get('/data-pegawai', 'index')->name('admin.index');
    Route::get('/data-pegawai/add-pegawai', 'add')->name('admin.add.user');
    Route::get('/data-pegawai/info-pegawai/{user:slug}', 'show')->name('admin.show.user');
    Route::get('/data-pegawai/info-pegawai/edit/{user:slug}', 'edit')->name('admin.edit.user');
    Route::get('/data-pegawai/info-absensi/{user:slug}', 'userAbsensi')->name('admin.detail.absen.user');

    Route::get('/qr-code-absen', 'qrCode')->name('admin.qrCodeAbsen');

    Route::put('/data-pegawai/info-pegawai/edit/{user:slug}/update', 'update')->name('admin.update.user');

    Route::get('/absensi-pegawai', 'absensi')->name('admin.user.absensi');
    Route::get('/absensi-pegawai/{hadir:id}', 'detailAbsensi')->name('admin.user.absensi.detail');

    Route::get('/absensi-pegawai/user/hadir', 'hadir')->name('admin.user.hadir');

    Route::post('/data-pegawai/add-pegawai', 'store');
    Route::post('/absensi-pegawai/add-komentar/{hadir:id}', 'addKomentar')->name('admin.user.absen.addKomentar');
    Route::post('/absensi-pegawai/{hadir:id}', 'ubahAbsen')->name('admin.ubah.absen.user');

    Route::delete('/data-pegawai/{user:slug}/delete', 'destroy')->name('admin.delete.user');
});
