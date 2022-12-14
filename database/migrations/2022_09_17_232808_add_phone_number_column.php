<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneNumberColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zaposleni', function (Blueprint $table) {
            $table->after('password', function ($table) {
                $table->string('phone_number');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zaposleni', function (Blueprint $table) {
            $table->dropColumn('phone_number');
        });
    }
}
