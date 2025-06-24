<?php

namespace App\Helpers;

class HtmlCleaner
{
    public static function sanitizeQuill($html)
{
    // Décodage des entités HTML (ex: &euro; → €)
    $decoded = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // Nettoyage des caractères invisibles ou non imprimables (souvent sources de "rectangles")
    $decoded = preg_replace('/[\x00-\x1F\x7F\xA0\xAD]+/u', '', $decoded);

    // Suppression des attributs inutiles (data-*, class, style…)
    $cleaned = preg_replace([
        '/\s?data-[^=]+="[^"]*"/i',
        '/\s?class="[^"]*"/i',
        '/\s?style="[^"]*"/i'
    ], '', $decoded);

    // Supprimer les balises <p> vides
    $cleaned = preg_replace('/<p>(\s|&nbsp;)*<\/p>/', '', $cleaned);

    // Supprimer les caractères de contrôle unicode invisibles (cas plus rare)
    $cleaned = preg_replace('/[\p{C}]+/u', '', $cleaned);

    return trim($cleaned);
}


            public static function decodeEntities($html)
        {
            return html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

}
