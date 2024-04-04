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
        Schema::create('chat_file', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('filesize');
            $table->string('extention');
            $table->unsignedBigInteger('chat_id');
            $table->timestamps();
            
            $table->foreign('chat_id')->references('id')->on('ChatRoom')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('chat_file', function (Blueprint $table) {
                $table->dropForeign(['chat_id']);
                $table->dropColumn('chat_id');
            });
        
    }
};
