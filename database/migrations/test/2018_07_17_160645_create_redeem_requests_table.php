<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();            
            $table->integer('point')->unsigned();
            $table->string('type')->default('PAYTM');
            $table->string('number');
            $table->boolean('status')->default(0);
            $table->string('message')->nullable();
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
        Schema::dropIfExists('redeem_requests');
    }
}
