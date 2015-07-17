<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificacionesRed extends Migration {

    /**
     * Run the migrations.
     * Migracion Para la Creacion de la Tabla Notificaciones Red Departamental a través del metodo up
     * @return voidE
     */
    public function up()
    {

        Schema::create('notificaciones_red',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('nombre_notif_red',200);
            $table->integer('consecutivo_notif_red');
            $table->string('asunto_notif_red',100);
            $table->text('cuerpo_notif_red');
            $table->text('documento_notif_red',100);
            $table->integer('id_usuario')->unsigned();

            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        });
    }

    /**
     *  ELIMINAR LAS MIGRACIONES.
     * Se Elimina la Tabla NOTIFICACIONES RED en Caso de Requerirse a traves del metodo down()
     * @return void
     */
    public function down()
    {
        Schema::drop('notificaciones_red');
    }

}


