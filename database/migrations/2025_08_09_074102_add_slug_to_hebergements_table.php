<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        // Étape 1: Ajouter la colonne slug sans contrainte unique
        Schema::table('hebergements', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('nom');
        });

        // Étape 2: Générer les slugs pour les enregistrements existants
        $hebergements = \App\Models\Hebergement::all();
        foreach ($hebergements as $hebergement) {
            $slug = Str::slug($hebergement->nom);
            
            // Si le slug est vide, utiliser l'ID
            if (empty($slug)) {
                $slug = 'hebergement-' . $hebergement->id;
            }
            
            // Vérifier l'unicité
            $originalSlug = $slug;
            $count = 1;
            while (\App\Models\Hebergement::where('slug', $slug)
                   ->where('id', '!=', $hebergement->id)
                   ->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            $hebergement->update(['slug' => $slug]);
        }

        // Étape 3: Ajouter la contrainte unique maintenant que tous les slugs sont remplis
        Schema::table('hebergements', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down()
    {
        Schema::table('hebergements', function (Blueprint $table) {
            $table->dropUnique(['hebergements_slug_unique']);
            $table->dropColumn('slug');
        });
    }
};