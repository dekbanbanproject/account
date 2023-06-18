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

        if (!Schema::hasTable('authen_auto'))
        {
            Schema::connection('mysql')->create('authen_auto', function (Blueprint $table) {
                $table->bigIncrements('authen_auto_id');
                $table->string('vn')->nullable();//
                $table->string('hn')->nullable();//
                $table->string('cid')->nullable();//
                $table->string('ptname')->nullable(); //
                $table->string('vstdate')->nullable(); //
                $table->string('ServiceCode')->nullable(); //
                $table->string('ServiceType')->nullable(); //
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authen_auto');
    }
};
