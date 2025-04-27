<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PatienRegistrationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceRoomController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

# Auth routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])
        ->name('logout');

    # Dashboard Page
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('isAdmin')->group(function () {
        # Manage User Page
        Route::get('/manajemen-akun', [ManageUserController::class, 'index'])->name('users-management.index');
        Route::get('/manajemen-akun/tambah', [ManageUserController::class, 'create'])->name('users-management.create');
        Route::post('/manajemen-akun', [ManageUserController::class, 'store'])->name('users-management.store');
        Route::get('/manajemen-akun/{id}/edit', [ManageUserController::class, 'edit'])->name('users-management.edit');
        Route::put('/manajemen-akun/{id}', [ManageUserController::class, 'update'])->name('users-management.update');
        Route::delete('/manajemen-akun/{id}', [ManageUserController::class, 'destroy'])->name('users-management.destroy');
        Route::post('/manajemen-akun/{id}/disable', [ManageUserController::class, 'disable'])->name('users-management.disable');

        # Manage Jenis Asuransi
        Route::get('/asuransi', [InsuranceController::class, 'index'])->name('insurance.index');
        Route::post('/asuransi', [InsuranceController::class, 'store'])->name('insurance.store');
        Route::put('/asuransi/{id}', [InsuranceController::class, 'update'])->name('insurance.update');
        Route::delete('/asuransi/{id}', [InsuranceController::class, 'destroy'])->name('insurance.destroy');

        # Manage Jenis Tindakan
        Route::get('/tindakan', [TreatmentController::class, 'index'])->name('treatment.index');
        Route::post('/tindakan', [TreatmentController::class, 'store'])->name('treatment.store');
        Route::put('/tindakan/{id}', [TreatmentController::class, 'update'])->name('treatment.update');
        Route::delete('/tindakan/{id}', [TreatmentController::class, 'destroy'])->name('treatment.destroy');

        # Manage Ruang Pelayanan
        Route::get('/ruang-pelayanan', [ServiceRoomController::class, 'index'])->name('service-room.index');
        Route::post('/ruang-pelayanan', [ServiceRoomController::class, 'store'])->name('service-room.store');
        Route::put('/ruang-pelayanan/{id}', [ServiceRoomController::class, 'update'])->name('service-room.update');
        Route::delete('/ruang-pelayanan/{id}', [ServiceRoomController::class, 'destroy'])->name('service-room.destroy');
    });

    # Manage Pasien
    Route::get('/pasien', [PatientController::class, 'index'])->name('patient-management.index');
    Route::get('/pasien/tambah', [PatientController::class, 'create'])->name('patient-management.create');
    Route::post('/pasien', [PatientController::class, 'store'])->name('patient-management.store');
    Route::get('/pasien/{id}/edit', [PatientController::class, 'edit'])->name('patient-management.edit');
    Route::put('/pasien/{id}', [PatientController::class, 'update'])->name('patient-management.update');
    Route::delete('/pasien/{id}', [PatientController::class, 'destroy'])->name('patient-management.destroy');
    Route::get('/pasien/{id}', [PatientController::class, 'show'])->name('patient-management.show');

    # Manage Registrasi Pasien
    Route::get('/registrasi-pasien', [PatienRegistrationController::class, 'index'])->name('patient-registration.index');
    Route::get('/registrasi-pasien/tambah', [PatienRegistrationController::class, 'create'])->name('patient-registration.create');
    Route::get('/registrasi-pasien/{id}', [PatienRegistrationController::class, 'show'])->name('patient-registration.show');
    Route::post('/registrasi-pasien', [PatienRegistrationController::class, 'store'])->name('patient-registration.store');
    Route::get('/registrasi-pasien/{id}/edit', [PatienRegistrationController::class, 'edit'])->name('patient-registration.edit');
    Route::put('/registrasi-pasien/{id}', [PatienRegistrationController::class, 'update'])->name('patient-registration.update');
    Route::delete('/registrasi-pasien/{id}', [PatienRegistrationController::class, 'destroy'])->name('patient-registration.destroy');

    # Manage Transaksi
    Route::get('/registrasi-pasien/{id}/transaksi/', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/registrasi-pasien/{id}/transaksi', [TransactionController::class, 'store'])->name('transaction.store');

    Route::put('/transaksi/{transId}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('/transaksi/{transId}', [TransactionController::class, 'destroy'])->name('transaction.destroy');

    // Profile Page
    Route::get('/profil-akun', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil-akun', [ProfileController::class, 'update'])->name('profile.update');
});
