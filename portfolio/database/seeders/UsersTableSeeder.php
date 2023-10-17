<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードのuseが必要
use Carbon\Carbon;  // 時刻

class UsersTableSeeder extends Seeder
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
                'name' => 'yamada',
                'email' => 'yamada@example.com',
                'email_verified_at' => '1',
                'password' => '$2y$10$LnIOInXmBrv3y/Fk1TzEZe.Azga7IT2dLgzRN9sTTeNfu3ewQnHZy',
                'remember_token' => '',
                'current_team_id' => '',
                'profile_photo_path' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'two_factor_secret' => '',
                'two_factor_recovery_codes' => '',
                'two_factor_confirmed_at' => '',
            ],
            [
                'name' => 'satou',
                'email' => 'satou@example.com',
                'email_verified_at' => '1',
                'password' => '$2y$10$uMPLK75wgUMU8QFiI1WFB.oSN3kmXFUVlgr0UJIWsEJJ5q80Dewfa',
                'remember_token' => '',
                'current_team_id' => '',
                'profile_photo_path' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'two_factor_secret' => '',
                'two_factor_recovery_codes' => '',
                'two_factor_confirmed_at' => '',
            ],
        ];

        // INSERT
        $now = Carbon::now();
        foreach($params as $param){
            // $param['created_at'] = $now;
            // $param['updated_at'] = $now;
            DB::table('users')->insert($param);
        }
    }
}
