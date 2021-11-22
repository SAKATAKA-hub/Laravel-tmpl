<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    # データ挿入設定
    protected $fillable = [
        'body','chaked',
    ];

    public $timestamps = true;



}
