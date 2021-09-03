<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    use HasFactory;

    # データ挿入設定

    protected $fillable = [
        'name','value','text',
    ];

    public $timestamps = true;




    # ローカルスコープ

    /**
     * フォームの'セレクト要素'で利用するアイテムの配列を返すスコープ
     *
     * 要素が以前選択されているとき、trueの'1'が'selected'キーに記録される
     *
     *
     * @return Array
     */
    public function scopeGetSelectElements($query, $customer)
    {
        $field = 'age_group';

        $elements = $query->get();



        if($customer)
        {


            foreach($elements as $element)
            {
                if($customer[$field] == $element['value'])
                {
                    $element['selected'] = 1;
                    break;
                }
            }


        }
        return $elements;
    }




    /**
     * 年代グループのランダムな値を返すスコープ
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
