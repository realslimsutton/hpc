<section
    class="min-h-screen w-full bg-center bg-cover bg-no-repeat flex items-center justify-center py-[135px] text-center lg:text-left"
    style="background-image: url('{{ asset_version('/images/hero-banner-bg.jpg') }}')"
>
    <div class="w-full max-w-screen-2xl mx-auto px-6 grid lg:grid-cols-2 mt-8">
        <div class="flex flex-col justify-center space-y-8">
            <div class="space-y-6">
                <div class="space-y-4 lg:space-y-0">
                    <h2 class="text-7xl text-white font-bold">
                        By <span class="text-hpc-gold">Poker Players,</span>
                    </h2>
                    <h2 class="text-7xl text-white font-bold">
                        For Poker Players.
                    </h2>
                </div>

                <p class="text-hpc-gold font-medium">
                    The first player-committed online poker club.
                </p>

                <p class="text-white font-medium">
                    Join thousands of other members and experience the 24/7 Action at Highroll Poker Club.
                </p>
            </div>

            <div class="flex items-center justify-center lg:justify-start flex-wrap gap-4">
                <x-button tag="a" href="#how-to-join" size="lg">
                    <span>
                        @svg('heroicon-o-play', 'h-8 w-8')
                    </span>

                    <span>
                        Play Now
                    </span>
                </x-button>

                <x-button tag="a" href="#about-the-club" size="lg" class="group" inverted>
                    <span>
                        Learn More
                    </span>

                    <span>
                        @svg('heroicon-o-arrow-sm-right', 'h-8 w-8 transition-all group-hover:pl-2')
                    </span>
                </x-button>
            </div>
        </div>

        <div class="hidden lg:block">
            <img src="{{ asset_version('images/hero-banner-cards.png') }}" alt="Cards" class="w-full h-auto">
        </div>
    </div>
</section>
