<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réservation Guide - Vacance Sénégal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 750px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    h1, p {
      text-align: center;
    }

    .subtitle {
      color: #777;
      font-size: 1rem;
      margin-bottom: 30px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin: 15px 0 5px;
      font-weight: 600;
    }

    input, select, textarea {
      padding: 10px;
      font-size: 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      outline: none;
      transition: border 0.3s;
    }

    input:focus, textarea:focus, select:focus {
      border-color: #2a9d8f;
    }

    button {
      margin-top: 25px;
      padding: 12px;
      background: #2a9d8f;
      color: white;
      border: none;
      font-size: 1rem;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background: #21867a;
    }

    .success-message {
      text-align: center;
      color: green;
      margin-top: 20px;
    }

    .hidden {
      display: none;
    }
    /* Menue */
.main-header {
  background: white;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
}

.main-menu ul {
  list-style: none;
  display: flex;
  padding: 0;
  margin: 0;
  gap: 20px;
  flex-wrap: wrap;
}

.main-menu ul li {
  position: relative;
}

.main-menu ul li a {
  text-decoration: none;
  color: #333;
  font-weight: 600;
  padding: 8px 4px;
}

.has-submenu:hover .submenu {
  display: block;
}

.submenu {
  display: none;
  position: absolute;
  background: white;
  top: 100%;
  left: 0;
  min-width: 180px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  border-radius: 6px;
  z-index: 100;
}

.submenu li {
  margin: 0;
}

.submenu li a {
  padding: 10px;
  display: block;
  white-space: nowrap;
}

/* Toggle button (mobile) */
.menu-toggle {
  display: none;
  font-size: 26px;
  background: none;
  border: none;
  cursor: pointer;
}

/* Responsive */
@media (max-width: 768px) {
  .main-menu {
    display: none;
    width: 100%;
  }

  .main-menu.show {
    display: block;
    margin-top: 10px;
  }

  .main-menu ul {
    flex-direction: column;
    gap: 10px;
  }

  .menu-toggle {
    display: block;
  }
}

  </style>
</head>
<body>

<header class="main-header">
  <div class="nav-container">
    <a href="/" class="logo">
      <img src="https://via.placeholder.com/100x40?text=Logo" alt="logo" style="height: 40px;">

    </a>

    <button class="menu-toggle" id="menuToggle">☰</button>

    <nav class="main-menu" id="mainMenu">
      <ul>
        <li><a href="/">Accueil</a></li>
        <li><a href="/apropos">À propos</a></li>
        <li><a href="/circuits">Circuits</a></li>
        <li class="has-submenu">
          <a href="/excursions">Excursions</a>
          <ul class="submenu">
            <li><a href="/excursions?duree=demi-journee">Demi-journée</a></li>
            <li><a href="/excursions?duree=journee">Journée</a></li>
          </ul>
        </li>
        <li><a href="/blog">Blog</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>



<div class="container">
  <h1>Réservez votre guide à la journée</h1>
  <p class="subtitle">Partez à l’aventure en toute liberté avec un guide local expérimenté.</p>

  <form id="reservationForm">
    <label for="name">Votre nom complet</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Adresse e-mail</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Téléphone (WhatsApp de préférence)</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="date">Date souhaitée</label>
    <input type="date" id="date" name="date" required>

    <label for="ville">Ville de départ</label>
    <input type="text" id="ville" name="ville" required>

    <label for="duree">Durée du programme</label>
    <select id="duree" name="duree" required>
      <option value="">-- Sélectionnez une durée --</option>
      <option value="demi-journee">Demi-journée</option>
      <option value="journee">Journée</option>
      <option value="circuit">Plusieurs jours (circuit)</option>
    </select>

    <div id="uploadField" class="hidden">
      <label for="itineraire">Téléversez votre itinéraire (PDF)</label>
      <input type="file" id="itineraire" name="itineraire" accept=".pdf">
    </div>

    <label for="interets">Centres d’intérêt ou activités souhaitées</label>
    <textarea id="interets" name="interets" rows="3" placeholder="Exemple : marchés locaux, culture, nature..." required></textarea>

    <label for="details">Détails de votre programme</label>
    <textarea id="details" name="details" rows="5" placeholder="Décrivez votre programme, lieux souhaités, rythme, contraintes, etc."></textarea>

    <button type="submit">Réserver maintenant</button>
    <div class="success-message" id="successMessage" style="display: none;">
      Merci ! Votre demande a été envoyée avec succès.
    </div>
  </form>
</div>
<script>
  document.getElementById('menuToggle').addEventListener('click', function () {
    document.getElementById('mainMenu').classList.toggle('show');
  });
</script>


<script>
  const dureeSelect = document.getElementById('duree');
  const uploadField = document.getElementById('uploadField');

  dureeSelect.addEventListener('change', function () {
    if (this.value === 'circuit') {
      uploadField.classList.remove('hidden');
    } else {
      uploadField.classList.add('hidden');
    }
  });

  document.getElementById('reservationForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const successMessage = document.getElementById('successMessage');
    successMessage.style.display = 'block';
    this.reset();
    uploadField.classList.add('hidden');

    setTimeout(() => {
      successMessage.style.display = 'none';
    }, 5000);
  });
</script>

</body>
</html>
