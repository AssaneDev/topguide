<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Confirmation de votre programme – Vacance Sénégal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center px-4 py-8">

  <div class="bg-white shadow-xl rounded-xl p-8 max-w-2xl w-full text-gray-800">
    <div class="flex items-center mb-6">
      <i class="bi bi-check-circle-fill text-green-600 text-3xl mr-3"></i>
      <h1 class="text-2xl font-bold">Votre programme est confirmé !</h1>
    </div>

    <p class="mb-4 text-lg">
      Merci <span class="font-semibold text-orange-600">{{ $reservation->name }}</span> pour votre réservation avec <strong>Vacance Sénégal</strong>.
    </p>

    <div class="bg-gray-100 rounded-lg p-4 mb-6">
      <h2 class="text-lg font-semibold mb-2"><i class="bi bi-person-circle mr-2"></i>Vos Informations :</h2>
      <ul class="space-y-1 text-sm">
        <li><strong>Email :</strong> {{ $reservation->email }}</li>
        <li><strong>Téléphone :</strong> {{ $reservation->phone }}</li>
        <li><strong>Ville de départ :</strong> {{ $reservation->ville }}</li>
        <li><strong>Date souhaitée :</strong> {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</li>
      </ul>
    </div>

    <div class="bg-gray-100 rounded-lg p-4 mb-6">
      <h2 class="text-lg font-semibold mb-2"><i class="bi bi-map mr-2"></i>Programme sélectionné :</h2>
      <ul class="space-y-1 text-sm">
        <li><strong>Durée :</strong> {{ ucfirst($reservation->duree) }}</li>
        @if($reservation->duree === 'circuit')
          <li><strong>Nombre de jours :</strong> {{ $reservation->nbJours }}</li>
        @endif
        <li><strong>Langue du guide :</strong> {{ strtoupper($reservation->langue) }}</li>
        @if($reservation->interets)
          <li><strong>Centres d’intérêt :</strong> {{ $reservation->interets }}</li>
        @endif
      </ul>
    </div>

    <div class="text-center">
      <p class="text-sm text-gray-600 mb-2">Notre équipe va vous contacter pour finaliser les détails.</p>
      <a href="{{ url('/') }}" class="inline-block mt-3 bg-orange-600 text-white px-6 py-2 rounded-md hover:bg-orange-700 transition">
        Retour à l’accueil
      </a>
    </div>
  </div>

</body>
</html>
