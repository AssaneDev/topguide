<span class="detail-item">
                                                                <i class="fas fa-clock me-1"></i>{{ $activite->duree_formatee }}
                                                            </span>
                                                        @endif
                                                        @if($activite->lieu_activite)
                                                            <span class="detail-item">
                                                                <i class="fas fa-map-marker-alt me-1"></i>{{ $activite->lieu_activite }}
                                                            </span>
                                                        @endif
                                                        @if($activite->jour_recommande)
                                                            <span class="detail-item">
                                                                <i class="fas fa-calendar me-1"></i>Jour {{ $activite->jour_recommande }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <div class="activite-price">
                                                        <div class="price-eur">{{ $activite->prix_eur_formate }}</div>
                                                        <div class="price-fcfa">{{ $activite->prix_formate }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Étape 3: Informations personnelles -->
                    <div class="form-step" data-step="3">
                        <div class="step-header mb-4">
                            <h4><span class="step-number">3</span> Informations personnelles</h4>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="nom_complet" class="form-label">Nom complet *</label>
                                <input type="text" class="form-control" id="nom_complet" name="nom_complet" 
                                       value="{{ auth()->user()->name }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ auth()->user()->email }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Téléphone *</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" 
                                       value="{{ auth()->user()->phone ?? '' }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance"
                                       value="{{ auth()->user()->date_naissance ?? '' }}">
                            </div>

                            <div class="col-12">
                                <label for="adresse" class="form-label">Adresse complète *</label>
                                <textarea class="form-control" id="adresse" name="adresse" rows="3" required>{{ auth()->user()->address ?? '' }}</textarea>
                            </div>

                            <div class="col-12">
                                <label for="demandes_speciales" class="form-label">Demandes spéciales ou informations complémentaires</label>
                                <textarea class="form-control" id="demandes_speciales" name="demandes_speciales" rows="4" 
                                          placeholder="Allergies, régimes alimentaires, besoins particuliers, questions..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Étape 4: Récapitulatif et confirmation -->
                    <div class="form-step" data-step="4">
                        <div class="step-header mb-4">
                            <h4><span class="step-number">4</span> Récapitulatif et confirmation</h4>
                        </div>

                        <div class="reservation-summary">
                            <div class="summary-header">
                                <h5>Récapitulatif de votre réservation</h5>
                            </div>

                            <div class="summary-content">
                                <div class="voyage-summary mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{{ asset($voyage->image_couverture) }}" alt="{{ $voyage->nom_voyage }}" class="summary-image">
                                        </div>
                                        <div class="col-md-9">
                                            <h6>{{ $voyage->nom_voyage }}</h6>
                                            <p class="text-muted">{{ $voyage->description_courte }}</p>
                                            <div class="voyage-details">
                                                <span class="detail-badge">{{ $voyage->duree_formatee }}</span>
                                                <span class="detail-badge">{{ $voyage->region }}</span>
                                                <span class="detail-badge">{{ $voyage->difficulte_label }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="booking-details">
                                    <div class="detail-row">
                                        <span>Date de départ :</span>
                                        <span id="summary-date">-</span>
                                    </div>
                                    <div class="detail-row">
                                        <span>Nombre de participants :</span>
                                        <span id="summary-participants">-</span>
                                    </div>
                                    <div class="detail-row">
                                        <span>Option guide :</span>
                                        <span id="summary-guide">-</span>
                                    </div>
                                </div>

                                <div class="price-breakdown">
                                    <h6>Détail des prix</h6>
                                    <div class="price-item">
                                        <span>Prix de base :</span>
                                        <span id="prix-base">{{ $voyage->prix_base_eur_formate }}</span>
                                    </div>
                                    <div class="price-item guide-price" style="display: none;">
                                        <span>Supplément guide :</span>
                                        <span id="prix-guide-supplement">-</span>
                                    </div>
                                    <div class="price-item participants-multiplier" style="display: none;">
                                        <span>Participants (× <span id="nb-participants-calc">1</span>) :</span>
                                        <span id="prix-participants">-</span>
                                    </div>
                                    <div class="activites-pricing">
                                        <!-- Les activités optionnelles seront ajoutées ici dynamiquement -->
                                    </div>
                                    <div class="price-total">
                                        <span>Total :</span>
                                        <span id="prix-total">{{ $voyage->prix_base_eur_formate }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="terms-and-conditions mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="accept_terms" name="accept_terms" required>
                                <label class="form-check-label" for="accept_terms">
                                    J'accepte les <a href="#" target="_blank">conditions générales de vente</a> et la <a href="#" target="_blank">politique de confidentialité</a> *
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    Je souhaite recevoir les offres spéciales et nouveautés par email
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation des étapes -->
                    <div class="form-navigation">
                        <button type="button" class="btn btn-outline-secondary" id="prevStep" style="display: none;">
                            <i class="fas fa-arrow-left me-2"></i>Précédent
                        </button>
                        <button type="button" class="btn btn-primary" id="nextStep">
                            Suivant<i class="fas fa-arrow-right ms-2"></i>
                        </button>
                        <button type="submit" class="btn btn-success btn-lg" id="submitReservation" style="display: none;">
                            <i class="fas fa-check me-2"></i>Confirmer la réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar récapitulatif -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <!-- Récapitulatif prix -->
                <div class="price-summary-card mb-4">
                    <h5>Récapitulatif des prix</h5>
                    
                    <div class="price-line">
                        <span>Prix de base :</span>
                        <span class="price-value" id="sidebar-prix-base">{{ $voyage->prix_base_eur_formate }}</span>
                    </div>
                    
                    <div class="price-line guide-line" style="display: none;">
                        <span>Guide personnel :</span>
                        <span class="price-value" id="sidebar-prix-guide">-</span>
                    </div>
                    
                    <div class="price-line participants-line" style="display: none;">
                        <span>Participants (<span id="sidebar-nb-participants">1</span>) :</span>
                        <span class="price-value" id="sidebar-prix-participants">-</span>
                    </div>
                    
                    <div class="activites-lines">
                        <!-- Activités optionnelles ajoutées dynamiquement -->
                    </div>
                    
                    <hr>
                    
                    <div class="price-total-line">
                        <span>Total :</span>
                        <span class="price-total-value" id="sidebar-prix-total">{{ $voyage->prix_base_eur_formate }}</span>
                    </div>
                    
                    <div class="price-note">
                        <small class="text-muted">Prix par personne, toutes taxes comprises</small>
                    </div>
                </div>

                <!-- Informations voyage -->
                <div class="voyage-summary-card mb-4">
                    <h5>Informations voyage</h5>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="fas fa-calendar text-primary"></i>
                            <span>{{ $voyage->duree_formatee }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-users text-primary"></i>
                            <span>{{ $voyage->participants_min }}-{{ $voyage->participants_max }} participants</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-mountain text-primary"></i>
                            <span>Niveau {{ $voyage->difficulte_label }}</span>
                        </div>
                        @if($voyage->guide_inclus)
                        <div class="info-item">
                            <i class="fas fa-user-tie text-success"></i>
                            <span>Guide local inclus</span>
                        </div>
                        @endif
                        @if($voyage->repas_inclus)
                        <div class="info-item">
                            <i class="fas fa-utensils text-success"></i>
                            <span>Repas inclus</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Support -->
                <div class="support-card">
                    <h6><i class="fas fa-headset me-2"></i>Besoin d'aide ?</h6>
                    <p class="small text-muted">Notre équipe est là pour vous accompagner</p>
                    <div class="support-contacts">
                        <a href="tel:+221123456789" class="support-link">
                            <i class="fas fa-phone me-2"></i>+221 12 345 67 89
                        </a>
                        <a href="mailto:reservation@vacancesenegal.com" class="support-link">
                            <i class="fas fa-envelope me-2"></i>reservation@vacancesenegal.com
                        </a>
                        <a href="https://wa.me/221123456789" class="support-link">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle me-2"></i>Réservation confirmée !
                </h5>
            </div>
            <div class="modal-body text-center py-5">
                <div class="success-icon mb-4">
                    <i class="fas fa-check-circle fa-4x text-success"></i>
                </div>
                <h4 class="mb-3">Félicitations !</h4>
                <p class="mb-4">Votre réservation a été confirmée avec succès. Vous recevrez un email de confirmation dans quelques minutes.</p>
                <div class="reservation-info bg-light p-3 rounded mb-4">
                    <div class="row">
                        <div class="col-6">
                            <strong>Numéro de réservation :</strong><br>
                            <span class="text-primary" id="reservation-number">VAS-2024-001</span>
                        </div>
                        <div class="col-6">
                            <strong>Statut :</strong><br>
                            <span class="badge bg-warning">En attente de paiement</span>
                        </div>
                    </div>
                </div>
                <p class="text-muted">Nous vous contacterons sous 24h pour finaliser les détails de votre voyage.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('client.reservations') }}" class="btn btn-primary">
                    Voir mes réservations
                </a>
                <a href="{{ route('voyages.index') }}" class="btn btn-outline-secondary">
                    Découvrir d'autres voyages
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.reservation-form-container {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.form-step {
    display: none;
    animation: fadeInUp 0.5s ease;
}

.form-step.active {
    display: block;
}

.step-header {
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 1rem;
}

.step-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: #FF6B35;
    color: white;
    border-radius: 50%;
    font-weight: bold;
    margin-right: 0.5rem;
}

.guide-choices {
    display: grid;
    gap: 1rem;
}

.form-check-label {
    cursor: pointer;
    width: 100%;
}

.choice-content {
    padding: 1rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.form-check-input:checked + .form-check-label .choice-content {
    border-color: #FF6B35;
    background: rgba(255, 107, 53, 0.05);
}

.choice-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
}

.choice-price {
    font-size: 1.1rem;
    font-weight: bold;
    color: #FF6B35;
    margin-bottom: 0.25rem;
}

.choice-note {
    font-size: 0.9rem;
    color: #6c757d;
}

.activite-option {
    margin-bottom: 1rem;
}

.activite-card {
    padding: 1.5rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.activite-checkbox:checked + .form-check-label .activite-card {
    border-color: #FF6B35;
    background: rgba(255, 107, 53, 0.05);
}

.activite-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.activite-description {
    color: #6c757d;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.activite-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.detail-item {
    font-size: 0.8rem;
    color: #6c757d;
}

.activite-price {
    text-align: right;
}

.price-eur {
    font-size: 1.2rem;
    font-weight: bold;
    color: #FF6B35;
}

.price-fcfa {
    font-size: 0.9rem;
    color: #6c757d;
}

.reservation-summary {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #e9ecef;
}

.summary-image {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.detail-badge {
    background: #e9ecef;
    color: #495057;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
}

.booking-details {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.detail-row:last-child {
    border-bottom: none;
}

.price-breakdown {
    background: white;
    padding: 1rem;
    border-radius: 8px;
}

.price-item {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.price-total {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0 0 0;
    font-size: 1.2rem;
    font-weight: bold;
    color: #FF6B35;
    border-top: 2px solid #FF6B35;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid #f0f0f0;
}

.price-summary-card,
.voyage-summary-card,
.support-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.price-line {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.price-total-line {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0 0 0;
    font-size: 1.2rem;
    font-weight: bold;
    color: #FF6B35;
}

.support-link {
    display: block;
    color: #6c757d;
    text-decoration: none;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.support-link:hover {
    color: #FF6B35;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .reservation-form-container {
        padding: 1.5rem;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .activite-details {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Variables globales
let currentStep = 1;
const totalSteps = 4;
let prixBase = {{ $voyage->prix_base }};
let prixAvecGuide = {{ $voyage->prix_avec_guide ?? 0 }};
let prixTotal = prixBase;

// Navigation entre les étapes
document.getElementById('nextStep').addEventListener('click', nextStep);
document.getElementById('prevStep').addEventListener('click', prevStep);

function nextStep() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            changeStep(currentStep + 1);
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        changeStep(currentStep - 1);
    }
}

function changeStep(step) {
    // Masquer l'étape actuelle
    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
    
    // Afficher la nouvelle étape
    document.querySelector(`.form-step[data-step="${step}"]`).classList.add('active');
    
    currentStep = step;
    updateNavigation();
    updateSummary();
}

function updateNavigation() {
    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitReservation');
    
    // Bouton précédent
    prevBtn.style.display = currentStep > 1 ? 'block' : 'none';
    
    // Bouton suivant / soumettre
    if (currentStep === totalSteps) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'block';
    } else {
        nextBtn.style.display = 'block';
        submitBtn.style.display = 'none';
    }
}

function validateCurrentStep() {
    const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
    const requiredFields = currentStepElement.querySelectorAll('[required]');
    
    let isValid = true;
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// Calcul automatique des prix
document.querySelectorAll('input[name="avec_guide"]').forEach(radio => {
    radio.addEventListener('change', updatePrice);
});

document.getElementById('nombre_participants').addEventListener('change', updatePrice);

document.querySelectorAll('.activite-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updatePrice);
});

function updatePrice() {
    const avecGuide = document.querySelector('input[name="avec_guide"]:checked').value === '1';
    const nbParticipants = parseInt(document.getElementById('nombre_participants').value) || 1;
    
    // Prix de base
    let total = avecGuide ? prixAvecGuide : prixBase;
    
    // Multiplication par le nombre de participants
    total *= nbParticipants;
    
    // Activités optionnelles
    let totalActivites = 0;
    document.querySelectorAll('.activite-checkbox:checked').forEach(checkbox => {
        const prixActivite = parseFloat(checkbox.getAttribute('data-prix'));
        totalActivites += prixActivite * nbParticipants;
    });
    
    total += totalActivites;
    
    // Mise à jour de l'affichage
    prixTotal = total;
    updatePriceDisplay();
}

function updatePriceDisplay() {
    const avecGuide = document.querySelector('input[name="avec_guide"]:checked').value === '1';
    const nbParticipants = parseInt(document.getElementById('nombre_participants').value) || 1;
    
    // Convertir en EUR (approximatif)
    const eurRate = 650; // 1 EUR = 650 FCFA
    const totalEur = Math.round(prixTotal / eurRate);
    
    // Mise à jour du sidebar
    document.getElementById('sidebar-prix-total').textContent = `${totalEur}€ / ${formatPrice(prixTotal)} FCFA`;
    
    // Afficher/masquer les lignes de prix
    if (avecGuide && prixAvecGuide > 0) {
        document.querySelector('.guide-line').style.display = 'flex';
        const supplementGuide = prixAvecGuide - prixBase;
        document.getElementById('sidebar-prix-guide').textContent = `+${Math.round(supplementGuide / eurRate)}€`;
    } else {
        document.querySelector('.guide-line').style.display = 'none';
    }
    
    if (nbParticipants > 1) {
        document.querySelector('.participants-line').style.display = 'flex';
        document.getElementById('sidebar-nb-participants').textContent = nbParticipants;
    } else {
        document.querySelector('.participants-line').style.display = 'none';
    }
    
    // Activités optionnelles
    updateActivitesDisplay();
}

function updateActivitesDisplay() {
    const container = document.querySelector('.activites-lines');
    container.innerHTML = '';
    
    document.querySelectorAll('.activite-checkbox:checked').forEach(checkbox => {
        const activiteId = checkbox.value;
        const prixActivite = parseFloat(checkbox.getAttribute('data-prix'));
        const nomActivite = checkbox.closest('.activite-option').querySelector('.activite-title').textContent;
        const nbParticipants = parseInt(document.getElementById('nombre_participants').value) || 1;
        
        const eurRate = 650;
        const totalActiviteEur = Math.round((prixActivite * nbParticipants) / eurRate);
        
        const line = document.createElement('div');
        line.className = 'price-line';
        line.innerHTML = `
            <span>${nomActivite} (×${nbParticipants}) :</span>
            <span class="price-value">+${totalActiviteEur}€</span>
        `;
        container.appendChild(line);
    });
}

function updateSummary() {
    if (currentStep >= 4) {
        // Mettre à jour le récapitulatif
        const dateDepart = document.getElementById('date_depart').value;
        const nbParticipants = document.getElementById('nombre_participants').value;
        const avecGuide = document.querySelector('input[name="avec_guide"]:checked');
        
        if (dateDepart) {
            document.getElementById('summary-date').textContent = new Date(dateDepart).toLocaleDateString('fr-FR');
        }
        
        if (nbParticipants) {
            document.getElementById('summary-participants').textContent = nbParticipants + ' participant' + (nbParticipants > 1 ? 's' : '');
        }
        
        if (avecGuide) {
            document.getElementById('summary-guide').textContent = avecGuide.value === '1' ? 'Guide personnel inclus' : 'Sans guide personnel';
        }
    }
}

function formatPrice(price) {
    return new Intl.NumberFormat('fr-FR').format(price);
}

// Soumission du formulaire
document.getElementById('reservationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (validateCurrentStep()) {
        // Simulation de l'envoi
        const submitBtn = document.getElementById('submitReservation');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement en cours...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
            // Générer un numéro de réservation
            const reservationNumber = 'VAS-' + new Date().getFullYear() + '-' + Math.random().toString().substr(2, 3);
            document.getElementById('reservation-number').textContent = reservationNumber;
            
            // Afficher le modal de confirmation
            const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
            
            // Réinitialiser le bouton
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
    }
});

// Validation en temps réel
document.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
    field.addEventListener('blur', function() {
        if (!this.value.trim()) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
    
    field.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });
});

// Validation spécifique pour l'email
document.getElementById('email').addEventListener('blur', function() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(this.value)) {
        this.classList.add('is-invalid');
        this.setCustomValidity('Veuillez entrer une adresse email valide');
    } else {
        this.classList.remove('is-invalid');
        this.setCustomValidity('');
    }
});

// Validation spécifique pour le téléphone
document.getElementById('telephone').addEventListener('blur', function() {
    const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,}$/;
    if (!phoneRegex.test(this.value)) {
        this.classList.add('is-invalid');
        this.setCustomValidity('Veuillez entrer un numéro de téléphone valide');
    } else {
        this.classList.remove('is-invalid');
        this.setCustomValidity('');
    }
});

// Auto-remplissage des dates de fin
document.getElementById('date_depart').addEventListener('change', function() {
    if (this.value) {
        const dateDepart = new Date(this.value);
        const dateFin = new Date(dateDepart.getTime() + ({{ $voyage->duree_jours - 1 }} * 24 * 60 * 60 * 1000));
        
        // Afficher la date de fin quelque part si nécessaire
        const dateFinFormatted = dateFin.toLocaleDateString('fr-FR');
        
        // Mettre à jour le récapitulatif si on est à l'étape 4
        if (currentStep >= 4) {
            document.getElementById('summary-date').textContent = 
                `${this.value} au ${dateFinFormatted} (${{{ $voyage->duree_jours }}} jours)`;
        }
    }
});

// Gestion des activités optionnelles - affichage amélioré
document.querySelectorAll('.activite-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const card = this.closest('.activite-card');
        if (this.checked) {
            card.style.borderColor = '#FF6B35';
            card.style.backgroundColor = 'rgba(255, 107, 53, 0.05)';
        } else {
            card.style.borderColor = '#e9ecef';
            card.style.backgroundColor = 'white';
        }
        updatePrice();
        updateActivitiesSummary();
    });
});

function updateActivitiesSummary() {
    if (currentStep >= 4) {
        const activitiesContainer = document.querySelector('.activites-pricing');
        activitiesContainer.innerHTML = '';
        
        const selectedActivities = document.querySelectorAll('.activite-checkbox:checked');
        const nbParticipants = parseInt(document.getElementById('nombre_participants').value) || 1;
        
        selectedActivities.forEach(checkbox => {
            const activiteCard = checkbox.closest('.activite-option');
            const nomActivite = activiteCard.querySelector('.activite-title').textContent;
            const prixActivite = parseFloat(checkbox.getAttribute('data-prix'));
            const prixTotal = prixActivite * nbParticipants;
            
            const eurRate = 650;
            const prixEur = Math.round(prixTotal / eurRate);
            
            const activityLine = document.createElement('div');
            activityLine.className = 'price-item';
            activityLine.innerHTML = `
                <span>${nomActivite} (×${nbParticipants}) :</span>
                <span>+${prixEur}€ / +${formatPrice(prixTotal)} FCFA</span>
            `;
            activitiesContainer.appendChild(activityLine);
        });
    }
}

// Mise à jour du récapitulatif complet
function updateCompleteSummary() {
    if (currentStep >= 4) {
        updateSummary();
        updateActivitiesSummary();
        
        // Mise à jour des prix détaillés
        const avecGuide = document.querySelector('input[name="avec_guide"]:checked').value === '1';
        const nbParticipants = parseInt(document.getElementById('nombre_participants').value) || 1;
        const eurRate = 650;
        
        // Prix de base
        const prixBaseIndividuel = avecGuide ? prixAvecGuide : prixBase;
        const prixBaseTotal = prixBaseIndividuel * nbParticipants;
        document.getElementById('prix-base').textContent = 
            `${Math.round(prixBaseTotal / eurRate)}€ / ${formatPrice(prixBaseTotal)} FCFA`;
        
        // Affichage du multiplicateur de participants
        if (nbParticipants > 1) {
            document.querySelector('.participants-multiplier').style.display = 'flex';
            document.getElementById('nb-participants-calc').textContent = nbParticipants;
            document.getElementById('prix-participants').textContent = 
                `${Math.round(prixBaseTotal / eurRate)}€ / ${formatPrice(prixBaseTotal)} FCFA`;
        } else {
            document.querySelector('.participants-multiplier').style.display = 'none';
        }
        
        // Supplément guide
        if (avecGuide && prixAvecGuide > prixBase) {
            document.querySelector('.guide-price').style.display = 'flex';
            const supplementGuide = (prixAvecGuide - prixBase) * nbParticipants;
            document.getElementById('prix-guide-supplement').textContent = 
                `+${Math.round(supplementGuide / eurRate)}€ / +${formatPrice(supplementGuide)} FCFA`;
        } else {
            document.querySelector('.guide-price').style.display = 'none';
        }
        
        // Prix total final
        document.getElementById('prix-total').textContent = 
            `${Math.round(prixTotal / eurRate)}€ / ${formatPrice(prixTotal)} FCFA`;
    }
}

// Amélioration de la fonction updateSummary
function updateSummary() {
    if (currentStep >= 4) {
        // Date de départ
        const dateDepart = document.getElementById('date_depart').value;
        if (dateDepart) {
            const dateObj = new Date(dateDepart);
            const dateFin = new Date(dateObj.getTime() + ({{ $voyage->duree_jours - 1 }} * 24 * 60 * 60 * 1000));
            document.getElementById('summary-date').textContent = 
                `${dateObj.toLocaleDateString('fr-FR')} au ${dateFin.toLocaleDateString('fr-FR')}`;
        }
        
        // Participants
        const nbParticipants = document.getElementById('nombre_participants').value;
        if (nbParticipants) {
            document.getElementById('summary-participants').textContent = 
                nbParticipants + ' participant' + (nbParticipants > 1 ? 's' : '');
        }
        
        // Guide
        const avecGuide = document.querySelector('input[name="avec_guide"]:checked');
        if (avecGuide) {
            document.getElementById('summary-guide').textContent = 
                avecGuide.value === '1' ? 'Guide personnel inclus' : 'Sans guide personnel';
        }
        
        updateCompleteSummary();
    }
}

// Amélioration de la validation par étape
function validateCurrentStep() {
    const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
    let isValid = true;
    
    // Validation spécifique par étape
    switch(currentStep) {
        case 1:
            // Vérifier date et participants
            const dateDepart = document.getElementById('date_depart');
            const nbParticipants = document.getElementById('nombre_participants');
            
            if (!dateDepart.value) {
                dateDepart.classList.add('is-invalid');
                isValid = false;
            }
            
            if (!nbParticipants.value) {
                nbParticipants.classList.add('is-invalid');
                isValid = false;
            }
            
            // Vérifier que la date n'est pas dans le passé
            if (dateDepart.value) {
                const selectedDate = new Date(dateDepart.value);
                const minDate = new Date();
                minDate.setDate(minDate.getDate() + 7); // 7 jours minimum
                
                if (selectedDate < minDate) {
                    dateDepart.classList.add('is-invalid');
                    alert('La date de départ doit être au moins 7 jours après aujourd\'hui');
                    isValid = false;
                }
            }
            break;
            
        case 2:
            // Étape activités - optionnelle, pas de validation requise
            break;
            
        case 3:
            // Validation des champs obligatoires
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            // Validation email
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            }
            
            // Validation téléphone
            const phone = document.getElementById('telephone');
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,}$/;
            if (!phoneRegex.test(phone.value)) {
                phone.classList.add('is-invalid');
                isValid = false;
            }
            break;
            
        case 4:
            // Vérifier l'acceptance des conditions
            const acceptTerms = document.getElementById('accept_terms');
            if (!acceptTerms.checked) {
                acceptTerms.classList.add('is-invalid');
                alert('Vous devez accepter les conditions générales pour continuer');
                isValid = false;
            }
            break;
    }
    
    return isValid;
}

// Gestion de la soumission du formulaire avec données complètes
document.getElementById('reservationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!validateCurrentStep()) {
        return;
    }
    
    // Préparer les données
    const formData = new FormData(this);
    
    // Ajouter les activités sélectionnées
    const selectedActivities = [];
    document.querySelectorAll('.activite-checkbox:checked').forEach(checkbox => {
        selectedActivities.push(checkbox.value);
    });
    formData.set('activites_optionnelles', JSON.stringify(selectedActivities));
    
    // Ajouter le prix total calculé
    formData.set('prix_total', prixTotal);
    
    const submitBtn = document.getElementById('submitReservation');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement en cours...';
    submitBtn.disabled = true;
    
    // Simulation d'envoi (remplacer par un vrai appel AJAX)
    setTimeout(() => {
        // Générer un numéro de réservation unique
        const reservationNumber = 'VAS-' + new Date().getFullYear() + '-' + 
                                 String(Date.now()).slice(-6);
        document.getElementById('reservation-number').textContent = reservationNumber;
        
        // Sauvegarder en localStorage pour simulation
        const reservationData = {
            number: reservationNumber,
            voyage: '{{ $voyage->nom_voyage }}',
            date: formData.get('date_depart'),
            participants: formData.get('nombre_participants'),
            total: prixTotal,
            status: 'pending'
        };
        localStorage.setItem('lastReservation', JSON.stringify(reservationData));
        
        // Afficher le modal de confirmation
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
        
        // Réinitialiser le bouton
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        // Optionnel: envoyer les données au serveur
        /*
        fetch('/reservations', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Succès
            } else {
                // Erreur
            }
        });
        */
        
    }, 2000);
});

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    updateNavigation();
    updatePrice();
    
    // Définir la date minimum (aujourd'hui + 7 jours)
    const dateInput = document.getElementById('date_depart');
    const today = new Date();
    const minDate = new Date(today.getTime() + (7 * 24 * 60 * 60 * 1000));
    dateInput.min = minDate.toISOString().split('T')[0];
    
    // Suggestion de dates (weekends, etc.)
    const suggestionContainer = document.createElement('div');
    suggestionContainer.className = 'date-suggestions mt-2';
    suggestionContainer.innerHTML = '<small class="text-muted">Suggestions: </small>';
    
    // Prochain weekend
    const nextWeekend = new Date(today);
    nextWeekend.setDate(today.getDate() + (6 - today.getDay()) + 7); // Prochain samedi + 1 semaine
    const weekendBtn = document.createElement('button');
    weekendBtn.type = 'button';
    weekendBtn.className = 'btn btn-outline-secondary btn-sm me-2';
    weekendBtn.textContent = 'Prochain weekend';
    weekendBtn.onclick = () => {
        dateInput.value = nextWeekend.toISOString().split('T')[0];
        dateInput.dispatchEvent(new Event('change'));
    };
    
    suggestionContainer.appendChild(weekendBtn);
    dateInput.parentNode.appendChild(suggestionContainer);
    
    // Tracking de consultation
    @auth
    fetch(`/voyages/{{ $voyage->id }}/track-consultation`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({type: 'reservation'})
    }).catch(error => console.log('Tracking error:', error));
    @endauth
});

// Gestion du modal de confirmation
document.getElementById('confirmationModal').addEventListener('hidden.bs.modal', function() {
    // Optionnel: rediriger vers la page des réservations
    // window.location.href = "{{ route('client.reservations') }}";
});

// Auto-save du formulaire (optionnel)
function autoSaveForm() {
    const formData = new FormData(document.getElementById('reservationForm'));
    const dataObject = {};
    for (let [key, value] of formData.entries()) {
        dataObject[key] = value;
    }
    localStorage.setItem('reservationDraft', JSON.stringify(dataObject));
}

// Restaurer les données sauvegardées
function restoreFormData() {
    const savedData = localStorage.getItem('reservationDraft');
    if (savedData) {
        const data = JSON.parse(savedData);
        Object.keys(data).forEach(key => {
            const field = document.querySelector(`[name="${key}"]`);
            if (field) {
                field.value = data[key];
            }
        });
    }
}

// Auto-save toutes les 30 secondes
setInterval(autoSaveForm, 30000);

// Restaurer au chargement
// restoreFormData(); // Décommentez si vous voulez activer l'auto-restore
</script>
@endpush

@endsection@extends('frontend.layout.master')

@section('main')
<div class="breadcumb-wrapper" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('{{ asset($voyage->image_principale) }}');">
    <div class="container">
        <div class="breadcumb-content text-center">
            <h1 class="breadcumb-title text-white">Réservation</h1>
            <h2 class="text-white-50 mb-3">{{ $voyage->nom_voyage }}</h2>
            <p class="text-white-75">Réservez votre place pour cette aventure inoubliable</p>
            <ul class="breadcumb-menu justify-content-center">
                <li><a href="{{url('/')}}">Accueil</a></li>
                <li><a href="{{ route('voyages.index') }}">Voyages</a></li>
                <li><a href="{{ route('voyages.detail', $voyage->id) }}">{{ Str::limit($voyage->nom_voyage, 30) }}</a></li>
                <li>Réservation</li>
            </ul>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Formulaire de réservation -->
        <div class="col-lg-8">
            <div class="reservation-form-container">
                <div class="form-header mb-4">
                    <h3><i class="fas fa-calendar-check me-2 text-primary"></i>Détails de votre réservation</h3>
                    <p class="text-muted">Remplissez les informations ci-dessous pour finaliser votre réservation.</p>
                </div>

                <form id="reservationForm" class="reservation-form">
                    @csrf
                    <input type="hidden" name="voyage_id" value="{{ $voyage->id }}">

                    <!-- Étape 1: Dates et participants -->
                    <div class="form-step active" data-step="1">
                        <div class="step-header mb-4">
                            <h4><span class="step-number">1</span> Dates et participants</h4>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="date_depart" class="form-label">Date de départ souhaitée *</label>
                                <input type="date" class="form-control" id="date_depart" name="date_depart" required>
                                <div class="form-text">Le voyage dure {{ $voyage->duree_jours }} jours</div>
                            </div>

                            <div class="col-md-6">
                                <label for="nombre_participants" class="form-label">Nombre de participants *</label>
                                <select class="form-select" id="nombre_participants" name="nombre_participants" required>
                                    <option value="">Sélectionnez</option>
                                    @for($i = $voyage->participants_min; $i <= $voyage->participants_max; $i++)
                                        <option value="{{ $i }}">{{ $i }} participant{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                                <div class="form-text">Min: {{ $voyage->participants_min }}, Max: {{ $voyage->participants_max }}</div>
                            </div>

                            <div class="col-12">
                                <div class="guide-option">
                                    <label class="form-label">Options de guide</label>
                                    <div class="guide-choices">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="avec_guide" id="sans_guide" value="0" checked>
                                            <label class="form-check-label" for="sans_guide">
                                                <div class="choice-content">
                                                    <div class="choice-title">Sans guide personnel</div>
                                                    <div class="choice-price">{{ $voyage->prix_base_eur_formate }} / {{ $voyage->prix_base_formate }}</div>
                                                    @if($voyage->guide_inclus)
                                                        <div class="choice-note">Guide local inclus dans certaines activités</div>
                                                    @endif
                                                </div>
                                            </label>
                                        </div>
                                        @if($voyage->prix_avec_guide)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="avec_guide" id="avec_guide" value="1">
                                            <label class="form-check-label" for="avec_guide">
                                                <div class="choice-content">
                                                    <div class="choice-title">Avec guide personnel</div>
                                                    <div class="choice-price">{{ $voyage->prix_avec_guide_eur_formate }} / {{ $voyage->prix_avec_guide_formate }}</div>
                                                    <div class="choice-note">Guide francophone dédié tout au long du voyage</div>
                                                </div>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Étape 2: Activités optionnelles -->
                    @if($voyage->activitesOptionnelles->count() > 0)
                    <div class="form-step" data-step="2">
                        <div class="step-header mb-4">
                            <h4><span class="step-number">2</span> Activités optionnelles</h4>
                            <p class="text-muted">Personnalisez votre voyage avec ces activités supplémentaires</p>
                        </div>

                        <div class="activites-optionnelles">
                            @foreach($voyage->activitesOptionnelles as $activite)
                            <div class="activite-option">
                                <div class="form-check">
                                    <input class="form-check-input activite-checkbox" type="checkbox" 
                                           id="activite_{{ $activite->id }}" 
                                           name="activites_optionnelles[]" 
                                           value="{{ $activite->id }}"
                                           data-prix="{{ $activite->prix_activite }}">
                                    <label class="form-check-label w-100" for="activite_{{ $activite->id }}">
                                        <div class="activite-card">
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <h6 class="activite-title">{{ $activite->nom_activite }}</h6>
                                                    <p class="activite-description">{{ $activite->description_activite }}</p>
                                                    <div class="activite-details">
                                                        @if($activite->duree_heures)
                                                            <span class="detail-item">
                                                                <i class="fas fa-clock me-1"></i>{{ $activite->duree_format