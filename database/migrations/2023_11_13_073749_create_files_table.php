<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('files', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('campaign_id');
        $table->string('name');
        $table->string('file_data');
        $table->timestamps();

        $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
