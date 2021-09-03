<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){ return true;}




    /**
     * 検証ルールの設定
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email',
            'image' => 'file|max:1600|mimes:jpeg,png,jpg,pdf',
            'gender' => 'required',
            'age_group' => 'required',
            'remarks' => 'max:255',
        ];
    }




    /**
     * エラーメッセージの設定
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '入力必須です。',
            'email.email' => 'メールの形式で入力してください。',

            'image.max' => '1.6MBを超えるファイルは添付できません。',
            'image.mims' => '指定のファイル形式以外は添付できません。',

            'gender.required' => '入力必須です。',
            'age_group.required' => '入力必須です。',
            'remarks.max' => '文章は255文字以内で入力してください。',
        ];
    }

}
