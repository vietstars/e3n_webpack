<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->string('env')->nullable();
            $table->string('level')->index();
            $table->string('level_name');
            $table->longText('message');
            $table->json('context');
            $table->json('extra');
            $table->longText('formatted');
            $table->boolean('is_console')->default(false);
            $table->foreignId('user_id')->nullable();
            $table->string('user_email')->nullable();
            $table->string('request_url', 1000)->nullable();
            $table->string('request_method')->nullable();
            $table->json('input_param')->nullable();
            $table->string('remote_addr')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_logs');
    }
}
