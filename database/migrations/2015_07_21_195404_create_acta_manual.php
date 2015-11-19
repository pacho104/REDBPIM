<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActaManual extends Migration {

/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::create('acta_manual',function(Blueprint $table){


$table->increments('id');
$table->integer('acta_banco_id_acta_banco')->unsigned();
$table->integer('man_proced_id_man_proced')->unsigned();

$table->foreign('acta_banco_id_acta_banco')
->references('id')->on('acta_banco')
->onDelete('restrict')
->onUpdate('cascade');

$table->foreign('man_proced_id_man_proced')
->references('id')->on('manual_procedimientos')
->onDelete('restrict')
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
Schema::drop('acta_manual');
}

}