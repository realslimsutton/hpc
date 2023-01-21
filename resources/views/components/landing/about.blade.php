<section
    class="relative py-12 bg-cover bg-no-repeat text-white after:absolute after:z-10 after:inset-0 after:bg-gray-900/50 text-center lg:text-left"
    style="background-image: url('{{ asset_version('images/about-bg.png') }}')"
>
    <div class="w-full max-w-screen-2xl mx-auto px-6 grid lg:grid-cols-2 gap-12 z-20 relative">
        <div class="grid sm:grid-cols-2 gap-8 items-center justify-center">
            <x-landing.about.stat
                title="5,000+"
                body="Active Members"
            >
                <x-slot:icon>
                    @svg('heroicon-o-user-group', 'h-16 w-16', ['stroke-width' => 1])
                </x-slot:icon>
            </x-landing.about.stat>

            <x-landing.about.stat
                title="65+"
                body="Ongoing Cash Games"
            >
                <x-slot:icon>
                    <img src="{{ asset_version('images/poker-table.png') }}" alt="" class="h-14 w-auto"/>
                </x-slot:icon>
            </x-landing.about.stat>

            <x-landing.about.stat
                title="2021"
                body="Est. Date"
            >
                <x-slot:icon>
                    @svg('heroicon-o-calendar', 'h-16 w-16', ['stroke-width' => 1])
                </x-slot:icon>
            </x-landing.about.stat>

            <x-landing.about.stat
                title="20+"
                body="Daily Tournaments"
            >
                <x-slot:icon>
                    @svg('heroicon-o-cash', 'h-16 w-16', ['stroke-width' => 1])
                </x-slot:icon>
            </x-landing.about.stat>
        </div>

        <div class="flex flex-col justify-center gap-8">
            <h2 class="font-bold text-6xl">
                About The <span class="text-hpc-gold">Club</span>
            </h2>

            <div class="space-y-4">
                <p class="font-medium">
                    Highroll Poker Club was established in 2021 and has been the <span class="text-hpc-gold">longest and oldest private poker game</span>
                    on the ClubGG app (launched January 2021). Here, your privacy and trust are what we strive for.
                </p>

                <p class="font-medium">
                    Our team consists of passionate poker players who understand what players really want in a poker
                    club. We provide <span
                        class="text-hpc-gold">the most lucrative player bonuses and loyalty programs</span> in today’s
                    industry to prove our commitment to our motto: <span class="text-hpc-gold">“By Poker Players, For Poker Players”.</span>
                </p>
            </div>

            <div>
                <x-button tag="a" href="#" size="lg" class="group">
                    <span>
                        Learn More
                    </span>

                    <span>
                        @svg('heroicon-o-arrow-sm-right', 'h-8 w-8 transition-all group-hover:pl-2')
                    </span>
                </x-button>
            </div>
        </div>
    </div>
</section>
