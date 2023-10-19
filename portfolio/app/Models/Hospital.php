<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 病院モデル
 */
class Hospital extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'hospitals';

    // 主キー
    protected $primaryKey = 'hospital_id';

    // 登録・更新可能カラム
    protected $fillable = [
        'hospital_name',
        'hospital_phone_number',
        'hospital_address',
        'previous_attend',
        'next_attend',
        'department_id',
        'id',
        'previous_treatment_id',
        'next_treatment_id',
        'flag_delete',
        'updated_at',
    ];

    public function updateHospital($post_data)
    {
        $this->update([
            'hospital_phone_number' => $post_data['phone_number'],
            'hospital_address' => $post_data['address'],
            'previous_attend' => $post_data['attend_previous'],
            'next_attend' => $post_data['attend_next'],
            'previous_treatment_id' => $post_data['treatment_previous'],
            'next_treatment_id' => $post_data['treatment_next'],
        ]);
    }

    public function softDelete()
    {    
        // 論理削除
        $this->update([
            'flag_delete' => 1,
        ]);
    }
}
