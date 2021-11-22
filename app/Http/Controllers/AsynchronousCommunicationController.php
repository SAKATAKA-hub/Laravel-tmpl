<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;


class AsynchronousCommunicationController extends Controller
{
    # メモ一覧の表示(list)
    public function list()
    {
        $memos = Memo::orderBy('id','desc')->get();
        return view('asynchronous_communication.list',compact('memos'));
    }




    # メモの保存(store)
    public function store(request $request)
    {

        $memo =  new Memo([
            'body' => $request->body,
        ]);
        $memo->save();


        return json_encode(['id' => (int) $memo->id]);

    //     return redirect()->route('memo.list');
    }




    # メモの削除(destoroy)
    public function destoroy(Memo $memo)
    {
        $memo->delete();
    }


}
