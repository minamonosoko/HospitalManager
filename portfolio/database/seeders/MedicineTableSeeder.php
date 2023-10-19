<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードのuseが必要
use Carbon\Carbon;  // 時刻

class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // レコード
        $params = 
        [
            [
                'medicine_name' => 'ロキソプロフェン',
                'hospital_id' => '1',
                'medicine_stock' => '3'
            ],
            [
                'medicine_name' => 'フェキソフェナジン',
                'hospital_id' => '1',
                'medicine_stock' => '56'
            ],
            [
                'medicine_name' => 'アスピリン',
                'hospital_id' => '2',
                'medicine_stock' => '14'
            ],
            [
                'medicine_name' => 'アスコルビン酸',
                'hospital_id' => '2',
                'medicine_stock' => '14'
            ],
            [
                'medicine_name' => 'アセトアミノフェン',
                'hospital_id' => '3',
                'medicine_stock' => '7'
            ],
            [
                'medicine_name' => 'アデノシン',
                'hospital_id' => '3',
                'medicine_stock' => '14'
            ],
            [
                'medicine_name' => '葛根湯',
                'hospital_id' => '3',
                'medicine_stock' => '28'
            ],
            [
                'medicine_name' => 'カリジノゲナーゼ',
                'hospital_id' => '4',
                'medicine_stock' => '14'
            ],
            [
                'medicine_name' => 'カルニチン',
                'hospital_id' => '5',
                'medicine_stock' => '7'
            ],
            [
                'medicine_name' => 'クラリスロマイシン',
                'hospital_id' => '6',
                'medicine_stock' => '14'
            ],
            [
                'medicine_name' => '桂枝加芍薬湯',
                'hospital_id' => '7',
                'medicine_stock' => '28'
            ],
            [
                'medicine_name' => 'ゲンタマイシン硫酸塩クリーム',
                'hospital_id' => '7',
                'medicine_stock' => '2'
            ],
            [
                'medicine_name' => '酸化マグネシウム',
                'hospital_id' => '7',
                'medicine_stock' => '8'
            ],
            [
                'medicine_name' => 'シクロスポリン細粒',
                'hospital_id' => '5',
                'medicine_stock' => '8'
            ],
        ];

        // INSERT
        $now = Carbon::now();
        foreach($params as $param){
            $param['created_at'] = $now;
            $param['updated_at'] = $now;
            DB::table('medicines')->insert($param);
        }    
    }
}
