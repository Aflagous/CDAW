<header class="w-full h-[120px] bg-daark-green">
    <section class="w-full flex flex-row gap-8 items-center mr-5">
        <div class="h-[120px] max-w-[120px] flex justify-center items-center w-full bg-blue-600">
            <a href="{{ route('home') }}" class="flex justify-center items-center">
                <img
                loading="lazy"
                src="{{ asset('images/logo.png') }}"
                alt="Logo"
                class="w-full"
                />
            </a>
        </div>
        <div class="flex flex-row gap-4 ml-auto mr-10">
            <a href="{{ route('compte') }}" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3 bg-light-green border-dark-green">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <img loading="lazy" class="h-5 w-5 md:ml-5" src="{{ asset('images/profile.png') }}" alt="Icon">
                    <p class="md:mr-5 text-dark-green" id="tchat">
                        Profile
                    </p>
                </div>
            </a>
            <a href="{{ route('user.friends', ['userId' => auth()->user()->id]) }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <img loading="lazy" class="h-5 w-5 md:ml-5" src="{{ asset('images/amis.png') }}" alt="Icon">
                    <p class="md:mr-5 text-dark-green" id="tchat">
                        Amis
                    </p>
                </div>
            </a>
            <a href="{{ route('parties') }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <img loading="lazy" class="h-5 w-5 md:ml-5" src="{{ asset('images/play.png') }}" alt="Icon">
                    <p class="md:mr-5 text-dark-green" id="tchat">
                        Jouer
                    </p>
                </div>
            </a>
            <a href="{{ route('logout') }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3 justify-center">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-center">
                    <p class="md:mr-5 text-dark-green text-center" id="tchat">
                        Se déconnecter
                    </p>
                </div>
            </a>
            @if($isAdmin)
                <a href="{{ route('administration') }}" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                    <div class="flex gap-4">
                        <p class="mr-5 text-dark-green" id="tchat">
                            Administration
                        </p>
                    </div>
                </a>
            @endif
        </div>
    </section>
    
</header>





