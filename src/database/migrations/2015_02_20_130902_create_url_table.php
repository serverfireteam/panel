<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlTable extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('links', function($table)
             {
                     $table->increments('id');
                     $table->string('display');
                     $table->string('url');
                     $table->boolean('show_menu')->nullable();
                     $table->boolean('main')->nullable();
                     $table->timestamps();
                     // We'll need to ensure that MySQL uses the InnoDB engine to
                     // support the indexes, other engines aren't affected.
                     $table->engine = 'InnoDB';                     
            });
        
            $links = [
                [
                    'display' => 'Links',
                    'url' =>  'Link'
                ],
            /*
                [
                    'display' => 'Roles',
                    'url' => 'Role',
                ],
                [
                    'display' => 'Permissions',
                    'url' => 'Permission',
                ],
                [
                    'display' => 'Users',
                    'url' => 'User'
                ]
            */
            ];
            foreach ($links as $linkData) {
                $link = new Serverfireteam\Panel\Link;
                $link->fill($linkData);
                $link->main = true;
                $link->show_menu = true;
                $link->save();
            }
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::drop('links');
        }

}
