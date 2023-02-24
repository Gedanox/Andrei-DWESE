<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iduser');
            $table->foreignId('idcategory');
            $table->string('name', 100)->unique();
            $table->string('photo', 100);
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->timestamp('created_at');
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idcategory')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};