<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('roles', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('label')->nullable();
        $table->timestamps();
      });

      Schema::create('permissions', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('label')->nullable();
        $table->timestamps();
      });

      Schema::create('permission_role', function (Blueprint $table) {
        $table->integer('permission_id')->unsigned();
        $table->integer('role_id')->unsigned();

        $table->foreign('permission_id')
        ->references('id')
        ->on('permissions')
        ->onDelete('cascade');

        $table->foreign('role_id')
        ->references('id')
        ->on('roles')
        ->onDelete('cascade');

        $table->primary(['permission_id', 'role_id']);
      });

      Schema::create('admin_role', function (Blueprint $table) {
        $table->integer('role_id')->unsigned();
        $table->integer('admin_id')->unsigned();

        $table->foreign('role_id')
        ->references('id')
        ->on('roles')
        ->onDelete('cascade');

        $table->foreign('admin_id')
        ->references('id')
        ->on('admins')
        ->onDelete('cascade');

        $table->primary(['role_id', 'admin_id']);
      });
    	//seed database for admin and initiate super role
      DB::table('roles')->insert([
        'name' => 'super',
        'label' => 'This goup has all permissions' ,

        ]);

      DB::table('admin_role')->insert([
        'role_id' => '1',
        'admin_id' => '1' ,

        ]);

// show Roles on panel
      DB::table('links')->insert(
        array('display' => 'Roles',
          'url' => 'Role', 
          'main' => '1'
          ));

// show Permission on panel
      DB::table('links')->insert(
        array('display' => 'Permissions',
          'url' => 'Permission', 
          'main' => '1'
          ));

          // show Admin on panel
      DB::table('links')->insert(
        array('display' => 'Admins',
          'url' => 'Admin', 
          'main' => '1'
          ));



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('admin_role', function ( $table ) {
			$table->dropForeign(['role_id']);
			$table->dropForeign(['admin_id']);
		});

		Schema::drop('admin_role');
		Schema::drop('permission_role');
		Schema::drop('permissions');
		Schema::drop('roles');
    }
  }
