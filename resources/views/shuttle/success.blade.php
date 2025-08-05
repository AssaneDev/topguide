{{-- resources/views/shuttle/success.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex items-center justify-center py-12">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <!-- Animation de succès -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-2">🎉 Réservation Enregistrée !</h1>
            <p class="text-gray-600 mb-6">Votre demande de navette a été soumise avec succès</p>

            @if(session('booking_reference'))
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-center space-x-2 mb-2">
                    <span class="text-blue-600 font-semibold">Référence :</span>
                    <span class="font-mono text-lg font-bold">{{ session('booking_reference') }}</span>
                </div>
                <p class="text-sm text-blue-700">Conservez cette référence précieusement</p>
            </div>
            @endif

            <!-- Prochaines étapes -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6 text-left">
                <h3 class="font-semibold text-yellow-900 mb-2">📋 Prochaines étapes</h3>
                <ul class="text-sm text-yellow-800 space-y-1">
                    <li>✅ Nous avons reçu votre demande</li>
                    <li>⏳ Confirmation sous 1-2 heures</li>
                    <li>📧 Email avec lien de paiement</li>
                    <li>🚐 Navette confirmée après paiement</li>
                </ul>
            </div>

            <!-- Boutons d'action -->
            <div class="space-y-3">
                @if(session('booking_reference'))
                <a href="{{ route('shuttle.booking-details', session('booking_reference')) }}" 
                   class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors block">
                    📄 Voir ma réservation
                </a>
                @endif
                <a href="{{ route('shuttle.index') }}" 
                   class="w-full bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors block">
                    🏠 Nouvelle réservation
                </a>
            </div>

            <!-- Contact -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500">
                    Questions ? Contactez-nous au<br>
                    <strong>+33 X XX XX XX XX</strong> ou <strong>contact@votre-site.com</strong>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection