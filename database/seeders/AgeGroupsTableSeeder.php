<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgeGroup;

class AgeGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items =[
            ['value' => '10歳代', 'text' => '10歳代',],
            ['value' => '20歳代', 'text' => '20歳代',],
            ['value' => '30歳代', 'text' => '30歳代',],
            ['value' => '40歳代', 'text' => '40歳代',],
            ['value' => '50歳代', 'text' => '50歳代',],
            ['value' => '60歳代', 'text' => '60歳代',],
            ['value' => '70歳代以上', 'text' => '70歳代以上',],
        ];

        foreach ($items as $item)
        {
            $data = new AgeGroup([
                'name' => 'age_group',
                'value' => $item['value'],
                'text' => $item['text'],
            ]);
            $data->save();
        }
    }
}
