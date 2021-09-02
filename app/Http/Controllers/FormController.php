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



    #2 ブログ記事の表示
    public function show(Customer $customer) //Implicit Bindingの利用
    {
        return view('form.show')->with(['customer'=>$customer]);
    }

    #3 新規投稿ページの表示
    public function create(Customer $customer)
    {
        return view('posts.create');
    }

    public function store(CustomerRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route('posts.index');
    }

    #4 投稿内容編集ページの表示
    public function edit(Customer $customer) //Implicit Bindingの利用
    {
        return view('posts.edit')
            ->with(['post' => $post]);
    }

    public function update(CustomerRequest $request, Post $customer)
    {
        // $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route('posts.show',$customer);
    }

    #5 投稿削除
    public function destroy(Customer $customer)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
