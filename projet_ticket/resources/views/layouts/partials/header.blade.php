<header class="w-full h-20 bg-red-300">
    <section class="w-full flex flex-row gap-8 items-center">
        <div class="h-20 max-w-20 flex justify-center items-center w-full bg-blue-600">
            <a href="{{ route('home') }}" class="flex justify-center items-center">
                <img
                loading="lazy"
                src="{{ asset('images/logo/slogan_bleu_vert.webp') }}"
                alt="Logo"
                class="w-full"
                />
            </a>
        </div>
        <div class="flex flex-row gap-4 ml-auto mr-10">
            <a href="{{ route('compte') }}" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5" id="tchat">
                        Profile
                    </p>
                </div>
            </a>
            <a href="{{ route('user.friends', ['userId' => auth()->user()->id]) }}" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5" id="tchat">
                        Amis
                    </p>
                </div>
            </a>
            <a href="{{ route('parties') }}" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5" id="tchat">
                        Jouer
                    </p>
                </div>
            </a>
            <a href="{{ route('ranking') }}" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5" id="tchat">
                        Rank
                    </p>
                </div>
            </a>
            @if($isAdmin)
                <a href="{{ route('administration') }}" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                    <div class="flex gap-4">
                        <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                        <p class="mr-5" id="tchat">
                            Administration
                        </p>
                    </div>
                </a>
            @endif
        </div>
    </section>
    
</header>





