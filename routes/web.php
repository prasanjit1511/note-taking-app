<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => '/'],function(){

    Route::group(['middleware' => 'guest'],function(){
        Route::get('register',[AccountController::class,'register'])->name('account.register');
        Route::post('register',[AccountController::class,'processRegister'])->name('account.processRegister');
        Route::get('/',[AccountController::class,'login'])->name('account.login');
        Route::post('login',[AccountController::class,'authenticate'])->name('account.authenticate');
        

    });

    Route::group(['middleware' => 'auth'],function(){

        Route::get('list',[AccountController::class,'list'])->name('account.list');
        Route::get('logout',[AccountController::class,'logout'])->name('account.logout');
        Route::get('create',[AccountController::class, 'create'])->name('account.create');
        Route::post('store',[AccountController::class, 'store'])->name('account.store');
        Route::get('editNote/{notetId}',[AccountController::class, 'edit'])->name('account.edit');
        Route::put('updateNote{notetId}',[AccountController::class,'update'])->name('account.update');
        Route::delete('delete/{notetId}',[AccountController::class, 'destroy'])->name('account.destroy');
        Route::get('search',[AccountController::class, 'list'])->name('account.search');

    });

});
