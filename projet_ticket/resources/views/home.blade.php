@extends('layouts.master')

@section('content')
    <div x-data="{ open: false }" class="relative w-full h-full">
        <section class="w-full flex justify-center">
            <h1 class="my-10">
                Tickets To Ride
            </h1>
        </section>
        <section class="w-full flex justify-center flex-row gap-10 mb-20">
            <div class="max-w-1/2 w-full flex flex-col gap-5 ml-10">
                <img
                loading="lazy"
                src="{{ asset('images/logo/slogan_bleu_vert.webp') }}"
                alt="Logo"
                />
                <div class="w-full flex justify-center flex-row gap-4">
                    <div class="flex gap-4">
                        <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                        <p class="mr-5" id="tchat">
                            2 - 5
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                        <p class="mr-5" id="tchat">
                            11 min
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                        <p class="mr-5" id="tchat">
                            Complexité : 2 / 5
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col max-w-1/2 w-full mr-10">
                <h2 class="mb-5">
                    À propos
                </h2>
                <p class="mb-5">
                    Les Aventuriers de l'air est un jeu de développement de réseau d'avions 
                    empli de choix cornéliens. Chaque joueur collectera des cartes avions 
                    (ou Jet pour le Joker) de couleurs variées avec lesquelles il 
                    pourra prendre possession des routes et relier ainsi diverses villes 
                    dans plusieurs pays du monde.
                </p>
                <div>
                    <button @click=" open = !open ">Résumé des règles</button>
                </div>
                
                
            </div>
        </section>
        <section class="w-full flex justify-center flex-row gap-10 mb-20">
            <div class="max-w-1/2 w-full flex justify-center items-center flex-col gap-5 ml-10">
                <h2>
                    classement
                </h2>
                <div class="w-3/4 h-[600px] bg-purple-500"></div>
            </div>
            <div class="max-w-1/2 w-full flex items-center flex-col gap-20 mr-10 mt-[44px]">
                <a href="{{ route('parties') }}" class="bg-purple-500 flex justify-center items-center py-6 px-10 h-min w-[250px]">
                    <p id="tchat">
                        Jouer une partie
                    </p>
                </a>
                <img
                loading="lazy"
                src="{{ asset('images/logo/slogan_bleu_vert.webp') }}"
                alt="Logo"
                />
            </div>
        </section>
        <div x-show="open" @click=" open = false " class="w-full h-full fixed bg-slate-500 top-0 left-0 opacity-50 z-10"></div>
        <div x-show="open" class="top-1/4 left-1/4 fixed bg-blue-700 w-1/2 h-1/2 z-20">
            <p>
                qsdfqsdfq
            </p>
            <div @click=" open = false ">
                bonjour
            </div>
        </div>
    </div>
 
@endsection


