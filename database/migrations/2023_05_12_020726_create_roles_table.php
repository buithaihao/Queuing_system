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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('roleid');
            $table->string('rolename')->unique();
            $table->string('numberuser');
            $table->string('describe');
            $table->integer('Tthietbi')->nullable();
            $table->integer('Ctthietbi')->nullable();
            $table->integer('Cnthietbi')->nullable();
            $table->integer('Tdichvu')->nullable();
            $table->integer('Ctdichvu')->nullable();
            $table->integer('Cndichvu')->nullable();
            $table->integer('Capso')->nullable();
            $table->integer('Ctcapso')->nullable();
            $table->integer('Tvaitro')->nullable();
            $table->integer('Cnvaitro')->nullable();
            $table->integer('Ttaikhoan')->nullable();
            $table->integer('Cntaikhoan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
