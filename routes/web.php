<?php

use App\Http\Controllers\ArkaController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GenerateRaportController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockProductController;
use App\Http\Controllers\StockReportController;
use App\Mail\LindorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

//if (!env('ALLOW_REGISTRATION', false)) {
//    Route::any('/register', function() {
//        abort(403);
//    });
//}





Route::get('/', function () {
    return view('welcome');
});

//auth route for both
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
    Route::resource('expenses', ExpenseController::class);
    Route::resource('generate-raports', GenerateRaportController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('results', ResultController::class);
    Route::resource('arka', ArkaController::class);
    Route::resource('pos', PosController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('input', InputController::class);
    Route::resource('products', ProductController::class);
    Route::resource('stockProducts', StockProductController::class);
    Route::resource('stockReports', StockReportController::class);
    Route::post('/generateStockReports', 'App\Http\Controllers\StockController@generateStockReports')->name('generateStockReports');
    Route::get('/generateStock', 'App\Http\Controllers\GenerateRaportController@generateStock')->name('generateStock');
    Route::get('/searchStock', 'App\Http\Controllers\GenerateRaportController@searchStock')->name('searchStock');
    Route::get('/generateAll', 'App\Http\Controllers\GenerateRaportController@generateAll')->name('generateAll');
    Route::get('/search', 'App\Http\Controllers\GenerateRaportController@search')->name('search');
    Route::post('/generate-invoice', 'App\Http\Controllers\InvoiceController@invoice')->name('invoice');
    Route::get('/searchDailyReports', 'App\Http\Controllers\GenerateRaportController@searchDailyReports')->name('searchDailyReports');
    Route::get('/generateDailyReports', 'App\Http\Controllers\GenerateRaportController@generateDailyReports')->name('generateDailyReports');

    Route::get('/showGeneratedExpense/{expense_id}', 'App\Http\Controllers\ExpenseController@showGeneratedExpense')->name('showGeneratedExpense');

//    Route::get('/email',function (){
//
//      Mail::to('lk3751@ubt-uni.net')->send(new LindorMail());
//      return new LindorMail();
//    });
});


require __DIR__.'/auth.php';
