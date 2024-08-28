<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id')->first();
            $table->string('name_account');
            $table->string('birth_place');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('ref_job_id');
            $table->string('ref_province_id');
            $table->string('ref_district_id');
            $table->string('ref_subdistrict_id');
            $table->string('ref_ward_id');
            $table->string('street_name');
            $table->string('rt');
            $table->string('rw');
            $table->string('deposit_amount');
            $table->string('status');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
