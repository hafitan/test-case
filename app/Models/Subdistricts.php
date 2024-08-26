<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subdistricts extends Model
{
    use HasFactory;
    protected $primaryKey = 'subdistrict_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastCustomer = self::orderBy('subdistrict_id', 'desc')->first();
            if (!$lastCustomer) {
                $model->subdistrict_id = 'BD001';
            } else {
                $lastId = (int) Str::substr($lastCustomer->subdistrict_id, 2);
                $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
                $model->subdistrict_id = 'BD' . $newId;
            }
        });
    }
}
