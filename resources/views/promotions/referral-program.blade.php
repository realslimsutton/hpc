@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <div>
            <img
                src="{{ asset_version('images/promotions/referral-program/ReferralProgram-Big-Poster.jpg') }}"
                alt="Referral Program"
                class="w-full h-auto rounded-lg"
            />
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="flex items-center justify-center py-12 border-t-4 border-b-4 border-hpc-gold">
                <h2 class="text-3xl font-medium text-center">
                    Highroll Poker Club is offering one of the <span class="text-hpc-gold">best referral rewards</span>
                    programs available in the industry.
                </h2>
            </div>

            <div class="flex flex-col items-center justify-center gap-6">
                <h2 class="text-3xl font-medium text-center">
                    Start <span class="text-hpc-gold">earning cash rewards</span> today by referring your friends in our
                    Highroll Referral Program!
                </h2>

                <h3 class="text-xl font-medium text-center">
                    This program allows you to earn a <span class="text-hpc-gold">percentage of the gross rake</span>
                    that your friend(s) generate!
                </h3>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/referral-program/Referral_Program_Tier_Requirements.jpg') }}"
                    alt="Referral Program"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <div class="flex flex-col items-center justify-center gap-6">
                <h3 class="text-xl font-medium">
                    1) The number of active referrals you have will affect the <span class="text-hpc-gold">percentage of gross rake unlocked</span>.
                    (See table to the left)
                </h3>

                <h3 class="text-xl font-medium">
                    2) You must have a <span class="text-hpc-gold">minimum of 2 active referrals</span> under your
                    account before you can start earning referral rewards.
                </h3>

                <h3 class="text-xl font-medium">
                    3) <span class="text-hpc-gold">Active referrals</span> are members who have played at least 500
                    hands in the past 6 months.
                </h3>

                <h3 class="text-xl font-medium">
                    * Referral Reward figures are updated in the <span class="text-hpc-gold">Member Dashboard</span> on
                    our website daily at 11:59PM PST.
                </h3>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/referral-program/How-To-Payout-Referral-Rewards.jpg') }}"
                    alt="First Deposit Bonus"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) Referral Rewards are <span class="text-hpc-gold">automatically deposited</span> into the referrer’s
                ClubGG account balance every week on Sunday 11:59PM PST.
            </p>

            <p class="text-lg">
                2) These cash rewards are made <span class="text-hpc-gold">immediately available</span> for play at our
                real money cash games and tournaments.
            </p>

            <p class="text-lg">
                3) These cash rewards have no rollover and
                <span class="text-hpc-gold">can be withdrawn immediately</span>.
            </p>

            <p class="text-lg">
                4) Withdrawals can only be made in <span class="text-hpc-gold">cryptocurrency</span>.
            </p>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/referral-program/Terms-And-Conditions.jpg') }}"
                    alt="Referral Program"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) No referral code needed. All you need to do is have your friend(s) tell us your ClubGG username and
                that you referred them to us.
            </p>

            <p class="text-lg">
                2) Must have a minimum of 2 referrals before you are eligible to claim rewards.
            </p>

            <p class="text-lg">
                3) Referral rewards can be claimed for 36 months from date of referral for each member.
            </p>

            <p class="text-lg">
                4) Promotion abusers are subject to being banned from all future and current promotions. Additionally,
                promotion abusers are subject to a club-wide ban.
            </p>

            <p class="text-lg">
                5) Your referral income can be claimed and tracked on our website.
            </p>

            <p class="text-lg">
                6) Referral rewards are automatically deposited into the head referrer’s player account balance every
                week at Sunday 11:59PM PST.
            </p>

            <p class="text-lg">
                7) Referral program is only enabled for club members have deposited and played at our club cash
                games/tournaments before.
            </p>

            <p class="text-lg">
                8) You may only receive referral bonuses on actual new players you bring into the club. You cannot
                work around this requirement by simply having an existing member make a new account.
            </p>

            <p class="text-lg">
                9) Referrals become “inactive” and no longer count towards your active referral count if the referred
                player has not played at least 500 hands in the past 6 months.
            </p>

            <p class="text-lg">
                10) Club Admin decisions are final and modification to these terms and conditions can occur at any point
                in time without the obligation to notify or provide compensation to any club member
            </p>

            <p class="text-lg">
                11) Verification by club admins may be done in order to prevent abuse of this benefit.
            </p>
        </div>

        <div class="space-y-8">
            <div>
                <img
                    src="{{ asset_version('images/promotions/referral-program/Start-Earning-Rewards-Today.jpg') }}"
                    alt="Referral Program"
                    class="w-full h-auto rounded-lg"
                />
            </div>

            <p class="text-lg">
                1) <span class="text-hpc-gold">Download</span> the ClubGG app and
                <span class="text-hpc-gold">create</span> a ClubGG account (see
                instructions below)
            </p>

            <p class="text-lg">
                2) <span class="text-hpc-gold">Create</span> an account on our Highroll Poker Club website
            </p>

            <p class="text-lg">
                3) Have your friend(s) <span class="text-hpc-gold">follow</span> steps 1 & 2
            </p>

            <p class="text-lg">
                4) Get in touch with us on <span class="text-hpc-gold">Discord</span> for any questions you may have!
                Our customer support team is available 24/7.
            </p>
        </div>

        <x-promotions.how-to-join/>
    </div>
@endsection
