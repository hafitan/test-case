<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jobs extends Model
{
    use HasFactory;
    protected $primaryKey = 'job_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'job_name'
    ];   

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastCustomer = self::orderBy('job_id', 'desc')->first();
            if (!$lastCustomer) {
                $model->job_id = 'AC0001';
            } else {
                $lastId = (int) Str::substr($lastCustomer->job_id, 2);
                $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
                $model->job_id = 'AC' . $newId;
            }
        });
    }
}
