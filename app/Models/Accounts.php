<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Accounts extends Model
{
    use HasFactory;
    protected $primaryKey = 'account_id';
    protected $fillable = [
        'name_account',
        'birth_place',
        'birth_date',
        'gender',
        'job_id',
        'deposit_amount',
        'province_id',
        'city_id',
        'district_id',
        'subdistrict_id',
        'street_name',
        'rt',
        'rw',
        'created_by',        
    ];

}
