{{-- resources/views/shuttle/index.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                🚐 Navette Aéroport Premium
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                Réservez votre transport vers l'aéroport en quelques clics. 
                Confort, ponctualité et sérénité garantis.
            </p>
        </div>
    </div>

    <!-- Messages d'erreur/succès -->
    @if(session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <strong>Erreur :</strong> {{ session('error') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <strong>Erreurs :</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Formulaire de réservation -->
    <div class="container mx-auto px-4 -mt-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-4xl mx-auto">
            <form method="POST" action="{{ route('shuttle.book') }}">
                @csrf
                
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                    📋 Réserver votre navette
                </h3>
                
                <!-- Détails du voyage -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            📍 Lieu de prise en charge *
                        </label>
                        <input type="text" 
                               name="pickup_location" 
                               value="{{ old('pickup_location') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pickup_location') border-red-500 @enderror"
                               placeholder="Adresse complète..." 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            🎯 Destination *
                        </label>
                        <input type="text" 
                               name="destination" 
                               value="{{ old('destination') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('destination') border-red-500 @enderror"
                               placeholder="Aéroport ou adresse..." 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            📅 Date et heure *
                        </label>
                        <input type="datetime-local" 
                               name="pickup_datetime" 
                               value="{{ old('pickup_datetime') }}"
                               min="{{ now()->addHours(2)->format('Y-m-d\TH:i') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pickup_datetime') border-red-500 @enderror"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            👥 Nombre de passagers *
                        </label>
                        <select name="passenger_count" 
                                id="passengerCount"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('passenger_count') border-red-500 @enderror">
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('passenger_count', 1) == $i ? 'selected' : '' }}>
                                    {{ $i }} passager{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Sélection du véhicule -->
                <div class="mb-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">🚗 Choisissez votre véhicule</h4>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4" id="vehicleGrid">
                        @foreach($vehicles as $vehicle)
                        <div class="vehicle-card border-2 border-gray-200 rounded-xl p-4 cursor-pointer hover:border-blue-500 transition-colors @if(old('vehicle_id') == $vehicle->id) border-blue-500 bg-blue-50 @endif"
                             data-vehicle-id="{{ $vehicle->id }}" 
                             data-capacity="{{ $vehicle->capacity }}">
                            
                            <div class="text-center">
                                <!-- Emoji du véhicule -->
                                <div class="text-4xl mb-2">{{ $vehicle->type_emoji }}</div>
                                
                                <h5 class="font-bold text-lg text-gray-800 mb-1">{{ $vehicle->name }}</h5>
                                <p class="text-sm text-gray-600 mb-2">{{ $vehicle->description }}</p>
                                <p class="text-blue-600 font-semibold mb-2">👥 {{ $vehicle->capacity }} passagers max</p>
                                <p class="text-green-600 font-bold text-lg">
                                    À partir de {{ number_format($vehicle->base_price, 0) }}€
                                </p>
                                
                                <!-- Indicateur de sélection -->
                                <div class="selection-indicator mt-2 hidden">
                                    <div class="inline-flex items-center bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                                        ✅ Sélectionné
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <input type="hidden" name="vehicle_id" id="selectedVehicle" value="{{ old('vehicle_id') }}">
                    @error('vehicle_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Informations personnelles -->
                <div class="mb-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">👤 Vos informations</h4>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nom complet *
                            </label>
                            <input type="text" 
                                   name="customer_name" 
                                   value="{{ old('customer_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_name') border-red-500 @enderror"
                                   required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email *
                            </label>
                            <input type="email" 
                                   name="customer_email" 
                                   value="{{ old('customer_email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_email') border-red-500 @enderror"
                                   required>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Téléphone *
                            </label>
                            <input type="tel" 
                                   name="customer_phone" 
                                   value="{{ old('customer_phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_phone') border-red-500 @enderror"
                                   required>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                💬 Demandes spéciales (optionnel)
                            </label>
                            <textarea name="special_requests" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Siège enfant, assistance particulière...">{{ old('special_requests') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="text-center">
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-bold text-lg transition-colors transform hover:scale-105">
                        🎯 Confirmer ma réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const vehicleCards = document.querySelectorAll('.vehicle-card');
    const selectedVehicleInput = document.getElementById('selectedVehicle');
    const passengerCountSelect = document.getElementById('passengerCount');
    
    // Fonction pour filtrer les véhicules selon le nombre de passagers
    function filterVehiclesByCapacity() {
        const passengerCount = parseInt(passengerCountSelect.value);
        
        vehicleCards.forEach(card => {
            const capacity = parseInt(card.dataset.capacity);
            if (capacity >= passengerCount) {
                card.style.display = 'block';
                card.style.opacity = '1';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    // Fonction pour sélectionner un véhicule  
    function selectVehicle(card) {
        // Retirer la sélection des autres cartes
        vehicleCards.forEach(c => {
            c.classList.remove('border-blue-500', 'bg-blue-50');
            c.querySelector('.selection-indicator').classList.add('hidden');
        });
        
        // Sélectionner la carte cliquée
        card.classList.add('border-blue-500', 'bg-blue-50');
        card.querySelector('.selection-indicator').classList.remove('hidden');
        
        // Mettre à jour l'input caché
        selectedVehicleInput.value = card.dataset.vehicleId;
    }
    
    // Event listeners
    passengerCountSelect.addEventListener('change', filterVehiclesByCapacity);
    
    vehicleCards.forEach(card => {
        card.addEventListener('click', function() {
            selectVehicle(this);
        });
    });
    
    // Initialiser les filtres et sélection
    filterVehiclesByCapacity();
    
    // Restaurer la sélection si old input existe
    if (selectedVehicleInput.value) {
        const selectedCard = document.querySelector(`[data-vehicle-id="${selectedVehicleInput.value}"]`);
        if (selectedCard) {
            selectVehicle(selectedCard);
        }
    }
});
</script>
@endsection