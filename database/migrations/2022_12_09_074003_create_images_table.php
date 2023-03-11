<?php

use App\Models\Tipo;
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
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('imageroute', 100);
            $table->string('thumbnail', 100);
            $table->foreignId('idreview');
            $table->timestamps();
            $table->foreign('idreview')->references('id')->on('review');
        });
        $sql = 'alter table image change thumbnail thumbnail longblob';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image');
    }
};