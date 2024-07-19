<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\SuratmasukController;
use App\Http\Controllers\SuratkeluarController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RequestSuratController;
use App\Http\Controllers\UsermanajemenController;
use App\Http\Controllers\SuratMahasiswaController;
use App\Http\Controllers\JenisSuratMahasiswaController;

Route::get('/', function () {
    return view('layouts.landingpage');
})->name('landingpage');

Route::get('/pengajuan', function () {
    return 'sdfjhjkhdfsk';
})->name('pengajuan');


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::resource('request_surat', RequestSuratController::class);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/suratmasuk', [SuratmasukController::class, 'index'])->name('suratmasuk');
    Route::get('/suratkeluar', [SuratkeluarController::class, 'index'])->name('suratkeluar');
    Route::get('/ajukan-surat', [PengajuanController::class, 'create'])->name('surat.create');
    Route::post('/surat-kirim', [PengajuanController::class, 'store'])->name('surat.kirim');
    Route::resource('pengajuansurat', PengajuanController::class);
    Route::post('/surat/update-status/{id}', [PengajuanController::class, 'updateStatus'])->name('surat.updateStatus');
    Route::get('/requestsurat', [PengajuanController::class, 'create'])->name('requestsurat');
    Route::post('update-status/{id}', [PengajuanController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/surat/{id}/edit', [PengajuanController::class, 'edit' ])->name('surat.edit');
    Route::delete('/surat/{id}', [PengajuanController::class, 'destroy'])->name('surat.destroy');
    Route::put('/surat/{id}', [PengajuanController::class, 'update' ])->name('surat.update');
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap-surat-masuk/pdf', [RekapController::class, 'cetakSuratMasuk'])->name('rekap-surat-masuk.pdf');
    Route::get('/rekap-surat-keluar/pdf', [RekapController::class, 'cetakSuratKeluar'])->name('rekap-surat-keluar.pdf');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/read-notification/{id}', [NotificationController::class, 'readNotification'])->name('readNotification');
    Route::get('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('markAsRead');
    Route::post('suratmasuk/forward/{id}', [SuratmasukController::class, 'forward'])->name('suratmasuk.forward');
    Route::get('/disposisi', [DisposisiController::class, 'index'])->name('disposisi');
    Route::resource('jenis_surat_mahasiswa', JenisSuratMahasiswaController::class);
    Route::resource('surat_mahasiswa', SuratMahasiswaController::class);
    Route::post('reply', [ReplyController::class, 'store'])->name('reply.store');
    Route::get('/surat-mahasiswa/rekap', [SuratMahasiswaController::class, 'rekap'])->name('mahasiswa.rekap');
    Route::get('/mahasiswa/rekap', [SuratMahasiswaController::class, 'rekap'])->name('filter_mahasiswa.rekap');


});

Route::get('/markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAllAsRead');

Route::group(['middleware' => 'CheckRole'], function(){
    Route::resource('jenissurat', JenisSuratController::class);
    Route::resource('prodi', ProdiController::class);
    Route::resource('user', UsermanajemenController::class);
    Route::delete('/user/{id}', [UsermanajemenController::class, 'destroy'])->name('user.delete');
    Route::put('/surat/{id}/update-status', 'PengajuanController@updateStatus')->name('surat.update-status');
});
