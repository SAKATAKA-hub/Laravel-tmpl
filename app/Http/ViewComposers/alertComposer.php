<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;


class alertComposer
{
    /**
     * フォームで入力するフィールドの設定オブジェクトを登録する。
     *
     *
     *
     */
    public function compose(View $view)
    {

        // 変数の追加
        $view->with([


            'alert' => [


                'store' => [

                    'message' => 'さんの情報を登録しまいた。',

                    'color' => 'alert-success',

                ],

                'update' => [

                    'message' => 'さんの登録情報を修正しました。',

                    'color' => 'alert-warning',

                ],

                'destroy' => [

                    'message' => 'さんの登録情報を削除しまいた。',

                    'color' => 'alert-danger',

                ],


            ],


        ]);
    }

}
