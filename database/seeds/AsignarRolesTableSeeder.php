<?php
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Database\Seeder;

class AsignarRolesTableSeeder extends Seeder
{

    Public Function run()
    {
        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->display_name = 'Administrador de usuarios'; // opcional
        $admin->description = 'Se permite al usuario gestionar y editar otros usuarios'; // opcional
        $admin->save();

        /**
         * Creamos un Usuario
         */


        $user   = new \App\User();


        $user->nom_usuario = 'Juan Sebastian';
        $user->ape_usuario = 'Maya Narvaez';
        $user->num_identificacion = '1085293173';
        $user->tel_usuario = '7363301';
        $user->cel_usuario = '3147708366';
        $user->user_login = 'jumaya23';
        $user->email = 'jumaya19@gmail.com';
        $user->password = bcrypt('12345');
        $user->estado_user = 'REG';
        $user->id_municipio = '1';
        $user->id_tipo_secretaria = '1';
        $user->id_tipo_identificacion = '1';
        $user->id_cargo_usuario = '1';
        $user->save();

        /**
         * Asignamos el Rol admin al usuario
         * Usando el alias del paquete
         */
       // $user->attachRole($admin);// podemos enviar el Rol o el id del Rol

        /**
         * O usamos Eloquent
         */
        $user->roles()->attach($admin->id); //usamos solamente el id del Rol

        /**
         * Creamos permisos
         */
        $createPost = new \App\Permission();
        $createPost->name = 'gestion_gene';
        $createPost->display_name = 'Gestion General'; // opcional
        // Allow a user to...
        $createPost->description = 'Menú de Gestion General'; // opcional
        $createPost->save();

        $editUser = new \App\Permission();
        $editUser->name = 'gestion_not';
        $editUser->display_name = 'Gestion de Notificaciones'; // opcional
        // Allow a user to...
        $editUser->description = 'Menú de Notificaciones'; // opcional
        $editUser->save();

        /**
         * Al Rol admin le asignamos los permisos
         */
        $admin->attachPermission($createPost); //esto es equivalente a $admin->perms()->sync(array($createPost->id));
       // $admin->attachPermissions([$createPost, $editUser]); //esto es equivalente a $admin->perms()->sync(array($createPost->id, $editUser->id));

    }
}