<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divise extends Model
{
    use HasFactory;

     # データ挿入設定
     protected $fillable = [
        'name','value','text',
    ];

    public $timestamps = true;



    # アクセサー
    /**
     * フォーム入力値とラベルを結びつける'ID'の値を返す
     *
     *
     * @return String
     */
    public function getFormIdAttribute()
    {

        return 'formID'. ucfirst( str_replace('[]','',$this->name) ) .$this->id;
    }





    # ローカルスコープ

    /**
     * フォームの'チェックボックス要素'で利用するアイテムの配列を返すスコープ
     *
     * 要素が以前選択されているとき、trueの'1'が'checked'キーに記録される
     *
     *
     * @return Array
     */
    public function scopeGetCheckboxElements($query, $customer)
    {
        $field = 'divises';

        $elements = $query->get();


        if($customer)
        {


            $checked_items = explode(' ',$customer[$field]); //チェックした複数の'値'を配列に保存

            foreach($elements as $element)
            {
                foreach($checked_items as $checked_item)
                {
                    if($checked_item == $element['value'])
                    {
                        $element['checked'] = 1;
                    }
                }
            }


        }

        return $elements;
    }





    /**
     * ディバイスの種類からのランダムな値を返す
     *
     * @return String
     */
    public function scopeGetRandValue($query)
    {
        $items = $query->get();

        $value_array = [];
        foreach( $items as $item)
        {
            array_push($value_array, $item->value);
        }
        $n = count($value_array)-1;

        return $value_array[mt_rand(0,$n)];
    }

}
