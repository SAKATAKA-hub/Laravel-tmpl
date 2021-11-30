<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTestMailable;

class MailSendController extends Controller
{
    public function mail(Request $request)
    {

        $data = [];

    	// Mail::send('emails.text', $data, function($message){ //メールの本文の内容を記述するビュー('emails.test')
    	//     $message->to('aek1214@yahoo.co.jp', 'Test') //メールの送信先
        //     ->subject('This is a test mail'); //メールの件名
    	// });

        # 変数の受け取り
        $inputs = $request->only('title','email','body');




        # 管理者へメール送付
        // $admin=config('mail.admin');
        // Mail::to($admin)->send(new MailTestMailable($inputs));

        # 送信先へメール送付
        $email=$inputs['email'];
        Mail::to($email)->send(new MailTestMailable($inputs));


        return view('emails.test')
        ->with(['inputs'=>$inputs]);



    }
}
