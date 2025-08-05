{{-- resources/views/shuttle/booking-details.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">📋 Détails de votre réservation</h1>
                <p class="text-gray-600">Référence: <span class="font-mono font-semibold">{{ $booking->booking_reference }}</span></p>
            </div>

            <!-- Status Banner -->
            <div class="mb-8">
                @if($booking->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                        <div class="text-yellow-600 text-lg font-semibold mb-2">⏳ En attente de confirmation</div>
                        <p class="text-yellow-700 text-sm">Votre réservation est en cours de traitement. Vous recevrez un email de confirmation sous peu.</p>
                    </div>
                @elseif($booking->status === 'confirmed')
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                        <div class="text-blue-600 text-lg font-semibold mb-2">✅ Confirmée - En attente de paiement</div>
                        <p class="text-blue-700 text-sm">Votre réservation est confirmée ! Procédez au paiement pour finaliser.</p>
                    </div>
                @elseif($booking->status === 'paid')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                        <div class="text-green-600 text-lg font-semibold mb-2">🎉 Payée et confirmée</div>
                        <p class="text-green-700 text-sm">Parfait ! Votre navette est réservée et payée. Soyez prêt à l'heure indiquée.</p>
                    </div>
                @endif
            </div>

            <!-- Booking Details -->
            <div class="grid lg:grid-cols-2 gap-8 mb-8">
                <!-- Informations du trajet -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="mr-2">🗺️</span> Détails du trajet
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <span class="text-green-600 text-xl">📍</span>
                            <div>
                                <p class="text-sm text-gray-600">Prise en charge</p>
                                <p class="font-medium text-gray-900">{{ $booking->pickup_location }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <span class="text-red-600 text-xl">🎯</span>
                            <div>
                                <p class="text-sm text-gray-600">Destination</p>
                                <p class="font-medium text-gray-900">{{ $booking->destination }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-600 text-xl">🗓️</span>
                            <div>
                                <p class="text-sm text-gray-600">Date et heure</p>
                                <p class="font-medium text-gray-900">{{ $booking->pickup_datetime->format('l j F Y') }}</p>
                                <p class="font-bold text-lg text-blue-600">{{ $booking->pickup_datetime->format('H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations du véhicule et prix -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="mr-2">🚗</span> Véhicule et tarif
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-gray-900">{{ $booking->vehicle->name }}</h4>
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ ucfirst($booking->vehicle->type) }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ $booking->vehicle->description }}</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <span class="mr-4">👥 {{ $booking->passenger_count }}/{{ $booking->vehicle->capacity }} passagers</span>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="flex justify-between items-center text-2xl font-bold text-green-600">
                                <span>Prix total</span>
                                <span>{{ number_format($booking->total_price, 2) }}€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact & Actions -->
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Informations de contact -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="mr-2">👤</span> Vos informations
                    </h3>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Nom</p>
                            <p class="font-medium">{{ $booking->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium">{{ $booking->customer_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Téléphone</p>
                            <p class="font-medium">{{ $booking->customer_phone }}</p>
                        </div>
                        @if($booking->special_requests)
                        <div>
                            <p class="text-sm text-gray-600">Demandes spéciales</p>
                            <p class="font-medium">{{ $booking->special_requests }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="mr-2">🛠️</span> Actions
                    </h3>
                    
                    <div class="space-y-4">
                        <a href="tel:+33123456789" 
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                            📞 Nous contacter
                        </a>
                        
                        <a href="{{ route('shuttle.index') }}" 
                           class="w-full bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                            🏠 Nouvelle réservation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection