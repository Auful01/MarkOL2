<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultProfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->string('jenis_kelamin')->default(null)->change();
            $table->string('nim')->default(null)->change();
            $table->date('tgl_lahir')->default(null)->change();
            $table->string('domisili')->default(null)->change();
            $table->string('wa')->default(null)->change();
            $table->string('photo')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
