<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('reservations', function (Blueprint $table) {
        if (Schema::hasColumn('reservations', 'prix')) {
            $table->dropColumn('prix');
        }
    });
}

public function down(): void
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->decimal('prix', 8, 2)->nullable();
    });
}


};
