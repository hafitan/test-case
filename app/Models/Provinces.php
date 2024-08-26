<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Provinces extends Model
{
    use HasFactory;
    protected $primaryKey = 'province_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastCustomer = self::orderBy('costumer_id', 'desc')->first();
            if (!$lastCustomer) {
                $model->costumer_id = 'BA001';
            } else {
                $lastId = (int) Str::substr($lastCustomer->costumer_id, 2);
                $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
                $model->costumer_id = 'BA' . $newId;
            }
        });
    }
}
