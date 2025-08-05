<?php

namespace Database\Seeders;

use App\Models\TemplateConsigne;
use Illuminate\Database\Seeder;

class TemplatesConsignesSeeder extends Seeder
{
    public function run()
    {
        $templates = [
            // Templates Photographe
            [
                'nom' => 'Template Photographe - Nature/Paysages',
                'description' => 'Template pour activités nature : lacs, déserts, mangroves',
                'type_equipe' => 'photographe',
                'categorie' => 'nature',
                'mots_cles' => ['lac', 'désert', 'mangrove', 'paysage', 'nature', 'coucher soleil', 'lever soleil'],
                'consignes_template' => "📸 FOCUS JOUR : {LIEU}

🎬 STORIES :
- Matin (08h) : Ambiance réveil + paysage matinal
- Action (14h) : {ACTIVITES} en cours + réactions clients
- Coucher soleil (18h30) : Golden hour + silhouettes
- Soir : Bilan + teaser demain

🎥 VIDÉO COURTE (45s) :
- Plan large paysage {LIEU}
- Action en cours (15s)
- Réactions clients émerveillés (15s)
- Plan final avec musique locale (15s)

📱 TECHNIQUE :
- Mode HDR pour paysages contrastés
- Objectif grand angle privilégié
- Batteries supplémentaires (autonomie)
- Protection matériel (sable/eau)
- Stabilisation vidéos obligatoire",
                'moments_cles_template' => [
                    'matin' => '08:00',
                    'action' => '14:00',
                    'golden_hour' => '18:30',
                    'soir' => '20:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#NatureSénégal', '#PaysageAfrique'],
                'objectifs_template' => 'Capturer la beauté naturelle du {LIEU} + émotions authentiques clients',
                'priorite_defaut' => 'importante',
                'ordre' => 1
            ],

            [
                'nom' => 'Template Photographe - Culture/Patrimoine',
                'description' => 'Template pour sites culturels : Gorée, Saint-Louis, monuments',
                'type_equipe' => 'photographe',
                'categorie' => 'culture',
                'mots_cles' => ['gorée', 'saint-louis', 'patrimoine', 'monument', 'musée', 'histoire', 'colonial'],
                'consignes_template' => "📸 FOCUS JOUR : {LIEU} - Patrimoine

🎬 STORIES :
- Arrivée (09h) : Première impression + architecture
- Visite guidée (11h) : Moments d'écoute + détails
- Pause déjeuner (13h) : Ambiance locale
- Exploration libre (15h) : Clients en autonomie
- Départ (17h) : Derniers regards + nostalgie

🎥 VIDÉO COURTE (60s) :
- Travelling architecture/monuments (20s)
- Guide expliquant histoire (20s)
- Clients découvrant + émotions (20s)

📱 TECHNIQUE :
- Respecter interdictions photos (lieux sacrés)
- Lumière naturelle privilégiée (flash interdit souvent)
- Plans de détail architecture
- Portraits avec autorisation
- Ambiance sonore importante",
                'moments_cles_template' => [
                    'arrivee' => '09:00',
                    'visite_guidee' => '11:00',
                    'pause' => '13:00',
                    'exploration' => '15:00',
                    'depart' => '17:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#PatrimoineUNESCO', '#CultureSénégalaise', '#HistoireAfrique'],
                'objectifs_template' => 'Documenter la richesse patrimoniale + transmettre émotion historique',
                'priorite_defaut' => 'critique',
                'ordre' => 2
            ],

            [
                'nom' => 'Template Photographe - Aventure/Action',
                'description' => 'Template pour activités aventure : pirogue, 4x4, plongée, safari',
                'type_equipe' => 'photographe',
                'categorie' => 'aventure',
                'mots_cles' => ['pirogue', '4x4', 'plongée', 'safari', 'dromadaire', 'aventure', 'action', 'sport'],
                'consignes_template' => "📸 FOCUS JOUR : {LIEU} - Aventure

🎬 STORIES :
- Préparatifs (08h) : Équipement + excitation
- Départ aventure (09h) : Action qui commence
- En cours (12h) : Pleine action + adrénaline
- Pause/repas (13h) : Récupération + sourires
- Final (16h) : Accomplissement + fierté

🎥 VIDÉO COURTE (30s) :
- Séquence action dynamique
- Réactions spontanées clients
- Musique rythmée/locale
- Montage énergique

📱 TECHNIQUE :
- GoPro/caméra étanche si besoin
- Mode sport/action activé
- Sécurisation matériel (sangles)
- Angles variés (contre-plongée/plongée)
- Anticipation mouvement",
                'moments_cles_template' => [
                    'preparation' => '08:00',
                    'depart' => '09:00',
                    'action' => '12:00',
                    'pause' => '13:00',
                    'final' => '16:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#AventureSénégal', '#ActionAfrique'],
                'objectifs_template' => 'Capturer adrénaline + sensations fortes de {ACTIVITES}',
                'priorite_defaut' => 'importante',
                'ordre' => 3
            ],

            // Templates Gestionnaire Posts
            [
                'nom' => 'Template Posts - Découverte Lieu',
                'description' => 'Template pour posts de découverte de nouveaux lieux',
                'type_equipe' => 'gestionnaire_posts',
                'categorie' => 'defaut',
                'mots_cles' => ['découverte', 'visite', 'arrivée', 'première', 'exploration'],
                'consignes_template' => "✍️ POST DÉCOUVERTE - {LIEU}

📝 STRUCTURE :
✨ ACCROCHE (1-2 lignes) :
- Description émotionnelle première impression
- Sensation/ambiance unique du lieu

🎯 DÉVELOPPEMENT (2-3 lignes) :
- Information culturelle/historique marquante
- Ce qui rend {LIEU} spécial/unique
- Anecdote guide ou fait surprenant

👥 EXPÉRIENCE GROUPE (1-2 lignes) :
- Réaction spontanée clients
- Moment fort de la journée
- Citation client si possible

📸 PHOTO : Paysage/monument représentatif
📍 LOCALISATION

⏰ PUBLICATION : 9h
💬 ENGAGEMENT : Répondre <2h
❓ QUESTION : 'Qui connaît ce lieu magique ?' ou 'Qui aimerait découvrir {LIEU} ?'",
                'moments_cles_template' => [
                    'publication' => '09:00',
                    'interaction_matin' => '11:00',
                    'relance_aprem' => '15:00',
                    'bilan_soir' => '19:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#SénégalAuthentique', '#DécouverteSénégal'],
                'objectifs_template' => 'Faire découvrir {LIEU} + créer envie + engagement communauté',
                'priorite_defaut' => 'normale',
                'ordre' => 10
            ],

            [
                'nom' => 'Template Posts - Rencontre Authentique',
                'description' => 'Template pour posts de rencontres avec locaux',
                'type_equipe' => 'gestionnaire_posts',
                'categorie' => 'culture',
                'mots_cles' => ['rencontre', 'habitant', 'artisan', 'pêcheur', 'local', 'authentique', 'famille'],
                'consignes_template' => "✍️ POST RENCONTRE - {LIEU}

📝 STRUCTURE :
🤝 PRÉSENTATION PERSONNE (2-3 lignes) :
- Prénom, âge approximatif, métier
- Ancrage local (depuis quand, famille)
- Trait marquant/spécialité

✨ APPORT AU VOYAGE (2-3 lignes) :
- Savoir/technique transmis
- Histoire/anecdote partagée
- Moment d'émotion créé

👥 IMPACT SUR CLIENTS (1-2 lignes) :
- Réaction du groupe
- Apprentissage marquant
- Citation client touchante

📸 PHOTO : Clients avec la personne locale
🙏 PHRASE FINALE : 'Ces rencontres font la richesse de nos voyages'

⏰ PUBLICATION : 9h
💬 ENGAGEMENT : Répondre <1h (contenu sensible)
❓ QUESTION : 'Quelle rencontre vous a le plus marqué en voyage ?'",
                'moments_cles_template' => [
                    'publication' => '09:00',
                    'surveillance' => '10:00',
                    'relance' => '14:00',
                    'cloture' => '18:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#RencontreAuthentique', '#CultureSénégalaise', '#HumanitéAfrique'],
                'objectifs_template' => 'Valoriser rencontre humaine + authenticité voyage + émotion',
                'priorite_defaut' => 'importante',
                'ordre' => 11
            ],

            [
                'nom' => 'Template Posts - Gastronomie',
                'description' => 'Template pour posts culinaires et découvertes gastronomiques',
                'type_equipe' => 'gestionnaire_posts',
                'categorie' => 'gastronomie',
                'mots_cles' => ['repas', 'cuisine', 'thiéboudiène', 'plat', 'marché', 'restaurant', 'dégustation'],
                'consignes_template' => "✍️ POST GASTRONOMIE - {LIEU}

📝 STRUCTURE :
🍽️ PRÉSENTATION PLAT (2-3 lignes) :
- Nom du plat + signification si possible
- Ingrédients principaux
- Particularité/tradition locale

👩‍🍳 PRÉPARATION/LIEU (2-3 lignes) :
- Qui prépare (chez l'habitant/restaurant)
- Méthode traditionnelle
- Ambiance du repas

😋 EXPÉRIENCE GUSTATIVE (2-3 lignes) :
- Première réaction clients
- Découverte de saveurs
- Comparaison/surprise

📸 PHOTO : Plat appétissant + clients dégustant
🥘 CONSEIL : 'À goûter absolument si vous venez au Sénégal !'

⏰ PUBLICATION : 13h (heure de repas)
💬 ENGAGEMENT : Partager recettes si demandé
❓ QUESTION : 'Quel plat sénégalais aimeriez-vous goûter ?'",
                'moments_cles_template' => [
                    'publication' => '13:00',
                    'interaction' => '14:00',
                    'relance_soir' => '19:30',
                    'cloture' => '21:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#CuisineSénégalaise', '#Thiéboudiène', '#SaveursSénégal'],
                'objectifs_template' => 'Faire découvrir richesse culinaire + créer envie gastronomique',
                'priorite_defaut' => 'normale',
                'ordre' => 12
            ],

            // Templates Mixtes (Both)
            [
                'nom' => 'Template Urgence/Problème',
                'description' => 'Template pour gérer les situations d\'urgence ou problèmes',
                'type_equipe' => 'both',
                'categorie' => 'defaut',
                'mots_cles' => ['urgence', 'problème', 'retard', 'annulation', 'météo', 'imprévu'],
                'consignes_template' => "🚨 GESTION URGENCE/PROBLÈME

📸 PHOTOGRAPHE/VIDÉASTE :
- PAS de publication immédiate
- Documenter la situation discrètement
- Photos/vidéos pour rapport interne uniquement
- Rester positif avec les clients
- Capturer solutions/alternatives mises en place

✍️ GESTIONNAIRE POSTS :
- PAUSE sur publications prévues
- Attendre consignes avant communication
- Préparer message positif si nécessaire
- Surveiller mentions/commentaires
- Répondre aux inquiétudes avec diplomatie

🎯 PRIORITÉ : Bien-être clients > Contenu réseaux
📞 CONTACT : Signaler immédiatement à l'agence
⏰ COMMUNICATION : Après résolution uniquement",
                'moments_cles_template' => [
                    'signalement' => '00:00',
                    'evaluation' => '00:15',
                    'action' => '00:30',
                    'communication' => '02:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#ÉquipeProfessionnelle'],
                'objectifs_template' => 'Gérer crise + protéger image agence + sécurité clients',
                'priorite_defaut' => 'critique',
                'ordre' => 0
            ],

            [
                'nom' => 'Template Soirée/Détente',
                'description' => 'Template pour moments de détente et soirées',
                'type_equipe' => 'both',
                'categorie' => 'defaut',
                'mots_cles' => ['soirée', 'détente', 'repos', 'convivial', 'groupe', 'ambiance'],
                'consignes_template' => "🌙 SOIRÉE/DÉTENTE - {LIEU}

📸 PHOTOGRAPHE/VIDÉASTE :
🎬 STORIES :
- Fin d'activités (17h) : Retour au logement
- Préparatifs (18h30) : Préparation soirée
- Ambiance (20h) : Groupe détendu
- Moments conviviaux (21h) : Échanges/rires

📱 TECHNIQUE :
- Mode nuit/faible luminosité
- Flash discret si autorisé
- Capturer spontanéité
- Respecter intimité groupe

✍️ GESTIONNAIRE POSTS :
📝 STRUCTURE POST :
- Fin de journée bien méritée
- Ambiance conviviale du groupe
- Moments de partage
- Préparation jour suivant

⏰ PUBLICATION : 20h (prime time)
🎯 OBJECTIF : Montrer esprit de groupe + détente + humanité",
                'moments_cles_template' => [
                    'fin_activites' => '17:00',
                    'preparatifs' => '18:30',
                    'ambiance' => '20:00',
                    'publication' => '20:00'
                ],
                'hashtags_template' => ['#VacancesSénégal', '#EspritGroupe', '#ConvivialitéSénégalaise'],
                'objectifs_template' => 'Montrer côté humain voyage + cohésion groupe + détente',
                'priorite_defaut' => 'normale',
                'ordre' => 20
            ]
        ];

        foreach ($templates as $templateData) {
            TemplateConsigne::updateOrCreate(
                [
                    'nom' => $templateData['nom'],
                    'type_equipe' => $templateData['type_equipe']
                ],
                $templateData
            );
        }

        $this->command->info('Templates de consignes créés avec succès !');
    }
}