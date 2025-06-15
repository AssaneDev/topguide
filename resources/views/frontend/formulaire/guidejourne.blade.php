<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réservation guide - Étapes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .fade-transition {
      transition: all 0.3s ease-in-out;
      opacity: 0;
      max-height: 0;
      overflow: hidden;
    }
    .fade-transition.show {
      opacity: 1;
      max-height: 200px;
    }
  </style>
</head>
<body class="min-h-screen bg-cover bg-center bg-no-repeat flex flex-col" style="background-image: url('{{ asset('assets/img/bg.JPG') }}');">


  <div class="relative bg-cover bg-center min-h-[200px] flex items-center justify-center" style="background-image: url('/images/bg-guide.jpg');">
    <h1 class="text-white text-3xl md:text-4xl font-bold bg-black/50 px-4 py-2 rounded-md">🌍 Réservez votre guide au Sénégal</h1>
  </div>

  <div class="w-full bg-white shadow-md">
    <div class="h-2 bg-orange-600 transition-all duration-500" id="progress-bar"></div>
  </div>

  <!-- Timeline centré -->
  <div class="flex justify-center mt-6">
    <div class="flex justify-between items-center w-full max-w-3xl px-4">
      <div class="flex-1 text-center timeline-step">
        <div class="w-10 h-10 mx-auto rounded-full step-circle bg-orange-600 text-white flex items-center justify-center font-bold transition-all duration-300">1</div>
        <p class="text-sm text-gray-500 mt-1">🧍 Infos</p>
      </div>
      <div class="flex-1 text-center timeline-step">
        <div class="w-10 h-10 mx-auto rounded-full step-circle bg-gray-300 text-white flex items-center justify-center font-bold transition-all duration-300">2</div>
        <p class="text-sm text-gray-500 mt-1">📋 Programme</p>
      </div>
      <div class="flex-1 text-center timeline-step">
        <div class="w-10 h-10 mx-auto rounded-full step-circle bg-gray-300 text-white flex items-center justify-center font-bold transition-all duration-300">3</div>
        <p class="text-sm text-gray-500 mt-1">✅ Confirmation</p>
      </div>
    </div>
  </div>

  <!-- Formulaire centré -->
<!-- Formulaire centré avec fond blanc et transparence -->
<div class="flex justify-center items-center flex-grow px-4 py-10">
  <div class="w-full max-w-3xl bg-white/90 backdrop-blur-md p-6 rounded-xl shadow-2xl">

      <form id="formEtapes" action="{{ route('reservation.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Étape 1 -->
        <div class="form-step transition-opacity duration-300 ease-in-out">
          <h2 class="text-xl font-semibold text-orange-600 mb-4">Étape 1 – 👤 Vos informations</h2>

          <label class="block mb-2 font-medium">Nom complet</label>
          <input type="text" name="name" required value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">

          <label class="block mb-2 font-medium">Email</label>
          <input type="email" name="email" required value="{{ old('email') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">

          <label class="block mb-2 font-medium">Téléphone (WhatsApp)</label>
          <input type="tel" name="phone" required value="{{ old('phone') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">

          <label class="block mb-2 font-medium">Date souhaitée</label>
          <input type="date" name="date" required value="{{ old('date') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">

          <label class="block mb-2 font-medium">Ville de départ</label>
          <input type="text" name="ville" required value="{{ old('ville') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">

          <div class="flex justify-end mt-6">
            <button type="button" onclick="nextStep()" class="bg-orange-600 text-white px-6 py-2 rounded-md hover:bg-orange-700">Suivant</button>
          </div>
        </div>

        <!-- Étape 2 -->
        <div class="form-step hidden">
          <h2 class="text-xl font-semibold text-orange-600 mb-4">Étape 2 – 🧭 Programme du guide</h2>

           <label class="block mb-2 font-medium">Durée du programme</label>
          <select id="duree" name="duree" onchange="updateEtape2()" required class="w-full border border-gray-300 p-2 rounded-md mb-4">
            <option value="">Sélectionner</option>
            <option value="journee" {{ old('duree') == 'journee' ? 'selected' : '' }}>Journée</option>
            <option value="circuit" {{ old('duree') == 'circuit' ? 'selected' : '' }}>(plusieurs jours)Circuit</option>
          </select>

           <label class="block mb-2 font-medium">Nombre de personnes</label>
           <input id="nb_personnes" type="number" name="nb_personnes" min="1" value="{{ old('nb_personnes') }}" required class="w-full border border-gray-300 p-2 rounded-md mb-4">
            <p id="message_tarif_groupe" class="text-sm text-green-600 font-medium mb-4 hidden">
                🎉 Tarif de groupe appliqué : 8 € par personne
            </p>
               <div id="joursField" class="fade-transition">
            <label class="block mb-2 font-medium">Nombre de jours</label>
            <input id="nbJours" type="number" name="nbJours" min="2" value="{{ old('nbJours') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">
          </div>
             <label class="block mb-2 font-medium">Prix total (€)</label>
             <input type="text" id="prix" name="prix" readonly value="{{ old('prix') }}" class="w-full bg-gray-100 text-gray-600 p-2 rounded-md mb-4 cursor-not-allowed border border-dashed border-gray-300">


         

       

          <label class="block mb-2 font-medium">Langue du guide</label>
          <select name="langue" required class="w-full border border-gray-300 p-2 rounded-md mb-4">
            <option value="">Sélectionner</option>
            <option value="fr" {{ old('langue') == 'fr' ? 'selected' : '' }}>Français</option>
            <option value="en" {{ old('langue') == 'en' ? 'selected' : '' }}>Anglais</option>
            <option value="it" {{ old('langue') == 'it' ? 'selected' : '' }}>Italien</option>
            <option value="es" {{ old('langue') == 'es' ? 'selected' : '' }}>Espagnol</option>
          </select>

          <div id="uploadField" class="fade-transition">
            <label class="block mb-2 font-medium">Itinéraire (PDF)</label>
            <input type="file" name="itineraire" accept=".pdf" class="w-full border border-gray-300 p-2 rounded-md mb-4">
          </div>

          <div class="flex justify-between mt-6">
            <button type="button" onclick="prevStep()" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-400">Retour</button>
            <button type="button" onclick="nextStep()" class="bg-orange-600 text-white px-6 py-2 rounded-md hover:bg-orange-700">Suivant</button>
          </div>
        </div>

       <!-- Étape 3 -->
      <div class="form-step hidden">
        <h2 class="text-xl font-semibold text-orange-600 mb-4">Étape 3 – ✉️ Détails et confirmation</h2>

        <label class="block mb-2 font-medium">Centres d’intérêt</label>
        <textarea name="interets" rows="3" placeholder="Ex : Histoire, nature, culture, cuisine locale..." class="w-full border border-gray-300 p-2 rounded-md mb-4">{{ old('interets') }}</textarea>

        <label class="block mb-2 font-medium">Détails du programme</label>
        <textarea name="details" rows="4" placeholder="Parlez-nous de vos envies, de votre itinéraire ou de vos besoins particuliers." class="w-full border border-gray-300 p-2 rounded-md mb-4">{{ old('details') }}</textarea>

        <input type="hidden" id="prix_final" name="prix_final" value="">

        <div class="flex justify-between mt-6">
          <button type="button" onclick="prevStep()" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-400">Retour</button>
          <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">Valider</button>
        </div>
      </div>

      </form>
      @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </div>
  </div>

<script>
let currentStep = 0;
const steps = document.querySelectorAll('.form-step');
const progressBar = document.getElementById('progress-bar');
const timelineSteps = document.querySelectorAll('.timeline-step');

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle('hidden', i !== index);
  });

  const width = ((index + 1) / steps.length) * 100;
  progressBar.style.width = width + '%';

  timelineSteps.forEach((el, i) => {
    const circle = el.querySelector('.step-circle');
    if (i === index) {
      circle.classList.remove('bg-gray-300');
      circle.classList.add('bg-orange-600');
    } else {
      circle.classList.add('bg-gray-300');
      circle.classList.remove('bg-orange-600');
    }
  });
}

function nextStep() {
  if (currentStep < steps.length - 1) {
    currentStep++;
    showStep(currentStep);
  }
}

function prevStep() {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
}

function updateEtape2() {
  const duree = document.getElementById('duree').value;
  const nbPersonnes = parseInt(document.getElementById('nb_personnes')?.value || 1);
  const nbJours = parseInt(document.getElementById('nbJours')?.value || 1);
  const jours = document.getElementById('joursField');
  const upload = document.getElementById('uploadField');
  const prix = document.getElementById('prix');
  const prixFinalInput = document.getElementById('prix_final');
  const message = document.getElementById('message_tarif_groupe');

  let basePrice = 0;
  let prixTotal = 0;

  if (duree === 'circuit') {
    jours.classList.add('show');
    upload.classList.add('show');
    basePrice = 50;

    if (nbPersonnes > 10) {
      prixTotal = nbPersonnes * 8 * nbJours;
      message.classList.remove('hidden');
    } else {
      prixTotal = basePrice * nbJours;
      message.classList.add('hidden');
    }
  } else if (duree === 'journee') {
    jours.classList.remove('show');
    upload.classList.remove('show');
    basePrice = 38;

    if (nbPersonnes > 10) {
      prixTotal = nbPersonnes * 8;
      message.classList.remove('hidden');
    } else {
      prixTotal = basePrice;
      message.classList.add('hidden');
    }
  } else {
    prix.value = '';
    prixFinalInput.value = '';
    message.classList.add('hidden');
    return;
  }

  prix.value = `${prixTotal} €`;
  prixFinalInput.value = prixTotal;
}

// ✅ Une seule version de DOMContentLoaded, bien fermée
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('nb_personnes')?.addEventListener('input', updateEtape2);
  document.getElementById('nbJours')?.addEventListener('input', updateEtape2);
  document.getElementById('duree')?.addEventListener('change', updateEtape2);
  updateEtape2(); // Lancer une première fois au chargement si valeurs déjà remplies
});

showStep(currentStep);
</script>

</body>
</html>
