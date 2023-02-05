@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <p>
            The hand rankings are the exact same in No Limit Holdem and Pot Limit Omaha. Below you will find a list of
            the poker hand ranks in order from highest to lowest:
        </p>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    1. Royal Flush - The best hand in poker, consists of exactly A, K Q, J, and 10 of all the same suit.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/king_of_hearts.png') }}"
                    alt="King of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/queen_of_hearts.png') }}"
                    alt="Queen of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_hearts.png') }}"
                    alt="Jack of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/10_of_hearts.png') }}"
                    alt="10 of hearts"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    2. Straight Flush - A straight that has every card within it the same suit.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/10_of_hearts.png') }}"
                    alt="10 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/9_of_hearts.png') }}"
                    alt="9 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/8_of_hearts.png') }}"
                    alt="8 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_hearts.png') }}"
                    alt="7 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/6_of_hearts.png') }}"
                    alt="6 of hearts"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    3. Four of a Kind - Also referred to as “quads”, consists of four of the same card along with another card known as the “kicker”.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_hearts.png') }}"
                    alt="Jack of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_clubs.png') }}"
                    alt="Jack of clubs"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_diamonds.png') }}"
                    alt="Jack of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_spades.png') }}"
                    alt="Jack of spades"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    4. Full House - Also referred to as a “boat”, consists of three cards of the same value, along with another pair of a different value. In the example above, the player would have “Jacks full of Aces”.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_diamonds.png') }}"
                    alt="Ace of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_clubs.png') }}"
                    alt="Jack of clubs"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_diamonds.png') }}"
                    alt="Jack of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_spades.png') }}"
                    alt="Jack of spades"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    5. Flush - A flush consists of five cards of the same suit.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_hearts.png') }}"
                    alt="Jack of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/9_of_hearts.png') }}"
                    alt="9 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/8_of_hearts.png') }}"
                    alt="8 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/6_of_hearts.png') }}"
                    alt="6 of hearts"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    6. Straight - Consists of five cards in consecutive order of value that are not all in the same suit.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/2_of_spades.png') }}"
                    alt="2 of spades"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/3_of_clubs.png') }}"
                    alt="3 of clubs"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/4_of_diamonds.png') }}"
                    alt="4 of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/5_of_spades.png') }}"
                    alt="5 of spades"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    7. Three of a Kind - Also referred to as “trips”, consists of three cards of the same value, along with two high cards referred to as “kickers”.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_hearts.png') }}"
                    alt="7 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_clubs.png') }}"
                    alt="7 of clubs"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_diamonds.png') }}"
                    alt="7 of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/king_of_diamonds.png') }}"
                    alt="King of diamonds"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    8. Two Pair - Consists of two cards of the same value, and another two cards of the same value, along with a high card referred to as the “kicker”.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_diamonds.png') }}"
                    alt="Ace of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_hearts.png') }}"
                    alt="7 of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_diamonds.png') }}"
                    alt="7 of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_clubs.png') }}"
                    alt="Jack of clubs"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    9. One Pair - Consists of two cards of the same value, and three high cards referred to as “kickers”.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_diamonds.png') }}"
                    alt="Ace of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/king_of_diamonds.png') }}"
                    alt="King of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_spades.png') }}"
                    alt="Jack of spades"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_clubs.png') }}"
                    alt="7 of clubs"
                    class="w-full h-auto"
                />
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-2">
            <div class="lg:col-span-5">
                <h4 class="text-lg text-white font-semibold">
                    10. High Card - When you only have five cards that do not connect with each other in any way to make one of the higher ranked hands.
                </h4>
            </div>

            <div>
                <img
                    src="{{ asset_version('images/cards/ace_of_hearts.png') }}"
                    alt="Ace of hearts"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/king_of_diamonds.png') }}"
                    alt="King of diamonds"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/jack_of_spades.png') }}"
                    alt="Jack of spades"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/7_of_clubs.png') }}"
                    alt="7 of clubs"
                    class="w-full h-auto"
                />
            </div>
            <div>
                <img
                    src="{{ asset_version('images/cards/5_of_spades.png') }}"
                    alt="5 of spades"
                    class="w-full h-auto"
                />
            </div>
        </div>
    </div>
@endsection
