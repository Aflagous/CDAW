@extends('layouts.master')

@section('content')
    <div id="app">
        <form action="{{ route('parties.delete', $partie->id) }}" method="POST">
            @csrf
            <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded w-[150px] text-center ml-10" type="submit">Quitter</button>
        </form>
        <div class="flex flex-col gap-4 w-full items-center mt-20">
            <p class="bg-blue-500 text-white font-bold py-2 px-4 rounded w-[300px] text-center">Nombre de joueurs : <span id="playerCount">{{ count($nomsDesJoueurs) }}</span></p>
            @if(auth()->user()->id === $partie->hote_id)
                <a href="{{ route('parties.lauch.event', ['id' => $partie->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-[300px] text-center">
                    Lancer la partie
                </a>
                
            @endif
        </div>    
    </div>
@endsection
