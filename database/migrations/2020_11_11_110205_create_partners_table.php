<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->longText('image');
            $table->string('password');
            $table->string('address');
            $table->string('district');
            $table->string('state');
            $table->string('country');   
            $table->string('aadharno');
            $table->longText('proofimage');
            $table->string('status')->default('requested');
            $table->string('lastappoint')->default('0');
            $table->string('terms');
            $table->rememberToken();
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
        Schema::dropIfExists('partners');
    }
}