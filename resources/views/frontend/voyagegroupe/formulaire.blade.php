<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription Circuit Sénégal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --primary: #007BFF;
      --secondary: #6c757d;
      --bg: #f0f2f5;
      --white: #ffffff;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--bg);
      margin: 0;
      padding: 0;
    }

    .wrapper {
      max-width: 960px;
      margin: 40px auto;
      display: flex;
      gap: 40px;
      background: var(--white);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .timeline {
      width: 180px;
      position: relative;
    }

    .timeline::before {
      content: "";
      position: absolute;
      top: 0;
      left: 20px;
      width: 4px;
      height: 100%;
      background: #dee2e6;
    }

    .step-icon {
      position: relative;
      display: flex;
      align-items: center;
      margin-bottom: 50px;
    }

    .step-icon .circle {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--secondary);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      position: relative;
      z-index: 2;
      transition: background 0.3s;
    }

    .step-icon.active .circle {
      background: var(--primary);
    }

    .step-icon .label {
      margin-left: 15px;
      color: #333;
      font-weight: 500;
    }

    .form-area {
      flex: 1;
    }

    .form-step {
      display: none;
    }

    .form-step.active {
      display: block;
      animation: fade 0.4s ease-in-out;
    }

    @keyframes fade {
      from {opacity: 0; transform: translateY(10px);}
      to {opacity: 1; transform: translateY(0);}
    }

    label {
      display: block;
      margin: 15px 0 5px;
      font-weight: 500;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
    }

    textarea {
      resize: vertical;
    }

    .buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 25px;
    }

    button {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      background: var(--primary);
      color: white;
      transition: background 0.3s ease;
    }

    button:disabled {
      background: #aaa;
      cursor: not-allowed;
    }

    @media (max-width: 768px) {
      .wrapper {
        flex-direction: column;
      }

      .timeline {
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding-bottom: 10px;
        overflow-x: auto;
      }

      .timeline::before {
        display: none;
      }

      .step-icon {
        flex-direction: column;
        align-items: center;
        margin: 0;
      }

      .step-icon .label {
        margin: 5px 0 0;
        font-size: 14px;
      }

      .form-area {
        padding-top: 20px;
      }
    }
  </style>
</head>
<body>

<div class="wrapper">
  <div class="timeline">
    <div class="step-icon active"><div class="circle">1</div><div class="label">Identité</div></div>
    <div class="step-icon"><div class="circle">2</div><div class="label">Santé</div></div>
    <div class="step-icon"><div class="circle">3</div><div class="label">Voyage</div></div>
    <div class="step-icon"><div class="circle">4</div><div class="label">Validation</div></div>
  </div>

  <div class="form-area">
    <form id="formSteps">

      <!-- ÉTAPE 1 -->
      <div class="form-step active">
        <label>Nom</label><input type="text" required>
        <label>Prénom</label><input type="text" required>
        <label>Email</label><input type="email" required>
        <label>Téléphone WhatsApp</label><input type="text">
        <label>Date de naissance</label><input type="date">
        <label>Pays</label><input type="text">
        <div class="buttons">
          <span></span>
          <button type="button" class="next">Suivant</button>
        </div>
      </div>

      <!-- ÉTAPE 2 -->
      <div class="form-step">
        <label>Passeport valide jusqu'à nov. 2025 ?</label>
        <input type="radio" name="passeport" value="oui"> Oui
        <input type="radio" name="passeport" value="non"> Non

        <label>Allergies / Problèmes médicaux</label>
        <textarea rows="2"></textarea>

        <label>Régime alimentaire</label>
        <textarea rows="2"></textarea>

        <label>Type de chambre</label>
        <select>
          <option value="seul">Seul(e)</option>
          <option value="partagée">Partagée</option>
          <option value="avec">Avec un proche</option>
        </select>

        <label>Nom du compagnon (si partagé)</label>
        <input type="text">

        <div class="buttons">
          <button type="button" class="prev">Retour</button>
          <button type="button" class="next">Suivant</button>
        </div>
      </div>

      <!-- ÉTAPE 3 -->
      <div class="form-step">
        <label>Besoin d’aide pour vol ?</label>
        <input type="radio" name="vol" value="oui"> Oui
        <input type="radio" name="vol" value="non"> Non

        <label>Ville de départ préférée</label>
        <input type="text">

        <label>Souhaite visiter la réserve de Bandia ?</label>
        <input type="radio" name="bandia" value="oui"> Oui
        <input type="radio" name="bandia" value="non"> Non

        <label>Autres remarques</label>
        <textarea rows="3"></textarea>

        <div class="buttons">
          <button type="button" class="prev">Retour</button>
          <button type="button" class="next">Suivant</button>
        </div>
      </div>

      <!-- ÉTAPE 4 -->
      <div class="form-step">
        <label><input type="checkbox" required> Je confirme ma participation</label>
        <label><input type="checkbox" required> J’autorise l’équipe à me contacter</label>
        <label><input type="checkbox" required> J’accepte de verser un acompte</label>
        <div class="buttons">
          <button type="button" class="prev">Retour</button>
          <button type="submit">Envoyer</button>
        </div>
      </div>

    </form>
  </div>
</div>

<script>
  const formSteps = document.querySelectorAll(".form-step");
  const nextBtns = document.querySelectorAll(".next");
  const prevBtns = document.querySelectorAll(".prev");
  const stepIcons = document.querySelectorAll(".step-icon");

  let current = 0;

  function showStep(index) {
    formSteps.forEach((step, i) => {
      step.classList.toggle("active", i === index);
      stepIcons[i].classList.toggle("active", i === index);
    });
    current = index;
  }

  nextBtns.forEach(btn => btn.addEventListener("click", () => {
    if (current < formSteps.length - 1) showStep(current + 1);
  }));

  prevBtns.forEach(btn => btn.addEventListener("click", () => {
    if (current > 0) showStep(current - 1);
  }));

  document.getElementById("formSteps").addEventListener("submit", e => {
    e.preventDefault();
    alert("🎉 Formulaire soumis avec succès !");
  });
</script>

</body>
</html>
