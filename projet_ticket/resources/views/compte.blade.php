@extends('layouts.master')

@section('content')
<section class="w-full flex flex-col gap-10 items-center">
    <div>
        <h1 class="text-5xl text-daark-green">
            Profile
        </h1>
    </div>
    <div class="flex flex-row gap-20 justify-center">
        <p>{{ $friends->name }}</p>
    </div>
    
    <form action="{{ route('search_profile') }}" method="GET">
        <input type="text" name="query" placeholder="Rechercher...">
        <button type="submit">Rechercher le profil</button>
    </form> 
    <a href="{{ route('compte') }}" class="btn btn-primary">Retour au compte</a>

</section>

@endsection


