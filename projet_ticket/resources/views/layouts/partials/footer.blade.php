<footer id="footer" class="w-full py-20 bg-secondary-dark-green-hover flex flex-col gap-8 items-center px-4">
    <div class="flex border-b max-w-screen-xl w-full">
        <div class="flex w-full ">
            <div class="flex pb-8 gap-8 flex-col lg:flex-row w-full">
                <div class="flex flex-col gap-6 lg:max-w-[450px]">
                    <img
                        loading="lazy"
                        src="{{ asset('images/logo/slogan_blanc_vert.webp') }}"
                        alt="BoisEtSolaire"
                        class="w-[230px] h-7 mr-12"
                    />
                    <p class="text-white">
                        BoisEtSolaire.fr vend des carports solaires en bois de haute qualité.
                        Les carports sont fabriqués à partir de bois durable et résistant aux
                        intempéries, et sont conçus pour être solides et durables.
                    </p>
                </div>
                <div class="lg:ml-auto">
                    <div class="grid lg:gap-16 gap-8 body-lg grid-cols-2 max-lg:justify-between">
                        <div class="flex">
                            <div class="flex flex-col gap-6">
                                <p class="font-bold text-white body-lg">
                                    Explorer
                                </p>
                                <div class="flex flex-col body-base">
                                    <a href="{{ route('product.carport') }}" class="text-white">
                                        Carport solaire
                                    </a>
                                </div>
                                <div class="flex flex-col body-base">
                                    <a href="{{ route('product.carport.create') }}" class="text-white">
                                        Configurateur
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flex ml-auto">
                            <div class="flex flex-col gap-6">
                                <p class="font-bold text-white body-lg">
                                    À propos
                                </p>
                                <div class="flex flex-col body-base">
                                    <a href="{{ route('about-us') }}" class="text-white">
                                        Qui-sommes nous ?
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-xl mx-auto w-full text-sm">
        <div class="flex items-start lg:items-center justify-between lg:py-4 flex-col lg:flex-row mx-auto">
            <div class="flex flex-row gap-6 max-lg:justify-between w-full">
                <div class="flex gap-6 flex-col lg:flex-row">
                    <a href="{{ route('legal-notice') }}" class="text-white">
                        Mentions légales
                    </a>
                </div>
                <div class="flex gap-6 flex-col lg:flex-row max-lg:ml-auto">
                    <a href="{{ route('legal-notice') }}" class="text-white">
                        Politique de confidentialité
                    </a>
                </div>
            </div>
            <div class="ml-auto mt-6 lg:mt-0 lg:block hidden">
                <p class="text-white w-[200px] text-end">
                    © 2023 BoisEtSolaire
                </p>
            </div>
        </div>
        <div class="mt-6 lg:hidden block">
            <p class="text-white">
                © 2023 BoisEtSolaire
            </p>
        </div>
    </div>
</footer>
