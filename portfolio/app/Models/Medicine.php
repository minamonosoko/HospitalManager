<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 薬モデル
 */
class Medicine extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'medicines';

    // 主キー
    protected $primaryKey = 'medicine_id';

    // 登録・更新可能カラム
    protected $fillable = [
        'medicine_name',
        'hospital_id',
        'medicine_stock',
        'deleted_at',
        'updated_at',
    ];

    public static function updateMedicine($medicine_id, $medicine_stock, $medicine_name)
    {
        $medicine = self::find($medicine_id);

        if($medicine)
        {
            $medicine->medicine_name = $medicine_name;
            $medicine->medicine_stock = $medicine_stock;
            $medicine->save();
        }
    }

    public function createMedicine($medicine_new_name, $medicine_new_stock, $hospital_id)
    {
        return $this->create([
            'medicine_name' => $medicine_new_name,
            'hospital_id' => $hospital_id,
            'medicine_stock' => $medicine_new_stock,
        ]);
    }
}
