<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items =[
            ['value' => '女性','text' => '女性'],
            ['value' => '男性','text' => '男性'],
            ['value' => 'その他','text' => 'その他'],
        ];

        foreach ($items as $item)
        {
            $data = new Gender([
                'name' => 'gender',
                'value' => $item['value'],
                'text' => $item['text'],
            ]);
            $data->save();
        }
    }
}
