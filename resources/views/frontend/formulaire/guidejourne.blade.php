<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réservation guide - Étapes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 750px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .stepper {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: 40px;
    }

    .stepper::before {
      content: "";
      position: absolute;
      top: 18px;
      left: 50px;
      right: 50px;
      height: 2px;
      background: #ddd;
      z-index: 0;
    }

    .step {
      position: relative;
      text-align: center;
      z-index: 1;
      flex: 1;
    }

    .step .circle {
      width: 36px;
      height: 36px;
      margin: auto;
      border-radius: 50%;
      background: #ccc;
      color: white;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      transition: background 0.3s;
    }

    .step.active .circle,
    .step.completed .circle {
      background: #cc5500;
    }

    .step.completed .circle::after {
      content: "✔";
      font-size: 16px;
    }

    .step .label {
      margin-top: 8px;
      font-size: 0.9rem;
      color: #777;
    }

    .form-step {
      display: none;
    }

    .form-step.active {
      display: block;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 5px;
      font-size: 1rem;
    }

    textarea {
      resize: vertical;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    button {
      padding: 12px 20px;
      background: #cc5500;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
    }

    button:hover {
      background: #b34700;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="stepper">
    <div class="step active">
      <div class="circle">1</div>
      <div class="label">Infos</div>
    </div>
    <div class="step">
      <div class="circle">2</div>
      <div class="label">Programme</div>
    </div>
    <div class="step">
      <div class="circle">3</div>
      <div class="label">Confirmation</div>
    </div>
  </div>

<form id="formEtapes" action="{{ route('reservation.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Étape 1 -->
    <div class="form-step active">
      <label>Nom complet</label>
      <input type="text" name="name" required value="{{ old('name') }}">

      <label>Email</label>
      <input type="email" name="email" required value="{{ old('email') }}">

      <label>Téléphone (WhatsApp)</label>
      <input type="tel" name="phone" required value="{{ old('phone') }}">

      <label>Date souhaitée</label>
      <input type="date" name="date" required value="{{ old('date') }}">

      <label>Ville de départ</label>
      <input type="text" name="ville" required value="{{ old('ville') }}">

      <div class="btn-group">
        <div></div>
        <button type="button" onclick="nextStep()">Suivant</button>
      </div>
    </div>

    <!-- Étape 2 -->
    <div class="form-step">
      <label>Durée du programme</label>
      <select id="duree" name="duree" onchange="updateEtape2()" required>
        <option value="">Sélectionner</option>
        <option value="journee" {{ old('duree') == 'journee' ? 'selected' : '' }}>Journée</option>
        <option value="circuit" {{ old('duree') == 'circuit' ? 'selected' : '' }}>Circuit</option>
      </select>

      <div id="joursField" style="display:none;">
        <label>Nombre de jours</label>
        <input type="number" name="nbJours" min="2" value="{{ old('nbJours') }}">
      </div>

      <label>Langue du guide</label>
      <select name="langue" required>
        <option value="">Sélectionner</option>
        <option value="fr" {{ old('langue') == 'fr' ? 'selected' : '' }}>Français</option>
        <option value="en" {{ old('langue') == 'en' ? 'selected' : '' }}>Anglais</option>
        <option value="it" {{ old('langue') == 'it' ? 'selected' : '' }}>Italien</option>
        <option value="es" {{ old('langue') == 'es' ? 'selected' : '' }}>Espagnol</option>
      </select>

      <div id="uploadField" style="display:none;">
        <label>Itinéraire (PDF)</label>
        <input type="file" name="itineraire" accept=".pdf">
      </div>

      <div class="btn-group">
        <button type="button" onclick="prevStep()">Retour</button>
        <button type="button" onclick="nextStep()">Suivant</button>
      </div>
    </div>

    <!-- Étape 3 -->
    <div class="form-step">
      <label>Centres d’intérêt</label>
      <textarea name="interets" rows="3">{{ old('interets') }}</textarea>

      <label>Détails du programme</label>
      <textarea name="details" rows="4">{{ old('details') }}</textarea>

      <label>Prix (€)</label>
      <input type="text" id="prix" name="prix" readonly value="{{ old('prix') }}">

      <div class="btn-group">
        <button type="button" onclick="prevStep()">Retour</button>
        <button type="submit">Valider</button>
      </div>
    </div>
</form>

@if ($errors->any())
    <div style="color: red; margin-top: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>❌ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div style="color: green; margin-top: 10px;">
        ✅ {{ session('success') }}
    </div>
@endif

<script>
  document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');
    const timeline = document.querySelectorAll('.step');

    function updateSteps() {
      steps.forEach((s, i) => {
        s.classList.toggle('active', i === currentStep);
      });

      timeline.forEach((t, i) => {
        t.classList.toggle('active', i === currentStep);
        t.classList.toggle('completed', i < currentStep);
      });
    }

    window.nextStep = function () {
      if (currentStep < steps.length - 1) {
        currentStep++;
        updateSteps();
      }
    };

    window.prevStep = function () {
      if (currentStep > 0) {
        currentStep--;
        updateSteps();
      }
    };

    window.updateEtape2 = function () {
      const duree = document.getElementById('duree').value;
      const jours = document.getElementById('joursField');
      const upload = document.getElementById('uploadField');
      const prix = document.getElementById('prix');

      if (duree === 'circuit') {
        jours.style.display = 'block';
        upload.style.display = 'block';
        prix.value = "50";
      } else if (duree === 'journee') {
        jours.style.display = 'none';
        upload.style.display = 'none';
        prix.value = "38";
      } else {
        jours.style.display = 'none';
        upload.style.display = 'none';
        prix.value = "";
      }
    };

    document.getElementById("formEtapes").addEventListener("submit", function(e) {
    // Activer tous les steps pour permettre l'envoi de tous les champs
    document.querySelectorAll(".form-step").forEach(el => el.style.display = "block");

    // Facultatif : désactive les boutons pour éviter double envoi
    this.querySelectorAll("button").forEach(btn => btn.disabled = true);
});


    updateSteps(); // Initialisation à l'étape 0
  });
</script>
