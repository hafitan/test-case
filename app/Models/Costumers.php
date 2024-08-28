<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Costumers extends Model
{
    use HasFactory;
    protected $primaryKey = 'costumer_id';
    // public $incrementing = false;
    // protected $keyType = 'string';

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $lastCustomer = self::orderBy('costumer_id', 'desc')->first();
    //         if (!$lastCustomer) {
    //             $model->costumer_id = 'AB001';
    //         } else {
    //             $lastId = (int) Str::substr($lastCustomer->costumer_id, 2);
    //             $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
    //             $model->costumer_id = 'AB' . $newId;
    //         }
    //     });
    // }
}
