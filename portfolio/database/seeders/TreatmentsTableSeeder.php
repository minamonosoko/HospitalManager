<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードのuseが必要
use Carbon\Carbon;  // 時刻

class TreatmentsTableSeeder extends Seeder
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
                'treatment_content' => '初診',
            ],
            [
                'treatment_content' => '定期受診',
            ],
            [
                'treatment_content' => '検査',
            ],
        ];

        // INSERT
        $now = Carbon::now();
        foreach($params as $param){
            $param['created_at'] = $now;
            $param['updated_at'] = $now;
            DB::table('treatments')->insert($param);
        }    
    }
}
