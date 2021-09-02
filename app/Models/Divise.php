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




    # ローカルスコープ

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
