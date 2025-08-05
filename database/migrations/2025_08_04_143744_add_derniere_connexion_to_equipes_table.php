<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDerniereConnexionToEquipesTable extends Migration
{
    public function up()
    {
        Schema::table('equipes', function (Blueprint $table) {
            $table->timestamp('derniere_connexion')->nullable()->after('actif');
        });
    }

    public function down()
    {
        Schema::table('equipes', function (Blueprint $table) {
            $table->dropColumn('derniere_connexion');
        });
    }
}