<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_flags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->boolean('app_install_verify')->default(0);                        
            $table->boolean('status')->default(0);                        
            $table->boolean('daily_check_in')->default(0);                        
            $table->boolean('parent_code_verify')->default(0);                        
            $table->tinyInteger('quiz')->default(0);                        
            $table->boolean('memory_quiz')->default(0);                        
            $table->boolean('redoffer')->default(0);                        
            $table->tinyInteger('spin')->default(0);                        
            $table->boolean('specail_offer')->default(0); 
            $table->timestamps();            

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_flags');
    }
}
