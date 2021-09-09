<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // form入力ページ
        View::composer('form.form','App\Http\ViewComposers\FormIDsComposer');

        // list表示ページ
        View::composer('form.list','App\Http\ViewComposers\alertComposer');

    }
}
