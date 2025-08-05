<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsigneCommunication extends Model
{
    use HasFactory;

    // ✅ ASSURER que le nom de table correspond à votre migration
    protected $table = 'consignes_equipe'; // Selon votre migration create_consigne_equipe

    protected $fillable = [
        'programme_journalier_id', 
        'type_equipe', 
        'consignes_specifiques',
        'moments_cles', 
        'hashtags_jour', 
        'objectifs_contenu', 
        'priorite'
    ];

    protected $casts = [
        'moments_cles' => 'array',
        'hashtags_jour' => 'array'
    ];

    public function programmeJournalier()
    {
        return $this->belongsTo(ProgrammeJournalier::class);
    }
}

// ===== SI VOUS AVEZ UNE ERREUR DE TABLE, CRÉEZ CETTE MIGRATION =====
// Fichier: database/migrations/2024_XX_XX_rename_consignes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameConsignesTable extends Migration
{
    public function up()
    {
        // Si votre table s'appelle différemment, renommez-la
        if (Schema::hasTable('consignes_communication') && !Schema::hasTable('consignes_equipe')) {
            Schema::rename('consignes_communication', 'consignes_equipe');
        }
        
        // OU créez la table si elle n'existe pas
        if (!Schema::hasTable('consignes_equipe')) {
            Schema::create('consignes_equipe', function (Blueprint $table) {
                $table->id();
                $table->foreignId('programme_journalier_id')->constrained('programme_journaliers')->onDelete('cascade');
                $table->enum('type_equipe', ['photographe', 'gestionnaire_posts']);
                $table->text('consignes_specifiques');
                $table->json('moments_cles');
                $table->json('hashtags_jour');
                $table->text('objectifs_contenu');
                $table->enum('priorite', ['normale', 'importante', 'critique'])->default('normale');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('consignes_equipe');
    }
}