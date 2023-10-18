<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードのuseが必要
use Carbon\Carbon;  // 時刻

class DepartmentTableSeeder extends Seeder
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
                'department_name' => '耳鼻咽頭科',
            ],
            [
                'department_name' => '眼科',
            ],
            [
                'department_name' => '皮膚科',
            ],
            [
                'department_name' => '呼吸器科',
            ],
            [
                'department_name' => '心療内科',
            ],
            [
                'department_name' => '精神科',
            ],
            [
                'department_name' => '整形外科',
            ],
            [
                'department_name' => '泌尿器科',
            ],
            [
                'department_name' => '循環器科',
            ],
            [
                'department_name' => '形成外科',
            ],
            [
                'department_name' => '脳神経外科',
            ],
            [
                'department_name' => '小児科',
            ],
            [
                'department_name' => '産婦人科',
            ],
            [
                'department_name' => 'リハビリテーション科',
            ],
            [
                'department_name' => '放射線科',
            ],
            [
                'department_name' => '麻酔科',
            ],
        ];

        // INSERT
        $now = Carbon::now();
        foreach($params as $param){
            $param['created_at'] = $now;
            $param['updated_at'] = $now;
            DB::table('departments')->insert($param);
        }
    }
}
