<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    // public function medicine()
    // {
    //     return $this->belongsTo(Medicine::class, 'hospital_id', 'hospital_id');
    // }

    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'hospital_id');
    }
}
