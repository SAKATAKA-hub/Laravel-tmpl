<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\AgeGroup;

class CustomerController extends Controller
{
    /**
     * ブログ一覧の表示(list)
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('formlist');
    }
}
