<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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
# お客様情報一覧の表示(list)
Route::get('/form/list', [FormController::class, 'list'])
    ->name('Form.list');


# お客様情報の表示
Route::get('/form/show/{post}', [FormController::class, 'show'])
    ->name('Form.show');


# 新規登録
// ページの表示
Route::get('/form/create', [FormController::class, 'create'])
    ->name('Form.create');

// 処理
Route::post('/form/store', [FormController::class, 'store'])
    ->name('Form.store');


# 登録内容編集
// ページの表示
Route::get('/form/edit/{post}', [FormController::class, 'edit'])
    ->name('Form.edit');

// 処理
Route::patch('/form/update/{post}', [FormController::class, 'update'])
    ->name('Form.update');


# 登録内容削除処理
Route::delete('/form/destroy/{post}', [FormController::class, 'destroy'])
    ->name('Form.destroy');

