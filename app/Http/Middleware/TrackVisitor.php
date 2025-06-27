<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;
use App\Models\Visiteur;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $ip = $request->header('X-Forwarded-For') ?? $request->ip();
            $position = Location::get($ip);

            Visiteur::create([
                'ip' => $ip,
                'pays' => $position?->countryName ?? 'Inconnu',
                'ville' => $position?->cityName ?? 'Inconnue',
                'page' => $request->path(),
                'visite_le' => now(),
            ]);
        } catch (\Throwable $e) {
            // Silence les erreurs pour ne pas impacter les utilisateurs
        }

        return $next($request);
    }
}
