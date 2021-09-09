<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;


class FormIDsComposer
{
    /**
     * フォームで入力するフィールドの設定オブジェクトを登録する。
     *
     *
     *
     */
    public function compose(View $view)
    {

        // アッパーキャメルケース変換関数
        function convertUpperCamelCase($str)
        {
            return strtr( ucwords( strtr($str, ['_' => ' ']) ),  [' ' => ''] );
        }


        // 変数の追加
        $view->with([


            'form_id' => [

                'name' => 'formID'.convertUpperCamelCase('name'),

                'email' => 'formID'.convertUpperCamelCase('email'),

                'image' => 'formID'.convertUpperCamelCase('image'),

                'age_group' => 'formID'.convertUpperCamelCase('age_group'),

                'remarks' => 'formID'.convertUpperCamelCase('remarks'),

            ],


        ]);
    }

}
