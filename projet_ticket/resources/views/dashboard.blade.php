@extends('layouts.master')

@section('content')
    <div x-data="{ open: false }" class="relative w-full h-full">
        <section class="w-full flex justify-center">
            <h1 class="my-10 text-5xl">
                Tickets To Ride
            </h1>
        </section>
        <section class="w-full flex justify-center flex-row gap-10 mb-20">
            <div class="max-w-1/2 w-full flex flex-col gap-5 ml-10">
                <div class="w-full flex justify-center flex-row gap-4">
                    <div class="flex gap-4">
                        <p class="mr-5 text-2xl" id="tchat">
                            2 - 5
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <p class="mr-5 text-2xl" id="tchat">
                            11 min
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <p class="mr-5 text-2xl" id="tchat">
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
                    Les Aventuriers du vélo est un jeu de développement de réseau de vélos 
                    empli de choix cornéliens. Chaque joueur collectera des cartes vélos 
                    de couleurs variées avec lesquelles il 
                    pourra prendre possession des routes et relier ainsi diverses villes 
                    dans plusieurs pays du monde.
                </p>
                <div>
                    <button @click=" open = !open " class="border-dark-green border p-2">Résumé des règles</button>
                </div>
                
                
            </div>
        </section>
        <section class="w-full flex justify-center flex-row gap-10 mb-20">
            <div class="max-w-1/2 w-full flex items-center flex-col gap-20 mr-10 mt-[44px]">
        
                <a href="{{ route('parties') }}" class="bg-light-green border-dark-green flex border py-2 px-3 justify-center">
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-center">
                        <p class=" text-dark-green text-center" id="tchat">
                            Jouer une partie
                        </p>
                    </div>
                </a>
            </div>
        </section>
        <div x-show="open" @click=" open = false " class="w-full h-full fixed bg-slate-500 top-0 left-0 opacity-50 z-10"></div>
        <div x-show="open" class="top-1/4 left-1/4 fixed bg-light-green w-1/2 h-1/2 z-20">
            <p>
                <p>
                    Nombre de joueurs : 2 à 5
                </p>
                <p>
                    Âge : Dès 9 ans
                </p>
                <p>
                    Durée : 30 min
                </p>
                <p>
                    Le but du jeu est de placer sur la carte du pays visible des wagons de sa couleur pour relier des villes en fonction de ses cartes Destination.
                    Conditions de Fin de Partie
                    Lorsque la réserve de wagons d’un joueur est de 0, 1 ou 2 wagons après avoir joué son tour, chaque joueur, en incluant celui-ci, joue encore un tour à l’issue duquel on compte les points.    
                </p>
                <p>
                    Conditions de Victoire
                </p>
                En fin de partie, le joueur ayant le plus de points l'emporte. Les points se gagnent:
                <p>
                    ► 1. Immédiatement, en capturant une route entre 2 villes en fonction de sa longueur
                </p>
                <p>
                    ► 2. En fin de Partie, en ayant relié par un ensemble de routes les 2 villes d’une carte Destination d'après les points indiqués sur cette carte
                </p>
                <p>
                    ► 3. En fin de Partie, en ayant réalisé le chemin le plus long pour 10 points
                    Les points d'une carte Destination sont comptés en négatif pour son propriétaire s'il n'a pas réussi à relier les 2 villes avec ses propres wagons.    
                </p>
             
            </p>
            <div @click=" open = false ">
                quitter
            </div>
        </div>
    </div>
 
@endsection


