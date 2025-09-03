<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activites', function (Blueprint $table) {
            // Lien avec les étapes (jour spécifique)
            $table->foreignId('etape_id')->nullable()->constrained()->onDelete('set null')->after('voyage_id');
            
            // Planning détaillé
            $table->time('heure_debut_activite')->nullable()->after('duree_heures');
            $table->time('heure_fin_activite')->nullable()->after('heure_debut_activite');
            $table->integer('ordre_dans_journee')->default(1)->after('heure_fin_activite');
            
            // Localisation précise
            $table->string('lieu_exact')->nullable()->after('lieu_activite');
            $table->decimal('latitude', 10, 8)->nullable()->after('lieu_exact');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->text('acces_transport')->nullable(); // Comment s'y rendre
            
            // Informations pratiques
            $table->enum('niveau_difficulte', ['facile', 'modere', 'difficile', 'expert'])->default('facile');
            $table->integer('age_min')->nullable();
            $table->integer('age_max')->nullable();
            $table->integer('participants_min')->default(1);
            $table->integer('participants_max')->nullable();
            
            // Tarification détaillée
            $table->decimal('prix_enfant', 10, 2)->nullable(); // Prix spécial enfant
            $table->decimal('prix_groupe', 10, 2)->nullable(); // Prix de groupe
            $table->json('tarifs_speciaux')->nullable(); // {etudiant: 15000, senior: 18000}
            
            // Conditions et prérequis
            $table->text('conditions_physiques')->nullable();
            $table->text('contre_indications')->nullable();
            $table->boolean('accessible_handicap')->default(false);
            $table->json('langues_disponibles')->nullable(); // [fr, en, es]
            
            // Informations complémentaires
            $table->text('que_apporter')->nullable(); // Ce qu'il faut apporter
            $table->text('inclus_activite')->nullable(); // Ce qui est inclus
            $table->text('non_inclus_activite')->nullable(); // Ce qui n'est pas inclus
            $table->text('conseils_preparation')->nullable();
            
            // Météo et saisons
            $table->json('meilleures_periodes')->nullable(); // Mois recommandés
            $table->text('infos_meteo')->nullable();
            
            // Réservation et annulation
            $table->integer('delai_annulation_heures')->default(24);
            $table->boolean('annulation_gratuite')->default(false);
            $table->text('politique_annulation')->nullable();
            
            // Indicateurs
            $table->boolean('populaire')->default(false);
            $table->boolean('eco_responsable')->default(false);
            $table->boolean('experience_unique')->default(false);
            $table->decimal('note_activite', 3, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->dropColumn([
                'etape_id',
                'heure_debut_activite',
                'heure_fin_activite', 
                'ordre_dans_journee',
                'lieu_exact',
                'latitude',
                'longitude',
                'acces_transport',
                'niveau_difficulte',
                'age_min',
                'age_max',
                'participants_min',
                'participants_max',
                'prix_enfant',
                'prix_groupe',
                'tarifs_speciaux',
                'conditions_physiques',
                'contre_indications',
                'accessible_handicap',
                'langues_disponibles',
                'que_apporter',
                'inclus_activite',
                'non_inclus_activite',
                'conseils_preparation',
                'meilleures_periodes',
                'infos_meteo',
                'delai_annulation_heures',
                'annulation_gratuite',
                'politique_annulation',
                'populaire',
                'eco_responsable',
                'experience_unique',
                'note_activite'
            ]);
        });
    }
};