<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectProjectsToUsers extends Migration
{
    // public function up(){
    //     Schema::table('projects', function (Blueprint $table) {
    //         $table->unsignedBigInteger('user_id');
    //         $table->foreign('user_id')
    //                 ->references('id')
    //                 ->on('users')->onDelete('cascade');
    //     });
    // }
    public function up() {
        Schema::table('projects', function (Blueprint $table) {
	     // Būna useris “admin”, arba galima šioje vietoje sukurti naują userį jei egizistuojantys 
            $admin_uid = DB::table('users')->where('name', '=', 'Benas')->first('id');
            $table->unsignedBigInteger('user_id')->default($admin_uid->id);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}

