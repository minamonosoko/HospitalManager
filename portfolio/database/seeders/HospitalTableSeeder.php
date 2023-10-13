<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードのuseが必要
use Carbon\Carbon;  // 時刻

class HospitalTableSeeder extends Seeder
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
                'hospital_name' => '佐藤医院',
                'department_id' => '1',
                'id' => '1',
            ],
            [
                'hospital_name' => '加藤医院',
                'department_id' => '2',
                'id' => '1',
            ],
            [
                'hospital_name' => '斎藤医院',
                'department_id' => '3',
                'id' => '1',
            ],
            [
                'hospital_name' => '後藤医院',
                'department_id' => '3',
                'id' => '2',
            ],
        ];

        // INSERT
        $now = Carbon::now();
        foreach($params as $param){
            $param['created_at'] = $now;
            $param['updated_at'] = $now;
            DB::table('hospitals')->insert($param);
        }
    }
}
