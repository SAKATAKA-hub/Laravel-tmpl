<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Requests\FormFormRequest;
use App\Models\Customer;
use App\Models\AgeGroup;
use App\Models\Divise;
use App\Models\Gender;


class FormController extends Controller
{
    /**
     * お客様情報一覧の表示(list)
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {

        $customers = Customer::paginate(5);

        return view('form.list',compact('customers') );
    }



    /**
     * お客様情報の表示(show)
     *
     * @return \Illuminate\View\View
     */
    public function show(Customer $customer)
    {
        return view('form.show', compact('customer') );
    }




    /**
     * 新規登録ページの表示(create)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return'create';

        $customer = Customer::find(1);

        $form = 'create'; //form bladeテンプレートの'create'モード表示

        // フォーム内の各選択要素アイテムの取得
        $select_element = [
            'age_groups' => AgeGroup::getSelectElements(false), //セレクト要素アイテムの取得
            'divises' => Divise::getCheckboxElements(false), //チェックボックス要素アイテムの取得
            'genders' => Gender::getRadioElements(false),  //ラジオボタン要素アイテムの取得
        ];

        return view('form.form', compact('form','select_element') );
    }




     /**
     * 新規登録処理(store)
     *
     * @param \App\Http\Requests\FormFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormFormRequest $request)
    {
        // 保存する入力内容のみを配列にまとめる
        $inputs_array = $request->only('name','email','image','divises','gender','age_group','remarks');

        // 画像データの処理
        $inputs_array['image'] = $this->UploadFile($request); // 画像アップロードメソッド

        // 配列データ('divises')を文字列に変換処理
        $inputs_array['divises'] = $request->has('divises')? implode(' ',$request['divises']): '';


        // データの新規保存
        $store = new Customer( $inputs_array );
        $store->save();


        return redirect()->route('form.list')
        ->with([ //アラート表示のセッション変数を追加
            'alert_name' => $request->name,
            'alert_process' => 'store',
        ]);

    }




    /**
     * お客様情報編集ページの表示(edit)
     *
     * @return \Illuminate\View\View
     */
    public function edit(Customer $customer)
    {
        // form bladeテンプレートの'edit'モード表示
        $form = 'edit';

        // フォーム内の各選択要素アイテムの取得
        $select_element = [
            'age_groups' => AgeGroup::getSelectElements($customer), //セレクト要素アイテムの取得
            'divises' => Divise::getCheckboxElements($customer), //チェックボックス要素アイテムの取得
            'genders' => Gender::getRadioElements($customer),  //ラジオボタン要素アイテムの取得
        ];

        return view('form.form', compact('customer','form','select_element') );
    }




    /**
     * 編集内容の登録処理(update)
     *
     * @param \App\Http\Requests\FormFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(FormFormRequest $request, Customer $customer)
    {
        // 保存する入力内容のみを配列にまとめる
        $inputs_array = $request->only('name','email','image','divises','gender','age_group','remarks');

        // 画像データの処理
        $inputs_array['image'] = $this->UploadFile($request); // 画像アップロードメソッド

        // 配列データ('divises')を文字列に変換処理
        $inputs_array['divises'] = $request->has('divises')? implode(' ',$request['divises']): '';


        // データの上書き保存
        $customer->update( $inputs_array );


        return redirect()->route('form.list')
        ->with([ //アラート表示のセッション変数を追加
            'alert_name' => $request->name,
            'alert_process' => 'update',
        ]);


    }




    /**
     * 登録内容削除処理(destroy)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $customer = Customer::find($request->customer_id);

        // データの削除
        $customer->delete();


        return redirect()->route('form.list')
        ->with([ //アラート表示のセッション変数を追加
            'alert_name' => $customer->name,
            'alert_process' => 'destroy',
        ]);
    }









    /**
     * 画像アップロードメソッド
     *
     * @param \App\Http\Requests\FormFormRequest $request
     * @return String
     */
    public function UploadFile($request)
    {
        $dir = 'upload/customer_img'; //アップロード先ディレクトリ名
        $no_image = $dir.'/no_img.png'; //アップロード画像無し用の画像


        # アップロードする画像があるとき
        if($request_file = $request->file('image'))
        {
            $num = Customer::orderBy('id','desc')->first()->id +1; //顧客番号

            $extension = $request_file->extension(); //拡張子

            $file_name = sprintf('%04d', $num).'.'.$extension; //ファイル

            $image_path = $request_file->storeAs($dir,$file_name); //画像のアップロード

        }
        # アップロードする画像がないとき
        else
        {
            if  ($request->has('old_image') ) //以前に画像をアップロードしているとき
            {
                $image_path = $request->old_image; //(以前アップロードした画像のパス)
            }
            else
            {
                $image_path = $no_image;
            }
        }

        // // AWS-S3へのアップロード
        // # アップロードする画像があるとき
        // if($request_file = $request->file('image'))
        // {
        //     $num = Customer::orderBy('id','desc')->first()->id +1; //顧客番号

        //     $extension = $request_file->extension(); //拡張子

        //     $file_name = sprintf('%04d', $num).'.'.$extension; //ファイル

        //     // $image_path = $request_file->storeAs($dir,$file_name); //画像のアップロード
        //     $image_path = Storage::disk('s3')->putFile('/', $request_file, 'public');
        //     // $image_path = Storage::disk('s3')->putFileAs($dir, $request_file, $file_name, 'public');

        // }
        // # アップロードする画像がないとき
        // else
        // {
        //     if  ($request->has('old_image') ) //以前に画像をアップロードしているとき
        //     {
        //         $image_path = $request->old_image; //(以前アップロードした画像のパス)
        //     }
        //     else
        //     {
        //         $image_path = $no_image;
        //     }
        // }


        return $image_path;

        // return Storage::disk('s3')->url($image_path);
    }




}
