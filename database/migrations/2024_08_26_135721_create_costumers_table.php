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
        Schema::create('costumers', function (Blueprint $table) {
            $table->increments('customer_id')->first();
            $table->string('ref_user_id')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('birth_date');
            $table->string('password');
            $table->string('gender');
            $table->string('address');
            $table->bigInteger('deposite');
            $table->bigInteger('approve');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costumers');
    }
};
