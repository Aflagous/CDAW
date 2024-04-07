@extends('layouts.master')

@section('content')
<div x-data="{ open: {{ $partie->debut == 1 ? 'true' : 'false' }}, cardSelected: []}" class="relative flex flex-col gap-5">
    <div x-data="{ piochedesti: false }">
        <form method="POST" action="{{ route('parties.drop', ['id' => $partie->id]) }}">
            @csrf
            <button type="submit">DEMO</button>
        </form>
        <section x-data="{ isHote: {{ auth()->user()->id == $jencours->joueur_id ? 'true' : 'false' }} }" class="flex flex-col gap-10 justify-center items-center">
            <div class="flex flex-row gap-5">
                @foreach($nomsDesJoueurs as $index => $joueur)
                    <div class="w-[250px] p-4 border-dark-green border rounded-xl">
                        <p>
                            Nom: {{ $joueur->name}}
                        </p>
                        <p>
                            Points: {{ $points[$index]->points }}
                        </p>
                        <p>
                            Jetons: {{ $jetons[$index]->nombre }}
                        </p>
                    </div>
                @endforeach
            </div>            
            <div class="flex flex-col gap-6 justify-center items-center w-full">
                <div>
                    <p x-show="isHote" class="bg-blue-500 text-white font-bold py-2 px-4 rounded text-center ml-10 mb-10">A votre tour</p>
                    <p x-show="!isHote" class="bg-blue-500 text-white font-bold py-2 px-4 rounded text-center ml-10 mb-10">C'est au tour d'un autre joueur</p>
                    <p x-show="isHote" class="bg-blue-500 text-white font-bold py-2 px-4 rounded text-center ml-10 " @click=" piochedesti = true ">Piocher des cartes Destinations</p>

                </div>
                <div class="flex md:flex-row flex-col gap-6 justify-center items-center border-dark-green border">
                    <div class="w-[500px] h-[500px] relative">
                        <img class="w-[500px] h-[500px]" src="{{ asset('images/A.png') }}" alt="Image de vélo">

                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes1->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 0,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[20%] left-[44%]">
                        </div>

                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes2->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 1,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[18%] left-[55%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes3->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 2,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[27%] left-[49%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes4->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 3,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[33%] left-[30%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes5->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 4,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[27%] left-[65%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes6->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 5,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[38%] left-[43%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes7->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 6,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[40%] left-[25%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes8->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 7,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[47%] left-[36%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes9->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 8,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[38%] right-[39%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes10->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 9,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[50%] left-[55%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes11->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 10,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[42%] left-[69%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes12->first()->active }} === 1 }"
                            @click="route({{ $partie->id }},11,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[57%] left-[32%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes13->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 12,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[55%] left-[40%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes14->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 13,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[56%] left-[61%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes15->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 14,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[60%] left-[69%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes16->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 15,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[66%] left-[63%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes17->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 16,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[71%] left-[35%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes18->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 17,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[70%] left-[53%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes19->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 18,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[78%] left-[43%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes20->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 19,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[83%] left-[69%]">
                        </div>
                        <div x-data="{ allume: {{ $partie->debut == 1 ? 'true' : 'false' }}}" 
                            :class="{ 'bg-yellow-400': {{ $routes21->first()->active }} === 1 }"
                            @click="route({{ $partie->id }}, 20,{{auth()->user()}})" 
                            class="h-2 w-2 bg-black absolute top-[77%] left-[80%]">
                        </div>
                    </div>
                        
                    @if(auth()->user()->id == $jencours->joueur_id) 
                    <div class="flex md:flex-col flex-row gap-2">
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 1)
                                <div x-data="{ carte: true }" @click="envoyerVelo({{ $partie->id }}, {{ $velo }}); carte = false">
                                    <img x-show="carte" class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 2)
                                <div x-data="{ carte: true }" @click="envoyerVelo({{ $partie->id }}, {{ $velo }}); carte = false">
                                    <img x-show="carte" class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 3)
                                <div x-data="{ carte: true }" @click="envoyerVelo({{ $partie->id }}, {{ $velo }}); carte = false">
                                    <img x-show="carte" class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 4)
                                <div x-data="{ carte: true }" @click="envoyerVelo({{ $partie->id }}, {{ $velo }}); carte = false">
                                    <img x-show="carte" class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 5)
                                <div x-data="{ carte: true }" @click="envoyerVelo({{ $partie->id }}, {{ $velo }}); carte = false">
                                    <img x-show="carte" class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                
                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 6)
                                <div x-data="{ carte: true }" @click="envoyerVelopot({{ $partie->id }}, {{ $velo }}); carte = false">
                                    <div x-show="carte" class="w-[75px] h-[75px] bg-gray-400 absolute top-0 left-0"></div>

                                </div>                                
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="flex md:flex-col flex-row gap-2">
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 1)
                                <div>
                                    <img class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 2)
                                <div>
                                    <img class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 3)
                                <div>
                                    <img class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 4)
                                <div>
                                    <img class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 5)
                                <div>
                                    <img class="w-[75px] h-[75px] absolute top-0 left-0" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">

                                </div>                                
                                @endif
                            @endforeach
                        </div>
                        <div class="w-[75px] h-[75px] relative cursor-pointer">
                            @foreach($velos as $velo)
                                @if($velo->banque == 6)
                                <div>
                                    <div class="w-[75px] h-[75px] bg-gray-400 absolute top-0 left-0"></div>

                                </div>                                
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="flex flex-col gap-6 w-full justify-center items-center">
                    <div class="flex flex-row gap-2">
                        @foreach($velosmain as $index => $velo)
                            @if($velo->joueur_id == auth()->user()->id)
                                <div class="flex flex-row gap-2">
                                    <img class="w-[75px] h-[75px]" src="{{ asset('images/velo/' . $velo->lien) }}" alt="Image de vélo">
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <div class="flex flex-row gap-4">
                            @foreach($cardSelected as $index => $card)
                            @if($card->joueur_id == auth()->user()->id)
                                <img class="w-[150px] h-[150px]" src="{{ asset('images/' . $card->lien) }}" alt="Image de vélo">

                            @endif
                        @endforeach
                        </div>
                        
                    </div>
                </div>
           
            </div>
        </section>
        <div x-show="!open" class="w-full h-full fixed bg-slate-500 top-0 left-0 opacity-50 z-10"></div>
        <form x-show="!open" id="formCartes" method="POST">
            @csrf
            <input type="hidden" id="gameId" value="{{ $partie->id }}">
            <div class="top-1/4 left-1/4 fixed bg-blue-100 z-20 justify-center w-1/2 h-1/2 items-center">
                <div class="w-full h-full flex justify-center items-center flex-col gap-5">
                    <div class="flex flex-row gap-5">
                        @foreach($nomsDesJoueurs as $index => $joueur)
                        @if(auth()->user()->id == $joueur->id)
                        <div class="flex flex-row gap-5">
                            @for($i = 0; $i < 3; $i++)
                                <div class="bg-red-100">
                                    <label class="relative inline-block">
                                        <input type="checkbox" name="cartes_selectionnees[]" 
                                            value="{{ $cards[$i]->id }}" 
                                            class="absolute h-0 w-0 opacity-0" 
                                            x-model="cardSelected">
                                        <div class="flex items-center justify-center rounded-md cursor-pointer" 
                                            x-bind:class="{ 'bg-red-300': cardSelected.includes('{{ $cards[$i]->id }}') }">
                                            <img class="w-[150px] h-[150px]" src="{{ asset('images/' . $cards[$i]->lien) }}" alt="Image de vélo">
                                        </div>
                                    </label>
                                </div>
                            @endfor
                        </div>
                           
                        @endif
                        @endforeach
                    </div>
               
                    <button id="envoyerCartesBtn" type="button" @click=" open = true ">Envoyer les cartes sélectionnées</button>

                </div>
                
            </div>
        </form>
            <div x-show="piochedesti" class="w-full h-full fixed bg-slate-500 top-0 left-0 opacity-50 z-10"></div>
            <form x-show="piochedesti" id="formCartes_2" method="POST">
                @csrf
                <input type="hidden" id="gameId_2" value="{{ $partie->id }}">
                <div class="top-1/4 left-1/4 fixed bg-blue-100 z-20 justify-center w-1/2 h-1/2 items-center">
                    <div class="w-full h-full flex justify-center items-center flex-col gap-5">
                        <div class="flex flex-row gap-5">
                            @foreach($nomsDesJoueurs as $index => $joueur)
                            @if(auth()->user()->id == $joueur->id)
                            <div class="flex flex-row gap-5">
                                @for($i = 0; $i < 3; $i++)
                                    <div class="bg-red-100">
                                        <label class="relative inline-block">
                                            <input type="checkbox" name="cartes_selectionnees[]" 
                                                value="{{ $cards[$i]->id }}" 
                                                class="absolute h-0 w-0 opacity-0" 
                                                x-model="cardSelected">
                                            <div class="flex items-center justify-center rounded-md cursor-pointer" 
                                                x-bind:class="{ 'bg-red-300': cardSelected.includes('{{ $cards[$i]->id }}') }">
                                                <img class="w-[150px] h-[150px]" src="{{ asset('images/' . $cards[$i]->lien) }}" alt="Image de vélo">
                                            </div>
                                        </label>
                                    </div>
                                @endfor
                            </div>
                               
                            @endif
                            @endforeach
                        </div>
                   
                        <button id="PiocherCartesDesti" type="button" @click=" piochedesti = false ">Envoyer les cartes sélectionnées</button>
    
                    </div>
                    
                </div>
            </form>
    </div>
</div>
@endsection

<script>
    function envoyerVelo(gameId, velo) {
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        fetch('/game/' + gameId + '/piochevelo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken 
            },
            body: JSON.stringify({ velo: velo }) // Vous pouvez inclure la valeur du champ velo dans le corps de la requête
        })
        .then(response => {

            // Gérez la réponse du serveur ici si nécessaire
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    }
    function envoyerVelopot(gameId, velo) {
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        fetch('/game/' + gameId + '/piochevelopot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken 
            },
            body: JSON.stringify({ velo: velo }) // Vous pouvez inclure la valeur du champ velo dans le corps de la requête
        })
        .then(response => {

            // Gérez la réponse du serveur ici si nécessaire
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    }
    function route(gameId, nombre, user) {
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        fetch('/game/' + gameId + '/route', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken 
            },
            body: JSON.stringify({ 
            nombre: nombre,
            user: user
            }) 
        })
        .then(response => {

            // Gérez la réponse du serveur ici si nécessaire
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    }

</script>
