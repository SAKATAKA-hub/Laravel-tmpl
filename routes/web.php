<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AsynchronousCommunicationController;
use App\Http\Controllers\VueController;
use App\Http\Controllers\MailSendController;

# home
Route::get('/', function(){
    return view('home');
})->name('home');


/*
|--------------------------------------------------------
| ログイン認証
|--------------------------------------------------------
*/

# ログイン画面の表示(login_form)
Route::get('login_form',[AuthController::class,'login_form'])
->name('login_form');

# ログイン処理(login)
Route::post('login',[AuthController::class,'login'])
->name('login');

# ログアウト処理(logout)
Route::post('logout',[AuthController::class,'logout'])
->name('logout');



# ユーザー登録画面の表示(get_register)
Route::get('get_register',[AuthController::class,'get_register'])
->name('get_register');

# ユーザー登録処理(post_register)
Route::post('post_register',[AuthController::class,'post_register'])
->name('post_register');

// ログイン前は表示不可
Route::middleware(['auth'])->group(function () {
    # ホームページの表示
    Route::get('home',function() {
        return view('login.home');
    })->name('home');

});





/*
|--------------------------------------------------------
| フォームテンプレート
|--------------------------------------------------------
*/
# お客様情報一覧の表示(list)
Route::get('/form/list', [FormController::class, 'list'])
->name('form.list');


# お客様情報の表示(show)
Route::get('/form/show/{customer}', [FormController::class, 'show'])
->name('form.show');


# 新規登録
// ページの表示(create)
Route::get('/form/create', [FormController::class, 'create'])
->name('form.create');

// 処理(store)
Route::post('/form/store', [FormController::class, 'store'])
->name('form.store');


# 登録内容編集
// ページの表示(edit)
Route::get('/form/edit/{customer}', [FormController::class, 'edit'])
->name('form.edit');

// 処理(update)
Route::patch('/form/update/{customer}', [FormController::class, 'update'])
->name('form.update');


# 登録内容削除処理(destroy)
Route::delete('/form/destroy', [FormController::class, 'destroy'])
->name('form.destroy');




/*
|--------------------------------------------------------
| 非同期通信テテンプレート(asynchronous_communication)
|--------------------------------------------------------
*/
# メモ一覧の表示(list)
Route::get('/memo/list', [AsynchronousCommunicationController::class, 'list'])
->name('memo.list');

# メモの保存(store)
Route::post('/memo/store', [AsynchronousCommunicationController::class, 'store'])
->name('memo.store');

# メモの削除(destoroy)
Route::delete('/memo/destoroy/{memo}', [AsynchronousCommunicationController::class, 'destoroy'])
->name('memo.destoroy');




/*
|--------------------------------------------------------
| Vue.jsのＣDN利用とAPIの取得
|--------------------------------------------------------
*/
# test
Route::get('vue/index',function(){
    return view('vue.index');
})->name('vue.index');

# API受取り
Route::post('vue/api',[VueController::class,'api'])
->name('vue.api');



/*
|--------------------------------------------------------
| メールの送信
|--------------------------------------------------------
*/
Route::get('mail/input', function(){
    return view('emails.input');
})
->name('mail.input');

Route::post('mail/send', [MailSendController::class, 'mail'])
->name('mail.send');

