<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    public function api(Request $request)
    {

        $textboxes = [
            ['value'=>'見出し11', 'bgLight'=>false,],
            ['value'=>'見出し12', 'bgLight'=>false,],
            ['value'=>'見出し13', 'bgLight'=>false,],
        ];

        return ['textboxes'=> $textboxes];
    }
}
