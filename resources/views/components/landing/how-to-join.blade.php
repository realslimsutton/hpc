<section
    id="how-to-join"
    class="bg-gray-800 py-12 bg-center bg-cover bg-no-repeat text-white text-center"
    style="background-image: url('{{ asset_version('images/how-to-join-bg.jpg') }}')"
>
    <div class="w-full max-w-screen-2xl mx-auto px-6 flex flex-col items-center justify-center gap-8">
        <h2 class="text-6xl font-bold">
            How to <span class="text-hpc-gold">Join</span> Highroll Poker Club
        </h2>

        <div class="max-w-screen-md space-y-6 text-center">
            <x-landing.how-to-join-our-club.card icon="heroicon-o-download">
                <x-slot:title>
                    <a href="https://www.clubgg.net/" target="_blank" class="flex items-center gap-2">
                        <span>
                            Download ClubGG
                        </span>

                        <span>
                            @svg('heroicon-o-external-link', 'h-8 w-8')
                        </span>
                    </a>
                </x-slot:title>
            </x-landing.how-to-join-our-club.card>

            <x-landing.how-to-join-our-club.card icon="heroicon-o-user">
                <x-slot:title>
                    Sign Up For An Account
                </x-slot:title>
            </x-landing.how-to-join-our-club.card>

            <x-landing.how-to-join-our-club.card icon="heroicon-o-user">
                <x-slot:title>
                    Join Club
                </x-slot:title>

                <div>
                    <p class="font-medium text-hpc-gold">
                        Code: 418589
                    </p>

                    <p class="font-medium text-hpc-gold">
                        Referrer Code: 56655888
                    </p>
                </div>
            </x-landing.how-to-join-our-club.card>

            <x-landing.how-to-join-our-club.card icon="heroicon-o-user" last>
                <x-slot:title>
                    <a href="https://discord.gg/hrpc" target="_blank" class="flex items-center gap-2">
                        <span>
                            Contact Us on <span class="text-hpc-gold">Discord</span> to Begin Playing
                        </span>

                        <span>
                            @svg('heroicon-o-external-link', 'h-8 w-8')
                        </span>
                    </a>
                </x-slot:title>
            </x-landing.how-to-join-our-club.card>
        </div>
    </div>
</section>
