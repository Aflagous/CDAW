@extends('layouts.master')

@section('content')
    <section class="w-full flex flex-col gap-10 items-center">
        <div>
            <h1 class="text-5xl text-daark-green">
                Amis
            </h1>
        </div>
        <div class="flex flex-row gap-20 justify-center">
            <div class="">
                @foreach($friends as $information)
                    <div class="flex flex-row gap-20 odd:bg-middle-light-green even:bg-green px-4 py-1">
                        <p class="w-[50px]">{{ $information->name}}</p>
                        <form action="{{ route('userretirer', ['Id' => $information->id, 'userId' => $userId]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="personne_id" value="{{ $information->id }}">
                            <button class="" type="submit">Retirer</button>
                        </form> 
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-row gap-5">
            <form action="{{ route('search_amis', ['userId' => auth()->user()->id]) }}" method="GET">
                @csrf
                <input type="text" name="query" placeholder="Rechercher...">
                <button type="submit">Rechercher</button>
            </form> 
            <form method="POST" action="{{ route('userajouter', ['userId' => auth()->user()->id]) }}">
                @csrf
                <label for="friend_name">Nom de l'ami :</label>
                <input type="text" id="friend_name" name="friend_name">
                <button type="submit">Ajouter en ami</button>
            </form> 
        </div>
        <a href="{{ route('user.friends', ['userId' => auth()->user()->id]) }}" class="btn btn-primary">Retour aux amis</a>
    </section>

@endsection


