@extends('layouts.master')

@section('content')
   <section class="w-full flex flex-col gap-10 justify-center items-center">
      <div>
         <h1 class="text-5xl text-daark-green">
             Parties
         </h1>
      </div>
      @if($groupe === true)
      <div class="flex flex-row gap-10">
         <p>
            Vous avez une partie en cours
         </p>    
         <a href="{{ route('parties.attente', ['id' => $encours->partie_id]) }}" class="bg-light-green border-dark-green flex ml-auto">
            <div class="flex gap-4">
                <p class="mr-5 text-dark-green font-bold" id="tchat">
                    Rejoindre
                </p>
            </div>
         </a>
      </div>
      @endif
      <div class="flex flex-col gap-10 justify-center items-center">
         <div>
            <h2 class="text-2xl text-daark-green">
                Parties privées
            </h2>
        </div>
        <div>
            @foreach($gamesprivees as $game)
               <div x-data="{ mdp: false }" class="flex flex-row odd:bg-middle-light-green even:bg-green px-4 py-1 w-[500px]">
                  <p class="grow">{{ $game->name }}</p>
                  @if($game->mdp === 'null')
                     <p class="grow">Mot de passe: Non</p>
                     <a href="{{ route('joingame.publique', ['partieID' => $game->id]) }}" class="bg-light-green border-dark-green flex ml-auto">
                        <div class="flex gap-4">
                            <p class="mr-5 text-dark-green font-bold" id="tchat">
                                Rejoindre
                            </p>
                        </div>
                     </a>
                  @else
                  <div x-show="!mdp" class="flex flex-row gap-5">
                     <p class="">Mot de passe: Oui</p>
                        <p @click="mdp = true" >
                           dqdfsqdsf
                        </p>
                     </div>
                     <div x-show="mdp">
                        <form method="POST" action="{{ route('joingame.private', ['partieID' => $game->id, 'userId' => auth()->user()->id]) }}">
                           @csrf
                           <label for="mdp">Mot de passe :</label>
                           <input type="text" id="mdp" name="mdp">
                           <button type="submit">Rejoindre</button>
                       </form> 
                     </div>
                  @endif
               </div>
            @endforeach
        </div>
      </div>
      <div class="flex flex-col gap-10 justify-center items-center">
         <div>
            <h2 class="text-2xl text-daark-green">
                Parties publiques
            </h2>
        </div>
        <div>
            @foreach($gamespubliques as $game)
               <div x-data="{ mdp: false }" class="flex flex-row gap-20 odd:bg-middle-light-green even:bg-green px-4 py-1 w-[500px]">
                  <p class="grow">{{ $game->name }}</p>
                  @if($game->mdp === 'null')
                     <p class="">Mot de passe: Non</p>
                     <a href="{{ route('joingame.publique', ['partieID' => $game->id]) }}" onclick="handleJoinClick({{ $game->id }}" class="bg-light-green border-dark-green flex ml-auto" >
                        <div class="flex gap-4">
                            <p class="mr-5 text-dark-green font-bold" id="tchat">
                                Rejoindre
                            </p>
                        </div>
                     </a>
                  @else
                     <div x-show="!mdp" class="flex flex-row gap-5">
                        <p class="">Mot de passe: Oui</p>
                        <p @click="mdp = true" >
                           Taper le mot de passe
                        </p>
                     </div>
                     <div x-show="mdp">
                        <form id="publiqueJoinForm" method="POST" action="{{ route('joingame.private', ['partieID' => $game->id, 'userId' => auth()->user()->id]) }}">
                           @csrf
                           <input type="hidden" name="gameId" value="{{ $game->id }}">
                           <label for="mdp">Mot de passe :</label>
                           <input type="text" id="mdp" name="mdp">
                           <button type="submit">Rejoindre</button>
                       </form> 
                     </div>
                  @endif
               </div>
            @endforeach
        </div>
      </div>
      <div>
         <a href="{{ route('parties.create') }}" class="bg-light-green border-dark-green flex ml-auto">
            <div class="flex gap-4">
                <p class="mr-5 text-dark-green font-bold" id="tchat">
                    Créer une partie
                </p>
            </div>
        </a>
      </div>
   </section>
@endsection

