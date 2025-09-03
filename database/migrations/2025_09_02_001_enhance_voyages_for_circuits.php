<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('voyages', function (Blueprint $table) {
            // Renommer conceptuellement voyage -> circuit
            $table->integer('duree_nuits')->nullable()->after('duree_jours');
            
            // Informations circuit détaillées
            $table->decimal('prix_par_personne', 10, 2)->nullable()->after('prix_avec_guide');
            $table->decimal('supplement_chambre_individuelle', 10, 2)->nullable()->after('prix_par_personne');
            
            // Niveau de confort et services
            $table->enum('niveau_confort', ['economique', 'standard', 'superieur', 'luxe'])->default('standard')->after('difficulte');
            $table->json('services_inclus')->nullable()->after('hebergements_inclus'); // pension_complete, petit_dejeuner, etc.
            
            // Transport et logistique
            $table->string('point_depart')->nullable()->after('region');
            $table->string('point_arrivee')->nullable()->after('point_depart');
            $table->json('transport_details')->nullable(); // type_vehicule, climatisation, etc.
            
            // Informations pratiques
            $table->json('equipements_obligatoires')->nullable(); // chaussures_marche, maillot_bain, etc.
            $table->text('conseils_sante')->nullable();
            $table->text('infos_climat')->nullable();
            $table->text('infos_culture_locale')->nullable();
            
            // Tarification flexible
            $table->json('supplements')->nullable(); // {single_room: 50000, guide_prive: 25000}
            $table->json('reductions')->nullable(); // {groupe_10: 10, enfant: 20}
            
            // Disponibilité et planning
            $table->json('saisons_disponibles')->nullable(); // [1,2,3,11,12] pour mois
            $table->integer('delai_reservation_min')->default(7); // jours
            $table->boolean('sur_mesure')->default(false);
            
            // Indicateurs qualité
            $table->decimal('note_moyenne', 3, 2)->default(0);
            $table->integer('nombre_avis')->default(0);
            $table->integer('nombre_reservations')->default(0);
            $table->boolean('recommande')->default(false);
            $table->boolean('nouveau')->default(true);
        });
    }

    public function down()
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->dropColumn([
                'duree_nuits',
                'prix_par_personne',
                'supplement_chambre_individuelle', 
                'niveau_confort',
                'services_inclus',
                'point_depart',
                'point_arrivee',
                'transport_details',
                'equipements_obligatoires',
                'conseils_sante',
                'infos_climat',
                'infos_culture_locale',
                'supplements',
                'reductions',
                'saisons_disponibles',
                'delai_reservation_min',
                'sur_mesure',
                'note_moyenne',
                'nombre_avis',
                'nombre_reservations',
                'recommande',
                'nouveau'
            ]);
        });
    }
};