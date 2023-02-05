@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <div>
            <img
                src="{{ asset_version('images/promotions/loyalty/RakebackProgram-Big-Poster.jpg') }}"
                alt="Loyalty Program"
                class="w-full h-auto rounded-lg"
            />
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="flex items-center justify-center py-12 border-t-4 border-b-4 border-hpc-gold">
                <h2 class="text-3xl font-medium text-center">
                    Highroll Poker Club is offering one of the <span class="text-hpc-gold">best rakeback</span> programs
                    available in the industry.
                </h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-6">
                <h2 class="text-3xl font-medium text-center">
                    Increase your <span class="text-hpc-gold">earning potential</span> by climbing the ranks in our
                    Loyalty Program!
                </h2>

                <h3 class="text-xl font-medium text-center">
                    This loyalty program allows our club members to earn a <span class="text-hpc-gold">percentage of their own rake contribution</span>
                    during cash game or tournament play at our real money tables.
                </h3>
            </div>
        </div>

        <div class="space-y-4">
            <img
                src="{{ asset_version('images/promotions/loyalty/How-To-Earn-Rakeback.jpg') }}"
                alt="Loyalty Program"
                class="w-full h-auto rounded-lg"
            />

            <h3 class="text-xl font-medium text-center">
                * <span class="text-hpc-gold">Please note</span> that in order to earn and claim rakeback, you must have
                both an <span class="text-hpc-gold">account on our website</span> and a <span class="text-hpc-gold">ClubGG account</span>.
            </h3>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/loyalty/Loyalty_Program_Tier_Requirements.jpg') }}"
                    alt="Loyalty Program"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <div class="flex flex-col items-center justify-center gap-6">
                <h3 class="text-xl font-medium">
                    1) Players earn 5 LP (loyalty points) for every $1.00 USD contributed in gross rake within our
                    <span class="text-hpc-gold">real money</span> cash games or tournaments (freerolls not included).
                </h3>

                <h3 class="text-xl font-medium">
                    2) Players are able to earn <span class="text-hpc-gold">larger rakeback percentages</span> as they
                    climb through the loyalty program tiers by <span class="text-hpc-gold">unlocking more favorable LP to USD conversion rates.</span>
                </h3>
            </div>
        </div>

        <h3 class="text-xl font-medium text-center">
            * Rakeback figures are updated in the <span class="text-hpc-gold">Member Dashboard</span> on our website
            daily at 11:59PM PST.
        </h3>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/loyalty/Promotions-and-Demotions.jpg') }}"
                    alt="Loyalty Program"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <h3 class="text-xl font-semibold">
                1) Loyalty tiers are determined by the <span class="text-hpc-gold">highest tier achieved</span> in a
                given month.
            </h3>

            <p class="text-lg">
                For example, in the month of February you began in Gold tier. Let’s say that on February 20th, you
                achieve the minimum LP requirement for the next tier (Platinum tier, in this case). In this situation,
                you would get immediate access to the Platinum tier rewards once the minimum LP requirement is reached.
            </p>

            <h3 class="text-xl font-semibold">
                2) Loyalty tiers <span class="text-hpc-gold">carry over</span> month to month.
            </h3>

            <p class="text-lg">
                For example, if you achieve/maintain Gold tier in March, then you will keep your Gold tier rewards until
                the last day of April at 11:59PM PST.
            </p>

            <h3 class="text-xl font-semibold">
                3) You can only be <span class="text-hpc-gold">demoted</span> in loyalty tier if you did not achieve the
                minimum LP requirement for your current tier by 11:59PM PST last day of the month.
            </h3>

            <p class="text-lg">
                For example, let’s say that you earned Gold tier in February. That means that you are able enjoy the
                Gold tier rewards all the way until the last day of March. Let’s also say that in the month of March,
                you did not meet the minimum LP requirement for Gold tier. That means that on April 1st, you will be
                demoted to Silver tier.”
            </p>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/loyalty/Rakeback-Payouts.jpg') }}"
                    alt="Loyalty Program"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <h3 class="text-xl font-semibold">
                1) <span class="text-hpc-gold">You choose</span> when you get your rakeback paid out.
            </h3>

            <p class="text-lg">
                If you want to accumulate your LP (loyalty points) for a future month where you think you can earn a
                higher loyalty tier, you are able to carry over any unspent LP to the next month. However, carried over
                LP does not jump start your minimum monthly LP requirement for the new month’s earned tier.
            </p>

            <p class="text-lg">
                For example, if you decide to carry over 1000 LP earned in February to March, you will not start the
                month of March at 1000 LP towards the next tier. The next tier in this example (Gold) requires 3000 LP,
                which means that you need to actually earn 3000 LP in the new month of March to obtain the Gold tier
                rewards. Carried over LP can be cashed for whatever LP conversion you obtain in that month’s earned
                tier.
            </p>

            <h3 class="text-xl font-semibold">
                2) Rakeback can be claimed <span class="text-hpc-gold">at any time</span> to your playable ClubGG
                balance.
            </h3>

            <p class="text-lg">
                Need some quick funds to get back into the action? Your LP is always ready to be converted to playable
                ClubGG balance.
            </p>

            <p class="text-lg">
                Head over to your Member Dashboard on our website and navigate to the “Rakeback” tab. This is where you
                are able to view and claim your rakeback rewards.
            </p>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/loyalty/Start-Earning-Rakeback-Today.jpg') }}"
                    alt="Loyalty Program"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) <span class="text-hpc-gold">Download</span> the ClubGG app and
                <span class="text-hpc-gold">create</span> a ClubGG account
            </p>

            <p class="text-lg">
                2) <span class="text-hpc-gold">Create</span> an account on our Highroll Poker Club website
            </p>

            <p class="text-lg">
                3) No further action required! You’re now <span class="text-hpc-gold">enrolled automatically</span> in
                our loyalty program.
            </p>

            <p class="text-lg">
                4) Get in touch with us on <span class="text-hpc-gold">Discord</span> for any questions you may have!
                Our customer support team is available 24/7.
            </p>
        </div>

        <x-promotions.how-to-join/>
    </div>
@endsection
