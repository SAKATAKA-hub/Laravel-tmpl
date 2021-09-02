<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    # データ挿入設定
    protected $fillable = [
        'name','email','image','divises','gender','age_group',
    ];

    public $timestamps = true;
}
