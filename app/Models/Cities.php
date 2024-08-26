<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cities extends Model
{
    use HasFactory;
    protected $primaryKey = 'city_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastCustomer = self::orderBy('city_id', 'desc')->first();
            if (!$lastCustomer) {
                $model->city_id = 'BB001';
            } else {
                $lastId = (int) Str::substr($lastCustomer->city_id, 2);
                $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
                $model->city_id = 'BB' . $newId;
            }
        });
    }
}
