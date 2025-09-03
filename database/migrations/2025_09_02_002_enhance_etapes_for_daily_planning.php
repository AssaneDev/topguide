<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('etapes', function (Blueprint $table) {
            // Informations détaillées du jour
            $table->enum('type_hebergement', ['hotel', 'lodge', 'campement', 'chez_habitant', 'bivouac'])->nullable()->after('hebergement_etape');
            $table->integer('nombre_etoiles')->nullable()->after('type_hebergement');
            $table->json('caracteristiques_hebergement')->nullable(); // wifi, piscine, restaurant, etc.
            
            // Programme détaillé
            $table->time('heure_reveil')->nullable()->after('heure_fin');
            $table->time('heure_petit_dejeuner')->nullable()->after('heure_reveil');
            $table->time('heure_dejeuner')->nullable()->after('heure_petit_dejeuner');
            $table->time('heure_diner')->nullable()->after('heure_dejeuner');
            
            // Activités et lieux
            $table->json('lieux_visites')->nullable(); // [{nom: "Lac Rose", duree: 90, description: "..."}]
            $table->decimal('distance_km', 8, 2)->nullable(); // Distance parcourue ce jour
            $table->integer('duree_transport_minutes')->nullable();
            
            // Repas et spécialités
            $table->json('repas_details')->nullable(); // {petit_dejeuner: "Continental", dejeuner: "Thieboudienne", diner: "Barbecue"}
            $table->json('specialites_locales')->nullable(); // Plats à découvrir
            
            // Niveau d'activité
            $table->enum('niveau_activite', ['repos', 'leger', 'modere', 'intense'])->default('modere');
            $table->text('equipements_jour')->nullable(); // Équipements spécifiques pour ce jour
            
            // Photos et médias
            $table->json('galerie_jour')->nullable(); // Images spécifiques au jour
            
            // Informations pratiques
            $table->text('conseils_jour')->nullable(); // Conseils spécifiques pour ce jour
            $table->json('contacts_utiles')->nullable(); // Contacts locaux pour ce jour
            $table->boolean('jour_libre')->default(false); // Jour libre ou programme organisé
        });
    }

    public function down()
    {
        Schema::table('etapes', function (Blueprint $table) {
            $table->dropColumn([
                'type_hebergement',
                'nombre_etoiles',
                'caracteristiques_hebergement',
                'heure_reveil',
                'heure_petit_dejeuner',
                'heure_dejeuner',
                'heure_diner',
                'lieux_visites',
                'distance_km',
                'duree_transport_minutes',
                'repas_details',
                'specialites_locales',
                'niveau_activite',
                'equipements_jour',
                'galerie_jour',
                'conseils_jour',
                'contacts_utiles',
                'jour_libre'
            ]);
        });
    }
};