<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    # データ挿入設定
    protected $fillable = [
        'name','value','text',
    ];

    public $timestamps = true;




    # ローカルスコープ

    /**
     * フォーム'ラジオボタン要素'で利用するアイテムの配列を返すスコープ
     *
     * 要素が以前選択されているとき、trueの'1'が'checked'キーに記録される
     *
     *
     * @return Array
     */
    public function scopeGetRadioElements($query, $customer)
    {
        $field = 'gender';

        $elements = $query->get();


        if($customer)
        {


            foreach($elements as $element)
            {
                if($customer[$field] == $element['value'])
                {
                    $element['checked'] = 1;
                    break;
                }
            }


        }


        return $elements;
    }

}
