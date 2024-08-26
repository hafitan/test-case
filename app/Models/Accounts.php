<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Accounts extends Model
{
    use HasFactory;
    protected $primaryKey = 'account_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastCustomer = self::orderBy('account_id', 'desc')->first();
            if (!$lastCustomer) {
                $model->account_id = 'BD001';
            } else {
                $lastId = (int) Str::substr($lastCustomer->account_id, 2);
                $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
                $model->account_id = 'BD' . $newId;
            }
        });
    }
}
