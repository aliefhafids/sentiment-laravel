<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\DatasetsController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScrappingController;
use App\Http\Controllers\ClassificationController;

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

// --------------------- Login ---------------------
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// --------------------- Dashboard ---------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
Route::get('/dashboard/delete/{id}', [DashboardController::class, 'delete'])->name('delete');

// --------------------- Dataset ---------------------
Route::resource('/dashboard/dataset', DatasetsController::class)->middleware('auth');
Route::post('/dashboard/dataset/importmain', [UploadController::class, 'importmain'])->name('importmain');
Route::get('/dashboard/dataset/delete/{id}', [DatasetsController::class, 'delete'])->name('delete');
Route::post('/dashboard/dataset/clear', [DatasetsController::class, 'hapusData'])->name('hapus.data');

// --------------------- Data Latih ---------------------
Route::resource('/dashboard/latih', TrainingController::class)->middleware('auth');
Route::post('/dashboard/latih/importexcel', [UploadController::class, 'importexcel'])->name('importexcel');
Route::get('/dashboard/latih/delete/{id}', [TrainingController::class, 'delete'])->name('delete');
Route::post('/dashboard/latih/clear', [TrainingController::class, 'clearData'])->name('clear.data');


Route::get('/dashboard/scrapping', [ScrappingController::class, 'scrapeReviews'])->name('scrape.reviews');

// --------------------- Data Uji ---------------------
Route::resource('/dashboard/uji', TestingController::class)->middleware('auth');
Route::post('/dashboard/uji/importesting', [UploadController::class, 'importesting'])->name('importesting');
Route::get('/dashboard/uji/delete/{id}', [TestingController::class, 'delete'])->name('delete');
Route::get('/dashboard/uji/edit/{id}', [TestingController::class, 'edit'])->name('uji.edit');
Route::put('/dashboard/uji/update/{id}', [TestingController::class, 'update'])->name('uji.update');
Route::post('/dashboard/uji/clear', [TestingController::class, 'cleanData'])->name('clean.data');
  
// --------------------- Prepocessing ---------------------
Route::get('/dashboard/prepocessing', function () {
    return view('dashboard/prepocessing/index');
});

// --------------------- klasifikasi ---------------------
Route::get('/dashboard/klasifikasi', function () {
    return view('dashboard/klasifikasi/index');
});

Route::get('/dashboard/classification/results', [ClassificationController::class, 'showResults'])
    ->name('dashboard.klasifikasi.result');

Route::post('//dashboard/classification/results-clear', [ClassificationController::class, 'hilangData'])->name('hilang.data');
    
Route::get('/dashboard/result', function () {
    return view('dashboard/analisis/klasifikasi');
});

Route::get('/dashboard/bobot', function () {
    return view('dashboard/analisis/pembobotan');
});


