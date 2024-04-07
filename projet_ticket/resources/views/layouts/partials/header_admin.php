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
            <a href="/login" class="flex ml-auto border-secondary-dark-green-hover border py-2 px-3 bg-light-green border-dark-green">
                <div class="flex gap-4">
                    <p class="mr-5 text-dark-green" id="tchat">
                        Se connecter
                    </p>
                </div>
            </a>
            <a href="/register" class="bg-light-green border-dark-green flex ml-auto border-secondary-dark-green-hover border py-2 px-3">
                <div class="flex gap-4">
                    <p class="mr-5 text-dark-green" id="tchat">
                        Créer un compte
                    </p>
                </div>
    </section>
</header>









