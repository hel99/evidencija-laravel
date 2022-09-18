<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKasnjenjaColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zaposleni', function (Blueprint $table) {
            $table->after('phone_number', function ($table) {
                $table->integer('kasnjenja');
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
            $table->dropColumn('kasnjenja');
        });
    }
}
