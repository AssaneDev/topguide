<h1>{{ $voyage->destination }} ({{ $voyage->date_depart }} - {{ $voyage->date_retour }})</h1>

<h3>Voyageurs intéressés :</h3>
<ul>
    @foreach($voyage->interets as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>

<h3>Voyageurs inscrits :</h3>
<ul>
    @foreach($voyage->inscriptions as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>

<form action="{{ route('voyages.interesser', $voyage->id) }}" method="POST">
    @csrf
    <button>Je suis intéressé(e)</button>
</form>

<form action="{{ route('voyages.inscrire', $voyage->id) }}" method="POST">
    @csrf
    <button>Je m'inscris</button>
</form>
