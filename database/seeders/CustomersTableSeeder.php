<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 仮のお客様情報の配列
        $man = [
            [ 'name' => '近藤　達也', 'alp' => 'kondo tatuya', ],
            [ 'name' => '柳原　了', 'alp' => 'yanagihara ryo', ],
            [ 'name' => '浅利　良介', 'alp' => 'asari ryosuke', ],
            [ 'name' => '井口　雄太', 'alp' => 'iguti yuta', ],
            [ 'name' => '今　洋介', 'alp' => 'kon yousuke', ],
        ];

        $woman = [
            [ 'name' => '矢野　詩織', 'alp' => 'yano shiori', ],
            [ 'name' => '小西　美希', 'alp' => 'konishi miki', ],
            [ 'name' => '川村　くるみ', 'alp' => 'kawamura kurumi', ],
            [ 'name' => '松本　麻紀', 'alp' => 'matumoto maki', ],
            [ 'name' => '高梨　由樹', 'alp' => 'takanashiyuki', ],
        ];




        //仮データの保存
        for ($i=1; $i <= 10; $i++)
        {
            $nom = $i%2 == 0? ( ($i/2)-1 ): floor($i/2); //true:女性ナンバー false:男性ナンバー
            $person = $i%2 == 0? $man[$nom]: $woman[$nom]; //true:一人の女性データ false:一人の男性データ

            $customer = new Customer([
                'name' => $person['name'],

                'email' => str_replace(' ','_',$person['alp']).'@email.co.jp',

                'image' => 'storage/customer_img/'.sprintf('%04d.png',$i),

                'divises' => \App\Models\Divise::getRandValue(), //ランダムなディバイスの種類の値

                'gender' => $i%2 == 0? '男性': '女性',

                'age_group' => \App\Models\AgeGroup::getRandValue(), //ランダムな年代グループの値
            ]);
            $customer->save();

        }





    }
}
