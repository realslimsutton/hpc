@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <div>
            <img
                src="{{ asset_version('images/promotions/freeroll-tournaments/Freeroll-Tournament-Banner.jpg') }}"
                alt="Freeroll Tournaments"
                class="w-full h-auto rounded-lg"
            />
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="flex items-center justify-center py-12 border-t-4 border-b-4 border-hpc-gold">
                <h2 class="text-3xl font-medium text-center">
                    At Highroll Poker Club, we regularly give back to our community through our
                    <span class="text-hpc-gold">exclusive</span> freeroll tournaments.
                </h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-6">
                <h2 class="text-3xl font-medium text-center">
                    We will <span class="text-hpc-gold">power up your bankroll</span> through our community freeroll
                    tournaments!
                </h2>

                <h3 class="text-xl font-medium text-center">
                    * <span class="text-hpc-gold">Please note</span> that these freeroll tournaments are password
                    protected. To get the password, please join our Discord server.
                </h3>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/freeroll-tournaments/Terms-and-Conditions.jpg') }}"
                    alt="Freeroll Tournaments"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) No deposit required to enter into our freeroll tournaments.
            </p>

            <p class="text-lg">
                2) Freeroll tournaments are password protected. Please join our discord server to get access to the
                freeroll tournament password.
            </p>

            <p class="text-lg">
                3) Winnings from freeroll tournaments are credited immediately into ClubGG account balances.
            </p>

            <p class="text-lg">
                4) Withdrawal of freeroll winnings requires a 1x rollover before becoming available.
            </p>

            <p class="text-lg">
                5) Chip dumping freeroll winnings into another account in our club to bypass the rollover requirement
                constitutes immediate club-wide ban.
            </p>

            <p class="text-lg">
                6) Verification may be done at time of withdrawal in order to prevent abuse of this benefit.
            </p>

            <p class="text-lg">
                7) Club Admin decisions are final and modification to these terms and conditions can occur at any point
                in time without the obligation to notify or provide compensation to any club member
            </p>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/freeroll-tournaments/How-To-Play.jpg') }}"
                    alt="Freeroll Tournaments"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) All freeroll tournaments are <span class="text-hpc-gold">password protected</span>.
            </p>

            <p class="text-lg">
                2) To get access to the password, please join our <span class="text-hpc-gold">Discord</span>.
            </p>

            <p class="text-lg">
                3) No deposit required.
            </p>
        </div>

        <x-promotions.how-to-join/>
    </div>
@endsection
