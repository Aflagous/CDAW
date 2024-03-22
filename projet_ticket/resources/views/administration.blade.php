@extends('layouts.master')

@section('content')

    <section class="w-full flex flex-col gap-10 items-center">
        <div>
            <h1 class="text-5xl text-daark-green">
                Administration
            </h1>
        </div>
        <div class="flex flex-row gap-20 justify-center">
            <div class="flex flex-col gap-6 items-center ">
                <div class="text-3xl text-daark-green">
                    Liste utilisateurs
                </div>
                <div>
                    @foreach($informations as $information)
                    <div class="flex flex-row gap-20 odd:bg-middle-light-green even:bg-green px-4 py-1">
                        <p class="w-[50px]">{{ $information->name }}</p>
                        <form action="{{ route('Modify_admin', ['id' => $information->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="personne_id" value="{{ $information->id }}">
                            <button class="" type="submit">Admin</button>
                        </form> 
                        <form action="{{ route('Modify_bloque', ['id' => $information->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="personne_id" value="{{ $information->id }}">
                            <button class="" type="submit">Bloque</button>
                        </form> 
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-6 items-center ">
                <div class="text-3xl text-daark-green">
                    Liste bloqués
                </div>
                <div>
                    @foreach($informations as $information)
                    @if($information->blocked === 1)
                        <div class="flex flex-row gap-20 odd:bg-middle-light-green even:bg-green px-4 py-1">
                            <p class="w-[50px]">{{ $information->name }}</p>
                            <form action="{{ route('Modify_admin', ['id' => $information->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="personne_id" value="{{ $information->id }}">
                                <button class="" type="submit">Admin</button>
                            </form> 
                            <form action="{{ route('Modify_bloque', ['id' => $information->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="personne_id" value="{{ $information->id }}">
                                <button class="" type="submit">Bloque</button>
                            </form> 
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-6 items-center ">
                <div class="text-3xl text-daark-green">
                    Liste Administration
                </div>
                <div>
                    @foreach($informations as $information)
                    @if($information->admin === 1)
                        <div class="flex flex-row gap-20 odd:bg-middle-light-green even:bg-green px-4 py-1">
                            <p class="w-[50px]">{{ $information->name }}</p>
                            <form action="{{ route('Modify_admin', ['id' => $information->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="personne_id" value="{{ $information->id }}">
                                <button class="" type="submit">Admin</button>
                            </form> 
                            <form action="{{ route('Modify_bloque', ['id' => $information->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="personne_id" value="{{ $information->id }}">
                                <button class="" type="submit">Bloque</button>
                            </form> 
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
    
        </div>
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="query" placeholder="Rechercher...">
            <button type="submit">Rechercher</button>
        </form>
        <a href="{{ route('administration') }}" class="btn btn-primary">Retour à l'administration</a>
    </section>
@endsection
