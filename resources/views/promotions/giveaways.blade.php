@extends('layouts.base')

@section('body')
    <x-page.banner>
        Giveaways
    </x-page.banner>

    <div class="w-full max-w-screen-2xl mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12">
        <div>
            <img
                src="{{ asset_version('images/promotions/giveaways/Giveaway-Big-Poster.jpg') }}"
                alt="Giveaways"
                class="w-full h-auto rounded-lg"
            />
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="flex items-center justify-center py-12 border-t-4 border-b-4 border-hpc-gold">
                <h2 class="text-3xl font-medium text-center">
                    At Highroll Poker Club, we regularly give back to our community through <span class="text-hpc-gold">exclusive</span>
                    giveaways!
                </h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-6">
                <h2 class="text-3xl font-medium text-center">
                    We will <span class="text-hpc-gold">power up your bankroll</span> through our community giveaways!
                </h2>

                <h3 class="text-xl font-medium text-center">
                    * <span class="text-hpc-gold">Please note</span> that you must have a <span class="text-hpc-gold">ClubGG</span>
                    account and be a member of our <span class="text-hpc-gold">Discord</span> to be eligible for our
                    giveaways!
                </h3>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/giveaways/Terms-and-Conditions.jpg') }}"
                    alt="Giveaways"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) No deposit required to enter into giveaways.
            </p>

            <p class="text-lg">
                2) To ensure trust that all giveaways are legitimately conducted, we will be using a well-known and
                trusted third party to select winners (Gleam.io)
            </p>

            <p class="text-lg">
                3) Winnings from freeroll tournaments are credited immediately into ClubGG account balances
            </p>

            <p class="text-lg">
                4) Withdrawal of giveaway winnings require a 1x rollover before becoming available
            </p>

            <p class="text-lg">
                5) Chip dumping giveaways into another account to bypass the rollover requirement constitutes immediate
                club-wide ban.
            </p>

            <p class="text-lg">
                6) Verification may be done in order to prevent abuse of this benefit.
            </p>

            <p class="text-lg">
                7) Club admin decisions are final and modification of these terms and conditions can occur at any point
                in time without the obligation to notify or provide compensation to any club member.
            </p>

            <p class="text-lg">
                8) By entering into our giveaways, you agree to abide by these terms and conditions.
            </p>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/giveaways/How-To-Enter-Giveaways.jpg') }}"
                    alt="Giveaways"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) Join our <span class="text-hpc-gold">Discord</span> server. Winners must be verified members of our
                discord server to be eligible.
            </p>
        </div>

        <x-promotions.how-to-join/>
    </div>
@endsection
