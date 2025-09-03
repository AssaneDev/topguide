<?php

namespace App\Helpers;

class CurrencyHelper
{
    // Taux de change FCFA vers EUR (1 EUR = 655.957 FCFA environ)
    // Vous pouvez ajuster ce taux ou le récupérer depuis une API
    const FCFA_TO_EUR_RATE = 650;
    
    /**
     * Convertir FCFA en EUR
     */
    public static function fcfaToEur($amount)
    {
        if (!$amount || $amount <= 0) {
            return 0;
        }
        
        return round($amount / self::FCFA_TO_EUR_RATE, 2);
    }
    
    /**
     * Convertir EUR en FCFA
     */
    public static function eurToFcfa($amount)
    {
        if (!$amount || $amount <= 0) {
            return 0;
        }
        
        return round($amount * self::FCFA_TO_EUR_RATE, 0);
    }
    
    /**
     * Formater le prix en EUR
     */
    public static function formatEur($amount)
    {
        $eurAmount = self::fcfaToEur($amount);
        return number_format($eurAmount, 2, ',', ' ') . ' €';
    }
    
    /**
     * Formater le prix en FCFA
     */
    public static function formatFcfa($amount)
    {
        return number_format($amount, 0, ',', ' ') . ' FCFA';
    }
    
    /**
     * Afficher les deux devises
     */
    public static function formatBothCurrencies($amount)
    {
        return [
            'eur' => self::formatEur($amount),
            'fcfa' => self::formatFcfa($amount),
            'eur_amount' => self::fcfaToEur($amount),
            'fcfa_amount' => $amount
        ];
    }
}