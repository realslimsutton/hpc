@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <div>
            <img
                src="{{ asset_version('images/promotions/first-deposit-bonus/Banner.jpg') }}"
                alt="First Deposit Bonus"
                class="w-full h-auto rounded-lg"
            />
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="flex items-center justify-center py-12 border-t-4 border-b-4 border-hpc-gold">
                <h2 class="text-3xl font-medium text-center">
                    At Highroll Poker Club, we provide our players with the
                    <span class="text-hpc-gold">best rewards</span> as a welcome to our club
                </h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-6">
                <h2 class="text-3xl font-medium text-center">
                    We will <span class="text-hpc-gold">power up your bankroll</span> with a 100% first time deposit
                    bonus up to $2000 when you deposit at least $50 or more.
                </h2>

                <h3 class="text-xl font-medium text-center">
                    * <span class="text-hpc-gold">Please note</span> that this is not an upfront bonus and is released
                    as you play at our real money poker tables.
                </h3>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/first-deposit-bonus/Terms-and-Conditions.jpg') }}"
                    alt="First Deposit Bonus"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) Only one first time deposit bonus can be claimed per household, IP, account, member.
            </p>

            <p class="text-lg">
                2) Minimum deposit to qualify: $50
            </p>

            <p class="text-lg">
                3) Promotion abusers are subject to being banned from all future current promotions. Additionally,
                promotion abusers are subject to a club-wide ban.
            </p>

            <p class="text-lg">
                4) This deposit bonus is not released all at once. $1 is released per every $5 raked in real money cash
                games or tournaments (excluding freeroll tournaments).
            </p>

            <p class="text-lg">
                5) Deposit bonus amounts are deposited into player ClubGG accounts once a week at Sunday 11:59 PM PST.
            </p>

            <p class="text-lg">
                6) This deposit bonus can be claimed and tracked from the member dashboard on our website.
            </p>

            <p class="text-lg">
                7) Only the first deposit during the promotion period is eligible for the First Time Deposit bonus. For
                example, if you deposit $40 and then deposit another $50 afterwards, the $40 deposit was your first
                deposit and did not qualify for the deposit bonus.
            </p>

            <p class="text-lg">
                8) Players have 60 days to release and claim the deposit bonus amount. Any unclaimed amounts after 60
                days are considered void.
            </p>

            <p class="text-lg">
                9) Verification by club admins may be done in order to prevent abuse of this benefit.
            </p>

            <p class="text-lg">
                10) Club admin decisions are final and modification to these terms and conditions can occur at any point
                in time without obligation to notify or provide compensation to any club member.
            </p>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/first-deposit-bonus/How-To-Claim.jpg') }}"
                    alt="First Deposit Bonus"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) <span class="text-hpc-gold">No deposit code necessary</span>. This promo is automatically applied to
                your first deposit with us.
            </p>

            <p class="text-lg">
                2) Get in touch with us on <span class="text-hpc-gold">Discord</span> Our representatives will guide you
                through the next steps.
            </p>
        </div>

        <x-promotions.how-to-join/>
    </div>
@endsection
