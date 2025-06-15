<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Merci pour votre réservation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-br from-orange-50 to-white flex items-center justify-center min-h-screen p-6">

  <div class="bg-white shadow-xl rounded-2xl max-w-xl w-full p-8 text-center border border-orange-100 relative">
    <div class="flex items-center justify-center mb-4">
      <div class="bg-green-100 text-green-700 w-14 h-14 flex items-center justify-center rounded-full text-3xl">
        ✅
      </div>
    </div>

    <h1 class="text-2xl md:text-3xl font-bold text-orange-600 mb-2">Merci {{ $reservation->name }} !</h1>

    @if($reservation->duree === 'journee')
      <p class="text-gray-700 text-lg mt-4">
        Votre réservation pour une <strong>journée</strong> avec guide a bien été envoyée.  
        <br><br>
        ✉️ Un email de confirmation vous a été envoyé à <strong>{{ $reservation->email }}</strong>.
        <br><br>
        👉 Merci de cliquer sur le bouton **"Confirmer mon programme"** dans l’e-mail pour finaliser votre demande.
      </p>
    @elseif($reservation->duree === 'circuit')
      <p class="text-gray-700 text-lg mt-4">
        Votre demande de <strong>circuit</strong> personnalisé est bien enregistrée.  
        <br><br>
        ✉️ Un email de confirmation a été envoyé à <strong>{{ $reservation->email }}</strong>.
        <br><br>
        📅 Veuillez cliquer sur **"Prendre rendez-vous"** dans l’e-mail pour organiser une visio sur WhatsApp et construire ensemble votre programme.
      </p>
    @endif

    <div id="redirect-msg" class="text-sm text-gray-500 mt-6 opacity-0 transition-opacity duration-500">
      🔄 Redirection automatique vers le site dans quelques instants...
    </div>

    <a href="{{ url('/') }}" class="mt-8 inline-block bg-orange-600 text-white text-lg font-semibold px-6 py-3 rounded-lg hover:bg-orange-700 transition duration-300">
      Retour au site
    </a>
  </div>

  <script>
    setTimeout(() => {
      document.getElementById('redirect-msg').classList.remove('opacity-0');
    }, 55000); // Affiche le message après 55s

    setTimeout(() => {
      window.location.href = "{{ url('/') }}";
    }, 60000); // Redirige au bout de 60s
  </script>

</body>
</html>
