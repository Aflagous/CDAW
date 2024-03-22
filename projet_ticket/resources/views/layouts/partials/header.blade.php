<header class="w-full h-[120px] bg-daark-green">
    <section class="w-full flex flex-row gap-8 items-center">
        <div class="h-[120px] max-w-[120px] flex justify-center items-center w-full bg-blue-600">
            <a href="{{ route('home') }}" class="flex justify-center items-center">
                <img
                loading="lazy"
                src="{{ asset('images/logo') }}"
                alt="Logo"
                class="w-full"
                />
            </a>
        </div>
        <div class="flex flex-row gap-4 ml-auto mr-10">
            <a href="{{ route('compte') }}" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3 bg-light-green border-dark-green">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5 text-dark-green" id="tchat">
                        Profile
                    </p>
                </div>
            </a>
            <a href="{{ route('user.friends', ['userId' => auth()->user()->id]) }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5 text-dark-green" id="tchat">
                        Amis
                    </p>
                </div>
            </a>
            <a href="{{ route('parties') }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5 text-dark-green" id="tchat">
                        Jouer
                    </p>
                </div>
            </a>
            <a href="{{ route('ranking') }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                    <p class="mr-5 text-dark-green" id="tchat">
                        Rank
                    </p>
                </div>
            </a>
            @if($isAdmin)
                <a href="{{ route('administration') }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                    <div class="flex gap-4">
                        <img loading="lazy" class="h-5 w-5 ml-5" src="{{ asset('images/icons/interrogation.svg') }}" alt="Icon">
                        <p class="mr-5 text-dark-green" id="tchat">
                            Administration
                        </p>
                    </div>
                </a>
            @endif
        </div>
    </section>
    
</header>





