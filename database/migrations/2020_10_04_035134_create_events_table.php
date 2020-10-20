<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_event');
            $table->string('deskripsi_event');
            $table->enum('kategori_event',['konser','festival','gaming','fashion','pameran','olahraga']);
            $table->string('tempat_event');
            $table->time('waktu_event');
            $table->date('tanggal_event');
            $table->integer('status_event')->nullable();
            $table->string('foto_event');
            $table->string('foto_identitas');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
