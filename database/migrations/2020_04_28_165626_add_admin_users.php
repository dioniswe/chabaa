<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ad username
        Schema::table('users', function (Blueprint $table) {
            $table->string('username');
        });
        // add admin user
        $user = new \App\User();
        $user->username = config('chabaa.CHABAA_ADMIN_USER');
        $user->email = 'no@email.yet';
        $user->name = 'Iam Servant';
        $user->password =  \Illuminate\Support\Facades\Hash::make( config('chabaa.CHABAA_ADMIN_PASSWORD'));
        $user->save();
        // add congregation user
        $user = new \App\User();
        $user->username = config('chabaa.CHABAA_CONGREGATION_USER');
        $user->email = 'neither@email.yet';
        $user->name = 'Iam congregation';
        $user->password =  \Illuminate\Support\Facades\Hash::make( config('chabaa.CHABAA_CONGREGATION_PASSWORD'));
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
