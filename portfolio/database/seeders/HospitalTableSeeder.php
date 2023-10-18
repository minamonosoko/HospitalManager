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
                'hospital_phone_number' => '000-0000-000',
                'hospital_address' => '秋田県秋田市下新城中野4-20-13	',
                'previous_attend' => '2023-10-14T10:30',
                'next_attend' => '2023-11-14T11:45',
                'department_id' => '1',
                'id' => '1',
                'previous_treatment_id' => '1',
                'next_treatment_id' => '2',
            ],
            [
                'hospital_name' => '斎藤医院',
                'hospital_phone_number' => '111-1111-111',
                'hospital_address' => '宮城県伊具郡丸森町峠向2-8-10',
                'previous_attend' => '2023-10-12T10:30',
                'next_attend' => '2023-12-14T10:30',
                'department_id' => '2',
                'id' => '1',
                'previous_treatment_id' => '3',
                'next_treatment_id' => '1',
            ],
            [
                'hospital_name' => '後藤医院',
                'hospital_phone_number' => '222-2222-222',
                'hospital_address' => '宮崎県延岡市東本小路4-8-18',
                'previous_attend' => '2023-11-14T15:20',
                'next_attend' => '2023-12-14T15:30',
                'department_id' => '3',
                'id' => '1',
                'previous_treatment_id' => '2',
                'next_treatment_id' => '3',
            ],
            [
                'hospital_name' => '加藤医院',
                'hospital_phone_number' => '333-3333-333',
                'hospital_address' => '愛媛県西宇和郡伊方町豊之浦2-12-1',
                'previous_attend' => '2023-10-23T18:30',
                'next_attend' => '2023-10-30T18:30',
                'department_id' => '4',
                'id' => '1',
                'previous_treatment_id' => '2',
                'next_treatment_id' => '3',
            ],
            [
                'hospital_name' => '相藤医院',
                'hospital_phone_number' => '444-4444-444',
                'hospital_address' => '北海道白糠郡白糠町南上茶路591-3',
                'previous_attend' => '2023-10-26T14:30',
                'next_attend' => '2023-10-30T15:30',
                'department_id' => '5',
                'id' => '1',
                'previous_treatment_id' => '2',
                'next_treatment_id' => '3',
            ],
            [
                'hospital_name' => '朝藤医院',
                'hospital_phone_number' => '555-5555-555',
                'hospital_address' => '茨城県小美玉市中野谷707-16',
                'previous_attend' => '2023-11-26T12:30',
                'next_attend' => '2023-10-30T15:30',
                'department_id' => '6',
                'id' => '2',
                'previous_treatment_id' => '2',
                'next_treatment_id' => '3',
            ],
            [
                'hospital_name' => '阿藤医院',
                'hospital_phone_number' => '666-6666-666',
                'hospital_address' => '鹿児島県姶良市加治木町木田898-4',
                'previous_attend' => '2023-10-26T14:30',
                'next_attend' => '2023-10-30T15:30',
                'department_id' => '7',
                'id' => '2',
                'previous_treatment_id' => '2',
                'next_treatment_id' => '3',
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
