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
                'medicine_name' => 'ロキソニン',
                'hospital_id' => '1',
            ],
            [
                'medicine_name' => 'レミカット',
                'hospital_id' => '2',
            ],
            [
                'medicine_name' => 'アスピリン',
                'hospital_id' => '1',
            ],
            [
                'medicine_name' => 'イリボー',
                'hospital_id' => '3',
            ],
        ];

        // INSERT
        $now = Carbon::now();
        foreach($params as $param){
            $param['created_at'] = $now;
            $param['updated_at'] = $now;
            DB::table('medicines')->insert($param);
        }    }
}
