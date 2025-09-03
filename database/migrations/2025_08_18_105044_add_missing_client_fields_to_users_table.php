<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Liste des colonnes à ajouter avec leur configuration
        $columnsToAdd = [
            'address' => ['type' => 'text', 'nullable' => true, 'after' => 'phone'],
            'date_naissance' => ['type' => 'date', 'nullable' => true, 'after' => 'address'],
            'preferences_voyage' => ['type' => 'json', 'nullable' => true, 'after' => 'date_naissance'],
            'derniere_connexion' => ['type' => 'timestamp', 'nullable' => true, 'after' => 'updated_at'],
            'score_engagement' => ['type' => 'integer', 'default' => 0, 'after' => 'derniere_connexion'],
            'notifications_email' => ['type' => 'boolean', 'default' => true, 'after' => 'score_engagement'],
            'notifications_sms' => ['type' => 'boolean', 'default' => false, 'after' => 'notifications_email'],
            'langue_preferee' => ['type' => 'string', 'length' => 2, 'default' => 'fr', 'after' => 'notifications_sms']
        ];
        
        Schema::table('users', function (Blueprint $table) use ($columnsToAdd) {
            foreach ($columnsToAdd as $columnName => $config) {
                if (!Schema::hasColumn('users', $columnName)) {
                    echo "Ajout de la colonne: $columnName\n";
                    
                    switch ($config['type']) {
                        case 'text':
                            $column = $table->text($columnName);
                            break;
                        case 'date':
                            $column = $table->date($columnName);
                            break;
                        case 'json':
                            $column = $table->json($columnName);
                            break;
                        case 'timestamp':
                            $column = $table->timestamp($columnName);
                            break;
                        case 'integer':
                            $column = $table->integer($columnName);
                            break;
                        case 'boolean':
                            $column = $table->boolean($columnName);
                            break;
                        case 'string':
                            $length = $config['length'] ?? 255;
                            $column = $table->string($columnName, $length);
                            break;
                        default:
                            continue 2; // Skip this iteration
                    }
                    
                    // Appliquer les modificateurs
                    if (isset($config['nullable']) && $config['nullable']) {
                        $column->nullable();
                    }
                    
                    if (isset($config['default'])) {
                        $column->default($config['default']);
                    }
                    
                    if (isset($config['after'])) {
                        $column->after($config['after']);
                    }
                } else {
                    echo "Colonne $columnName existe déjà, ignorée\n";
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $columnsToRemove = [
            'langue_preferee',
            'notifications_sms', 
            'notifications_email',
            'score_engagement',
            'derniere_connexion',
            'preferences_voyage',
            'date_naissance',
            'address'
            // Pas 'phone' car elle existait déjà
        ];
        
        Schema::table('users', function (Blueprint $table) use ($columnsToRemove) {
            foreach ($columnsToRemove as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};