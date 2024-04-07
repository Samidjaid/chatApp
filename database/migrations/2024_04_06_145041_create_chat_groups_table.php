 
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
        Schema::create('chat_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('message_details')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->timestamps();
            
            $table->foreign('file_id')->references('id')->on('_chat_file')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_groups', function (Blueprint $table) {
            $table->dropForeign(['file_id']);
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('chat_groups');
    }
};

