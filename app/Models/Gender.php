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
}
