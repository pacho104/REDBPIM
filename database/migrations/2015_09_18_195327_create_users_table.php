<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nom_usuario');
            $table->string('ape_usuario', 60);
            $table->string('num_identificacion', 20)->unique();
            $table->string('tel_usuario', 30)->nullable();
            $table->string('cel_usuario', 30)->nullable();
            $table->string('user_login')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('estado_user', 3);
            $table->integer('id_municipio')->unsigned();
            $table->integer('id_tipo_secretaria')->unsigned();
            $table->integer('id_tipo_identificacion')->unsigned();
            $table->integer('id_cargo_usuario')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_municipio')
                  ->references('id')->on('municipio')
                  ->onUpdate('cascade');

            $table->foreign('id_tipo_secretaria')
                  ->references('id')->on('tipo_secretaria')
                  ->onUpdate('cascade');

            $table->foreign('id_tipo_identificacion')
                  ->references('id')->on('tipo_identificacion')
                  ->onUpdate('cascade');

            $table->foreign('id_cargo_usuario')
                  ->references('id')->on('cargo_usuario')
                  ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}