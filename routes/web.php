<?php

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

Route::get('/testemail', [App\Http\Controllers\MailController::class, 'testemail']);
Route::controller(App\Http\Controllers\PageController::class)->group(
    function () {
      Route::get('/i','forgotpassword')->name('forgotpass');
      Route::get('/testmail','testmail')->name('testmail');
   
    }
);

Route::controller(App\Http\Controllers\MailController::class)->group(
  function () {
    Route::get('/sendotp','sendOTP')->name('mail.sendOTP');
  }
);

Route::controller(App\Http\Controllers\QueryController::class)->group(
    function () {
      Route::post('/me','verifyemailUsername')->name('verifyemailUsername');
      Route::post('/verify','verifyresetCode')->name('verifyresetCode');
    }
);
Route::get('/', function () {
    echo "This Page is Ok.";
});
