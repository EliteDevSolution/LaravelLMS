<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("company_id")->nullable()->default("0");
            $table->string('first_name')->nullable()->default("");
            $table->string('last_name')->nullable()->default("");
            $table->string('email');
            $table->string('business')->nullable()->default("");
            $table->string('department')->nullable()->default("");
            $table->string('market_stall')->nullable()->default("");
            $table->string('home')->nullable()->default("");
            $table->string('city')->nullable()->default("");
            $table->string('state')->nullable()->default("");
            $table->string('phone')->nullable()->default("");
            $table->text('notes')->nullable();
            $table->string('photo')->nullable()->default("assets/images/users/user-1.jpg");
            $table->string('password');
            $table->string('remember_token')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
