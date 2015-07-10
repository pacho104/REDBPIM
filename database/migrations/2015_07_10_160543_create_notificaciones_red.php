<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesRed extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        //Migracion Para la Creacion de la Tabla Notificaciones Red Departamental

        DB::statement('CREATE TABLE IF NOT EXISTS redbpim.notificaciones_red (
                      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                      nombre_notif_red VARCHAR(200) NOT NULL,
                      consecutivo_notif_red INT NOT NULL,
                      asunto_notifi_red VARCHAR(100) NOT NULL,
                      cuerpo_notif_red TEXT NOT NULL,
                      documento_notif_red VARCHAR(100) NOT NULL,
                      id_usuario INT NOT NULL,
                      PRIMARY KEY (id),
                      CONSTRAINT fk_usuario_notificacion
                      FOREIGN KEY (id_usuario)
                      REFERENCES redbpim.users (id)
                      ON DELETE RESTRICT
                      ON UPDATE CASCADE)
                      ENGINE = InnoDB');

        DB::statement('CREATE INDEX usuario_notificacion_idx ON redbpim.notificaciones_red (id_usuario ASC) ');

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se Elimina la Tabla en Caso de Requerirse así

        DB::statement('DROP TABLES redbpim.notificaciones_red') ;
	}

}
