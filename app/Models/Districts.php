<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Districts extends Model
{
    use HasFactory;
    protected $primaryKey = 'district_id';
    // public $incrementing = false;
    // protected $keyType = 'string';

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $lastCustomer = self::orderBy('district_id', 'desc')->first();
    //         if (!$lastCustomer) {
    //             $model->district_id = 'BC001';
    //         } else {
    //             $lastId = (int) Str::substr($lastCustomer->district_id, 2);
    //             $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
    //             $model->district_id = 'BC' . $newId;
    //         }
    //     });
    // }
}
