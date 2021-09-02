<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divise;

class DivisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items =[
            [
                'value' => 'パソコン',
                'text' => 'パソコン',
            ],
            [
                'value' => 'タブレット',
                'text' => 'タブレット',
            ],
            [
                'value' => 'スマートフォン',
                'text' => 'スマートフォン',
            ],
        ];

        foreach ($items as $item)
        {
            $data = new Divise([
                'name' => 'divises[]',
                'value' => $item['value'],
                'text' => $item['text'],
            ]);
            $data->save();
        }

    }
}
