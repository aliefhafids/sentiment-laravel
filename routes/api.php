<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScrappingController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ClassificationTestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/dashboard/scrapping', [ScrappingController::class, 'scrapeReviews'])->name('scrapeReviews');

Route::get('/dashboard/process', [ProcessController::class, 'preprocessReviews']);

Route::get('/dashboard/classification', [ClassificationController::class, 'preprocessReviewsAndClassify']);

Route::get('/dashboard/class-uji', [ClassificationTestController::class, 'reviewsAndClassify']);

Route::get('/dashboard/dataset/fetch', [FetchController::class, 'fetchScript'])->name('fetch.data');

Route::post('/save-product', [ProductController::class, 'saveClassification'])->name('save.classification');

// --------------------- word ---------------------
Route::get('/dashboard/frekuensi', [WordController::class, 'generateWordCloud'])->name('dashboard.word.index');