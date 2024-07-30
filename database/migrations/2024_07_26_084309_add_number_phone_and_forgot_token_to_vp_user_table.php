<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberPhoneAndForgotTokenToVpUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vp_users', function (Blueprint $table) {
            //
            $table->string('number_phone')->nullable()->after('password');
            $table->string('forgot_token')->nullable()->after('number_phone');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vp_users', function (Blueprint $table) {
            //
            $table->dropColumn('number_phone');
            $table->dropColumn('forgot_token');
        });
    }
}
