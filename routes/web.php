<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\OtpVerificationMail;

use App\Http\Controllers\ArtikelPublikController;
use App\Http\Controllers\Siswa\SpkController;
use App\Http\Controllers\Siswa\ProfileController;

use App\Http\Controllers\Admin\DashboardController            as AdminDashboard;
use App\Http\Controllers\Admin\GuruBkController               as AdminGuruBk;
use App\Http\Controllers\Admin\SiswaAdminController           as AdminSiswa;
use App\Http\Controllers\Admin\StatusController               as AdminStatus;
use App\Http\Controllers\Admin\JurusanAdminController         as AdminJurusan;
use App\Http\Controllers\Admin\ArtikelAdminController         as AdminArtikel;
use App\Http\Controllers\Admin\InfoJurusanAdminController     as AdminInfoJurusan;
use App\Http\Controllers\Admin\MonitoringController           as AdminMonitoring;

use App\Http\Controllers\Bk\DashboardController;
use App\Http\Controllers\Bk\SiswaController                   as BkSiswaController;
use App\Http\Controllers\Bk\StatistikController;
use App\Http\Controllers\Bk\ArtikelController                 as BkArtikelController;
use App\Http\Controllers\Bk\InfoJurusanController;
use App\Http\Controllers\Bk\ProfilController                  as BkProfilController;
use App\Http\Controllers\Bk\PasswordController                as BkPasswordController;
use App\Http\Controllers\Auth\OtpRegisterController;

/*
|--------------------------------------------------------------------------
| Route utilitas
|--------------------------------------------------------------------------
*/

Route::get('/reset-admin', function () {
    DB::table('users')
        ->where('email', 'admin@spksaw.local')
        ->update([
            'password_hash' => Hash::make('admin123')
        ]);

    return 'Password admin berhasil direset';
});

Route::get('/test-otp-db', function () {
    $otp = PasswordReset::create([
        'user_id'    => 1,
        'otp_code'   => '123456',
        'expires_at' => now()->addMinutes(10),
        'is_used'    => false,
    ]);

    return $otp;
});

Route::get('/test-otp-mail', function () {
    $user = User::find(1); // ganti sesuai user yang benar-benar ada

    if (!$user) {
        return 'User tidak ditemukan.';
    }

    if (empty($user->email)) {
        return 'Email user kosong.';
    }

    $otp = '123456';

    Mail::to($user->email)->send(new OtpVerificationMail($user, $otp));

    return 'Email OTP berhasil dikirim.';
});

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

// Landing
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing.home');
Route::get('/landingpage', fn () => redirect()->route('landing.home'))->name('landingpage');

// Artikel publik
Route::get('/artikel', [ArtikelPublikController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{id}', [ArtikelPublikController::class, 'show'])->name('artikel.show');
Route::get('/jurusan/{id}', [App\Http\Controllers\JurusanPublikController::class, 'show'])->name('jurusan.show');

// Breeze routes (login/register/logout/forgot/etc)
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // FR-A-01: Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // FR-A-02~05: Kelola Akun Guru BK
    Route::get('/guru-bk',             [AdminGuruBk::class, 'index'])->name('gurubk.index');
    Route::get('/guru-bk/create',      [AdminGuruBk::class, 'create'])->name('gurubk.create');
    Route::post('/guru-bk',            [AdminGuruBk::class, 'store'])->name('gurubk.store');
    Route::get('/guru-bk/{id}/edit',   [AdminGuruBk::class, 'edit'])->name('gurubk.edit');
    Route::put('/guru-bk/{id}',        [AdminGuruBk::class, 'update'])->name('gurubk.update');
    Route::patch('/guru-bk/{id}/status', [AdminGuruBk::class, 'toggleStatus'])->name('gurubk.status');

    // FR-A-05~06: Kelola Akun Siswa
    Route::get('/siswa',               [AdminSiswa::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{id}/edit',     [AdminSiswa::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}',          [AdminSiswa::class, 'update'])->name('siswa.update');
    Route::patch('/siswa/{id}/status', [AdminSiswa::class, 'toggleStatus'])->name('siswa.status');

    // FR-A-07: Status Siswa & Guru BK
    Route::get('/status',              [AdminStatus::class, 'index'])->name('status.index');
    Route::patch('/status/siswa/{id}', [AdminStatus::class, 'toggleSiswa'])->name('status.siswa');
    Route::patch('/status/guru/{id}',  [AdminStatus::class, 'toggleGuru'])->name('status.guru');

    // FR-A-08: Kelola Jurusan
    Route::get('/jurusan',               [AdminJurusan::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/create',        [AdminJurusan::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan',              [AdminJurusan::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{id}/edit',     [AdminJurusan::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{id}',          [AdminJurusan::class, 'update'])->name('jurusan.update');
    Route::patch('/jurusan/{id}/status', [AdminJurusan::class, 'toggleStatus'])->name('jurusan.status');

    // FR-A-09: Kelola Artikel
    Route::get('/artikel',            [AdminArtikel::class, 'index'])->name('artikel.index');
    Route::get('/artikel/{id}/edit',  [AdminArtikel::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}',       [AdminArtikel::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}',    [AdminArtikel::class, 'destroy'])->name('artikel.destroy');

    // FR-A-10: Kelola Info Jurusan
    Route::get('/informasi-jurusan',                    [AdminInfoJurusan::class, 'index'])->name('infojurusan.index');
    Route::get('/informasi-jurusan/{jurusanId}/edit',  [AdminInfoJurusan::class, 'edit'])->name('infojurusan.edit');
    Route::put('/informasi-jurusan/{jurusanId}',       [AdminInfoJurusan::class, 'update'])->name('infojurusan.update');
    Route::delete('/informasi-jurusan/{jurusanId}',    [AdminInfoJurusan::class, 'destroy'])->name('infojurusan.destroy');

    // FR-A-11: Monitoring
    Route::get('/monitoring', [AdminMonitoring::class, 'index'])->name('monitoring.index');
});

/*
|--------------------------------------------------------------------------
| Guru BK
|--------------------------------------------------------------------------
*/
Route::prefix('bk')->name('bk.')->middleware('auth')->group(function () {

    // Tetap boleh diakses sebelum onboarding selesai
    Route::get('/password',         [BkPasswordController::class, 'index'])->name('password.index');
    Route::put('/password/update',  [BkPasswordController::class, 'update'])->name('password.update');

    Route::get('/profil',           [BkProfilController::class, 'index'])->name('profil');
    Route::put('/profil/update',    [BkProfilController::class, 'update'])->name('profil.update');

    // Semua route lain dibatasi middleware onboarding
    Route::middleware('force.password.change')->group(function () {

        // FR-BK-01: Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // FR-BK-02: Data Siswa & Hasil Tes
        Route::get('/siswa',                              [BkSiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/{id}',                         [BkSiswaController::class, 'show'])->name('siswa.show');
        Route::get('/siswa/{siswaId}/tes/{tesId}/hasil', [BkSiswaController::class, 'hasilTes'])->name('siswa.hasil');
        Route::get('/siswa/{siswaId}/tes/{tesId}/pdf',   [BkSiswaController::class, 'downloadPdf'])->name('siswa.pdf');

        // FR-BK-03: Statistik
        Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

        // FR-BK-05: Kelola Artikel
        Route::get('/artikel',            [BkArtikelController::class, 'index'])->name('artikel.index');
        Route::get('/artikel/create',     [BkArtikelController::class, 'create'])->name('artikel.create');
        Route::post('/artikel',           [BkArtikelController::class, 'store'])->name('artikel.store');
        Route::get('/artikel/{id}/edit',  [BkArtikelController::class, 'edit'])->name('artikel.edit');
        Route::put('/artikel/{id}',       [BkArtikelController::class, 'update'])->name('artikel.update');
        Route::delete('/artikel/{id}',    [BkArtikelController::class, 'destroy'])->name('artikel.destroy');

        // FR-BK-06: Kelola Info Jurusan
        Route::get('/infojurusan',           [InfoJurusanController::class, 'index'])->name('infojurusan.index');
        Route::get('/infojurusan/{id}',      [InfoJurusanController::class, 'show'])->name('infojurusan.show');
        Route::get('/infojurusan/{id}/edit', [InfoJurusanController::class, 'edit'])->name('infojurusan.edit');
        Route::put('/infojurusan/{id}',      [InfoJurusanController::class, 'update'])->name('infojurusan.update');
    });
});

/*
|--------------------------------------------------------------------------
| SPK Tes Siswa
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->middleware('auth')->group(function () {
    Route::get('/tes',             [SpkController::class, 'index'])->name('tes.index');
    Route::post('/tes/simpan',     [SpkController::class, 'store'])->name('tes.simpan');
    Route::get('/tes/hasil',       [SpkController::class, 'hasil'])->name('tes.hasil');
    Route::get('/tes/cetak',       [SpkController::class, 'cetakPdf'])->name('tes.cetak');
    Route::get('/history',         [SpkController::class, 'history'])->name('history');
    Route::get('/tes/{tes}/hasil', [SpkController::class, 'hasilByTes'])->name('tes.hasil.show');
    Route::get('/tes/{tes}/pdf',   [SpkController::class, 'cetakPdfByTes'])->name('tes.pdf.download');

    // Profile Siswa
    Route::get('/profile',          [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update',   [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});