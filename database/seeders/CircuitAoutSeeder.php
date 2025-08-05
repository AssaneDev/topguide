<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

namespace Database\Seeders;

use App\Models\Circuit;
use App\Models\ProgrammeJournalier;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CircuitAoutSeeder extends Seeder
{
    public function run()
    {
        $circuit = Circuit::create([
            'nom' => 'Circuit Août 2025',
            'date_debut' => '2025-08-05',
            'date_fin' => '2025-08-21',
            'nb_jours' => 17,
            'description' => 'Circuit complet de 17 jours à travers le Sénégal',
            'statut' => 'planifié',
            'guide_principal' => 'Ibrahima Diallo'
        ]);

        $programmes = [
            [
                'jour_numero' => 1,
                'date' => '2025-08-05',
                'lieu_principal' => 'Aéroport Diass / Île de Ngor',
                'activites' => "Accueil à l'aéroport de Diass à 15h15\nTransfert vers l'île de Ngor\nTraversée en pirogue traditionnelle\nInstallation en résidence\nDîner et nuitée selon horaire d'arrivée",
                'hebergement' => 'Résidence Île de Ngor',
                'horaires' => [
                    'arrivee' => '15:15',
                    'transfert' => '16:00',
                    'installation' => '17:30',
                    'diner' => '19:30'
                ],
                'notes_speciales' => 'Traversée en pirogue obligatoire pour rejoindre l\'île'
            ],
            [
                'jour_numero' => 2,
                'date' => '2025-08-06',
                'lieu_principal' => 'Île de Gorée',
                'activites' => "Départ pour l'île de Gorée\nTraversée en chaloupe\nInstallation à La Principauté\nDéjeuner sur place\nVisite libre de l'île l'après-midi\nDîner et nuitée",
                'hebergement' => 'La Principauté - Gorée',
                'horaires' => [
                    'depart' => '09:00',
                    'traversee' => '09:30',
                    'dejeuner' => '13:00',
                    'visite_libre' => '15:00',
                    'diner' => '19:00'
                ]
            ],
            [
                'jour_numero' => 3,
                'date' => '2025-08-07',
                'lieu_principal' => 'Gorée / Dakar / Île de Ngor',
                'activites' => "Visite de la Maison des Esclaves à Gorée\nDéjeuner sur place\nTraversée vers Dakar\nAperçu de la ville\nVisite du Monument de la Renaissance (extérieur)\nAprès-midi libre\nRetour à l'île de Ngor\nDîner et nuitée",
                'hebergement' => 'Résidence Île de Ngor (proximité club Nautilus)',
                'horaires' => [
                    'visite_maison' => '09:00',
                    'dejeuner' => '12:30',
                    'depart_dakar' => '14:00',
                    'monument' => '15:30',
                    'retour_ngor' => '17:00',
                    'diner' => '19:30'
                ],
                'notes_speciales' => 'Nuitée près du club de plongée le Nautilus'
            ],
            [
                'jour_numero' => 4,
                'date' => '2025-08-08',
                'lieu_principal' => 'Dakar / Lac Rose',
                'activites' => "Plongée au club le Nautilus (pour certains)\nDéjeuner à Dakar\nDépart pour le Lac Rose à 14h00\nInstallation\nDîner et nuitée",
                'hebergement' => 'Résidence Lac Rose',
                'horaires' => [
                    'plongee' => '08:00',
                    'dejeuner' => '12:00',
                    'depart_lac' => '14:00',
                    'arrivee' => '16:00',
                    'diner' => '19:00'
                ],
                'notes_speciales' => 'Risque d\'embouteillage vers la sortie de Dakar'
            ],
            [
                'jour_numero' => 5,
                'date' => '2025-08-09',
                'lieu_principal' => 'Village des Tortues / Lac Rose',
                'activites' => "Départ pour le Village des Tortues\nVisite écologique du village\nRetour au Lac Rose\nVisite du lac avec balade en 4x4 sur les dunes\nDéjeuner sur place\nAprès-midi libre\nDîner et nuitée",
                'hebergement' => 'Résidence Lac Rose',
                'horaires' => [
                    'depart_tortues' => '08:30',
                    'visite_ecologique' => '09:30',
                    'retour_lac' => '11:00',
                    'balade_4x4' => '11:30',
                    'dejeuner' => '13:00',
                    'diner' => '19:00'
                ]
            ],
            [
                'jour_numero' => 6,
                'date' => '2025-08-10',
                'lieu_principal' => 'Saint-Louis',
                'activites' => "Départ pour Saint-Louis\nTraversée de la zone soudano-soudanaise\nArrivée à Saint-Louis\nDéjeuner typique sénégalais au restaurant\nInstallation en résidence\nAprès-midi libre\nDîner et nuitée",
                'hebergement' => 'Résidence Saint-Louis',
                'horaires' => [
                    'depart' => '08:00',
                    'arrivee' => '11:30',
                    'dejeuner' => '12:30',
                    'installation' => '14:00',
                    'diner' => '19:00'
                ],
                'notes_speciales' => 'La visite du port de pêche de Cayar dépend du retour des pêcheurs'
            ],
            [
                'jour_numero' => 7,
                'date' => '2025-08-11',
                'lieu_principal' => 'Saint-Louis',
                'activites' => "Balade en calèche dans la vieille ville coloniale\nContinuation vers le quartier des pêcheurs de Guet Ndar\nVisite du port de pêche\nDéjeuner à Saint-Louis\nRetour en résidence\nDîner et nuitée",
                'hebergement' => 'Résidence Saint-Louis',
                'horaires' => [
                    'balade_caleche' => '09:00',
                    'quartier_pecheurs' => '10:30',
                    'port_peche' => '11:00',
                    'dejeuner' => '13:00',
                    'retour' => '15:00',
                    'diner' => '19:00'
                ]
            ],
            [
                'jour_numero' => 8,
                'date' => '2025-08-12',
                'lieu_principal' => 'Langue de Barbarie',
                'activites' => "Route vers la Langue de Barbarie\nPassage par la réserve de Guembeul (réserve de faune)\nContinuation vers la Langue de Barbarie\nPique-nique sur place\nRetour à Saint-Louis\nAprès-midi libre\nDîner et nuitée",
                'hebergement' => 'Résidence Saint-Louis',
                'horaires' => [
                    'depart' => '08:30',
                    'reserve_guembeul' => '09:30',
                    'langue_barbarie' => '11:00',
                    'pique_nique' => '12:30',
                    'retour' => '15:00',
                    'diner' => '19:00'
                ]
            ],
            [
                'jour_numero' => 9,
                'date' => '2025-08-13',
                'lieu_principal' => 'Désert de Lompoul',
                'activites' => "Évasion au Désert de Lompoul\nInstallation dans les tentes berbères\nBalade à dos de dromadaire\nDéjeuner sur place\nSoirée africaine autour du feu\nDîner et nuitée sous tente mauritanienne",
                'hebergement' => 'Tentes berbères - Désert de Lompoul',
                'horaires' => [
                    'depart' => '08:00',
                    'arrivee_desert' => '11:00',
                    'installation' => '11:30',
                    'dejeuner' => '13:00',
                    'balade_dromadaire' => '16:00',
                    'soiree_feu' => '19:30'
                ],
                'notes_speciales' => 'Nuitée sous tente mauritanienne, expérience authentique du désert'
            ],
            [
                'jour_numero' => 10,
                'date' => '2025-08-14',
                'lieu_principal' => 'Îles du Saloum',
                'activites' => "Direction vers les îles du Saloum (patrimoine mondial de l'UNESCO)\nArrivée et installation à Ndanguane\nRencontre avec les habitants\nImmersion authentique\nDécouverte de la vie locale\nDéjeuner, dîner et nuitée",
                'hebergement' => 'Résidence à Ndanguane - Îles du Saloum',
                'horaires' => [
                    'depart' => '08:30',
                    'arrivee_saloum' => '12:00',
                    'installation' => '12:30',
                    'dejeuner' => '13:00',
                    'rencontre_habitants' => '15:00',
                    'diner' => '19:00'
                ],
                'notes_speciales' => 'Patrimoine mondial de l\'UNESCO, rencontre authentique'
            ],
            [
                'jour_numero' => 11,
                'date' => '2025-08-15',
                'lieu_principal' => 'Îles du Saloum - Bolongs',
                'activites' => "Aventures en Bolongs\nExcursion en pirogue à travers les dédales de bolongs\nSensation de jungle amazonienne\nDéjeuner pique-nique dans la mangrove\nRetour en résidence\nDîner et nuitée",
                'hebergement' => 'Résidence à Ndanguane - Îles du Saloum',
                'horaires' => [
                    'depart_pirogue' => '08:00',
                    'exploration_bolongs' => '08:30',
                    'pique_nique' => '12:30',
                    'retour' => '16:00',
                    'diner' => '19:00'
                ],
                'notes_speciales' => 'Sensation de jungle amazonienne garantie !'
            ],
            [
                'jour_numero' => 12,
                'date' => '2025-08-16',
                'lieu_principal' => 'Joal-Fadiouth / La Somone',
                'activites' => "Destination l'île aux coquillages (Joal-Fadiouth)\nVisite de l'île et de son cimetière mixte\nDéjeuner chez l'habitant\nRetour vers La Somone\nAprès-midi libre\nInstallation en résidence\nDîner et nuitée",
                'hebergement' => 'Résidence à La Somone',
                'horaires' => [
                    'depart' => '08:00',
                    'visite_ile' => '10:00',
                    'cimetiere_mixte' => '11:00',
                    'dejeuner_habitant' => '12:30',
                    'depart_somone' => '15:00',
                    'arrivee' => '16:30',
                    'diner' => '19:00'
                ]
            ],
            [
                'jour_numero' => 13,
                'date' => '2025-08-17',
                'lieu_principal' => 'Réserve de Bandia / Lagune de Somone',
                'activites' => "Safari en 4x4 dans la réserve de Bandia\nObservation de la faune africaine\nRetour vers la lagune de Somone\nDéjeuner au bord de la lagune\nVisite de la lagune\nRetour en résidence\nDîner et nuitée",
                'hebergement' => 'Résidence à La Somone',
                'horaires' => [
                    'depart_safari' => '08:00',
                    'safari_bandia' => '08:30',
                    'retour_lagune' => '11:30',
                    'dejeuner_lagune' => '12:30',
                    'visite_lagune' => '15:00',
                    'retour' => '17:00',
                    'diner' => '19:00'
                ]
            ],
            [
                'jour_numero' => 14,
                'date' => '2025-08-18',
                'lieu_principal' => 'M\'bour / La Somone',
                'activites' => "Découverte d'une messe africaine à M'bour\nPossibilité de faire du shopping\nDéjeuner dans un restaurant sénégalais\nAprès-midi libre\nRetour à La Somone\nDîner et nuitée",
                'hebergement' => 'Résidence à La Somone',
                'horaires' => [
                    'messe_africaine' => '09:00',
                    'shopping' => '10:30',
                    'dejeuner' => '12:30',
                    'retour_somone' => '16:00',
                    'diner' => '19:00'
                ]
            ],
            [
                'jour_numero' => 15,
                'date' => '2025-08-19',
                'lieu_principal' => 'M\'bour / La Somone',
                'activites' => "Visite de la pouponnière de M'bour le matin\nRetour à La Somone\nDéjeuner en résidence\nSoirée africaine typique au son des djembés\nDîner et nuitée",
                'hebergement' => 'Résidence à La Somone',
                'horaires' => [
                    'visite_pouponniere' => '09:00',
                    'retour' => '11:30',
                    'dejeuner' => '12:30',
                    'repos' => '15:00',
                    'soiree_djembe' => '18:30',
                    'diner' => '19:30'
                ],
                'notes_speciales' => 'Soirée africaine typique au son des djembés'
            ],
            [
                'jour_numero' => 16,
                'date' => '2025-08-20',
                'lieu_principal' => 'La Somone',
                'activites' => "Journée libre à la résidence de La Somone\nDétente et repos\nActivités libres\nDéjeuner, dîner et nuitée",
                'hebergement' => 'Résidence à La Somone',
                'horaires' => [
                    'petit_dejeuner' => '08:00',
                    'activites_libres' => '09:00',
                    'dejeuner' => '12:30',
                    'repos' => '15:00',
                    'diner' => '19:00'
                ],
                'notes_speciales' => 'Journée de détente complète'
            ],
            [
                'jour_numero' => 17,
                'date' => '2025-08-21',
                'lieu_principal' => 'La Somone / Aéroport Diass',
                'activites' => "Au revoir le Sénégal !\nPetit-déjeuner\nLibération des chambres\nTransfert à l'aéroport selon horaires de vol\nFin de cette belle aventure\nDes souvenirs plein le cœur",
                'hebergement' => 'Départ',
                'horaires' => [
                    'petit_dejeuner' => '07:00',
                    'liberation' => '10:00',
                    'transfert' => 'Selon horaire vol'
                ],
                'notes_speciales' => 'Fin des prestations - Transfert selon horaire de convocation'
            ]
        ];

        foreach ($programmes as $prog) {
            ProgrammeJournalier::create(array_merge($prog, ['circuit_id' => $circuit->id]));
        }
    }
}