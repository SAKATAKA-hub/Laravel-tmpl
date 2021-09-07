<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;


class FormFieldsComposer
{
    /**
     * フォームで入力するフィールドの設定オブジェクトを登録する。
     *
     *
     *
     */
    public function compose(View $view)
    {


        function convertUpperCamelCase($str)
        {
            return strtr( ucwords( strtr($str, ['_' => ' ']) ),  [' ' => ''] );
        }


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
