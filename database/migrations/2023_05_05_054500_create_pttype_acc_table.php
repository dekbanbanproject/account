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
        if (!Schema::hasTable('pttype_acc'))
        {
            Schema::connection('mysql_hos')->create('pttype_acc', function (Blueprint $table) {
                $table->bigIncrements('pttype_acc_id');
                $table->string('pttype_acc_code')->nullable();// 
                $table->string('pttype_acc_name')->nullable();//  
                $table->string('pttype_acc_eclaimid')->nullable();//  
                $table->string('pttype_acc_nhsoadpcode')->nullable(); //   
 
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pttype_acc');
    }
};
