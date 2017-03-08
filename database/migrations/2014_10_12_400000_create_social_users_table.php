<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSocialUsersTable.
 */
class CreateSocialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();

            //Google Social id is so big than can not be stored in a BIGINT so varchar is used!
            $table->string('social_id');
            $table->string('social_type');
            $table->string('nickname')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('avatar')->nullable();

            $table->json('meta');

            $table->timestamps();

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
        Schema::dropIfExists('social_users');
    }
}
