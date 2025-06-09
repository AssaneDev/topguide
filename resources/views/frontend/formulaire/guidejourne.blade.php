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
<body class="bg-cover bg-center bg-no-repeat" style="background-image: url('/images/bg-pattern.jpg');">
  <div class="relative bg-cover bg-center min-h-[200px] flex items-center justify-center" style="background-image: url('/images/bg-guide.jpg');">
    <h1 class="text-white text-3xl md:text-4xl font-bold bg-black/50 px-4 py-2 rounded-md">🌍 Réservez votre guide au Sénégal</h1>
  </div>

  <div class="w-full bg-white shadow-md">
    <div class="h-2 bg-orange-600 transition-all duration-500" id="progress-bar"></div>
  </div>

  <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-6">
      <div class="flex-1 text-center">
        <div class="w-10 h-10 mx-auto rounded-full bg-orange-600 text-white flex items-center justify-center font-bold">1</div>
        <p class="text-sm text-gray-500 mt-1">🧍 Infos</p>
      </div>
      <div class="flex-1 text-center">
        <div class="w-10 h-10 mx-auto rounded-full bg-gray-300 text-white flex items-center justify-center font-bold">2</div>
        <p class="text-sm text-gray-500 mt-1">📋 Programme</p>
      </div>
      <div class="flex-1 text-center">
        <div class="w-10 h-10 mx-auto rounded-full bg-gray-300 text-white flex items-center justify-center font-bold">3</div>
        <p class="text-sm text-gray-500 mt-1">✅ Confirmation</p>
      </div>
    </div>

    <form id="formEtapes" action="{{ route('reservation.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Étape 1 -->
      <div class="form-step">
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
          <option value="circuit" {{ old('duree') == 'circuit' ? 'selected' : '' }}>Circuit</option>
        </select>

        <div id="joursField" class="fade-transition">
          <label class="block mb-2 font-medium">Nombre de jours</label>
          <input type="number" name="nbJours" min="2" value="{{ old('nbJours') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">
        </div>

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
        <textarea name="interets" rows="3" class="w-full border border-gray-300 p-2 rounded-md mb-4">{{ old('interets') }}</textarea>

        <label class="block mb-2 font-medium">Détails du programme</label>
        <textarea name="details" rows="4" class="w-full border border-gray-300 p-2 rounded-md mb-4">{{ old('details') }}</textarea>

        <label class="block mb-2 font-medium">Prix (€)</label>
        <input type="text" id="prix" name="prix" readonly value="{{ old('prix') }}" class="w-full border border-gray-300 p-2 rounded-md mb-4">

        <div class="flex justify-between mt-6">
          <button type="button" onclick="prevStep()" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-400">Retour</button>
          <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">Valider</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');
    const progressBar = document.getElementById('progress-bar');

    function showStep(index) {
      steps.forEach((step, i) => {
        step.classList.toggle('hidden', i !== index);
      });
      const width = ((index + 1) / steps.length) * 100;
      progressBar.style.width = width + '%';
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
      const jours = document.getElementById('joursField');
      const upload = document.getElementById('uploadField');
      const prix = document.getElementById('prix');

      if (duree === 'circuit') {
        jours.classList.add('show');
        upload.classList.add('show');
        prix.value = "50";
      } else if (duree === 'journee') {
        jours.classList.remove('show');
        upload.classList.remove('show');
        prix.value = "38";
      } else {
        jours.classList.remove('show');
        upload.classList.remove('show');
        prix.value = "";
      }
    }

    showStep(currentStep);
  </script>
</body>
</html>
