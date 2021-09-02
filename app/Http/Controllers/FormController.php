<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class FormController extends Controller
{
    /**
     * ブログ一覧の表示(list)
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        $customers = Customer::paginate(5);

        return view('form.list',compact('customers') );
    }
}
