<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailsController;
use App\Http\Controllers\profileController;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {

        //dashboard
        Route::get('/', function () {
            return redirect('/dashboard');
        });

        // to dashboard
        Route::get('/dashboard', function () {
            return view('user.mailboard.mailboard');
        })->name('dashboard');


        // Associated
        Route::prefix('mail')->group(function () {
            //ajax get all mails
            Route::get('/',[MailsController::class,'getMail'])->name('mails');

            //ajax get read_status
            Route::post('/read_status',[MailsController::class,'read_status']);

            //ajax get all mails
            Route::get('/getMailsAddress',[MailsController::class,'mailsAddress']);


            //ajax sort mail
            Route::get('/getMailSorting',[MailsController::class,'sort']);

            //ajax get sended mail
            Route::get('/getSendMail',[MailsController::class,'sendMails']);

            // create mails
            Route::get('/send',[MailsController::class,'sendMail'])->name('sendMail');

        });
        Route::prefix('sended')->group(function () {
            Route::get('/view',[MailsController::class,'SendedMailview'])->name('SendedMailview');

        });
        Route::prefix('search')->group(function () {
            Route::get('/searchInbox/',[MailsController::class,'search']);
        });
        Route::prefix('delete')->group(function () {
            Route::post('/inbox/',[MailsController::class,'DeleteInboxMessage'])->name('deleteMail');
        });
        Route::prefix('/profile')->group(function () {
            Route::get('/',function(){
                return view('user.profile.profile');
            })->name('profile');

            Route::get('/restartPasswordPage',function(){
                return view('user.profile.restartPassword');
            })->name('restartPasswordPage');
            Route::post('/update',[profileController::class,'profileUpdate'])->name('profileUpdate');
            Route::post('/restartPassword',[profileController::class,'restartPassword'])->name('restartPassword');
        });

    });

