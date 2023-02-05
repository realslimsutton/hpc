@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <p>
            No Limit Holdem (also referred to as Texas Holdem) is the world’s most popular and well-known poker game.
            Most of the poker games played in casinos, online sites, or home games are No Limit Holdem.
        </p>

        <p>
            Each player in the game is dealt two cards which are private to each player. These are referred to as “hole
            cards”.
        </p>

        <p>
            The player who sits to the left of the dealer button is what we call the <span class="underline">“Small Blind”</span>.
            The player to the left of the small blind is the <span class="underline">“Big Blind”</span>. In a game where
            the blinds are $1/$2 (as shown in the example image below), it is mandatory for the <span class="underline">small blind</span>
            to put in $1 into the pot, and for the <span class="underline">big blind</span> to put in $2 into the pot
            before any of the cards are
            dealt.
        </p>

        <div class="flex justify-center">
            <img
                src="{{ asset_version('images/games/no-limit-holdem.png') }}"
                alt="No Limit Holdem"
                class="block my-4"
            />
        </div>

        <p>
            Once both of the blinds post their mandatory blinds, two cards are dealt to each player and the hand
            officially begins. Players are then in the “preflop” betting round (before any community cards are dealt)
            and are free to make bets and raises to force other players out of the hand that don’t want to match the bet
            made. Then, once all players have either called or folded, 5 community cards are dealt. The goal is to make
            the best 5 card hand utilizing not only your hole cards, but also the cards on the table. The player with
            the best 5 card hand (combining their hole cards and the board to assemble their best possible hand) wins
            the pot. To learn more about the hand rankings, feel free to check out our poker hand ranking guide <a
                href="{{ route('games.hand-rankings') }}" class="text-hpc-gold hover:underline">here</a>.
        </p>

        <h3 class="text-xl text-white font-semibold">
            There are four betting rounds in a No Limit Holdem poker hand:
        </h3>

        <ol class="list-decimal ml-8 space-y-4">
            <li>
                Preflop (before the community cards are dealt)
            </li>

            <li>
                Flop (the first three community cards dealt)
            </li>

            <li>
                Turn (one more community card is dealt)
            </li>

            <li>
                River (the last community card is dealt)
            </li>
        </ol>

        <h3 class="text-xl text-white font-semibold">
            Whenever it is a player’s turn, they have multiple options:
        </h3>

        <ol class="list-decimal ml-8 space-y-4">
            <li>
                <div>
                    Check
                </div>

                <ol class="list-decimal ml-8 space-y-4">
                    <li>
                        This means to pass on betting.
                    </li>

                    <li>
                        This option is only available if there are no current active bets in the current betting round
                        that must be called in order to continue in the hand.
                    </li>
                </ol>
            </li>

            <li>
                <div>
                    Call
                </div>

                <ol class="list-decimal ml-8 space-y-4">
                    <li>
                        This means matching the bet that the other player made.
                    </li>
                </ol>
            </li>

            <li>
                <div>
                    Fold
                </div>

                <ol class="list-decimal ml-8 space-y-4">
                    <li>
                        This means surrendering your hand and giving up the pot to the opposing player if you do not
                        wish to call a bet
                    </li>
                </ol>
            </li>

            <li>
                <div>
                    Bet
                </div>

                <ol class="list-decimal ml-8 space-y-4">
                    <li>
                        This means to bet chips into the pot (the amount you bet is your choice)
                    </li>
                </ol>
            </li>

            <li>
                <div>
                    Raise
                </div>

                <ol class="list-decimal ml-8 space-y-4">
                    <li>
                        This means to raise the previous bet in the current betting round.
                    </li>
                </ol>
            </li>
        </ol>

        <h3 class="text-xl text-white font-semibold">
            What happens at showdown?
        </h3>

        <ol class="list-decimal ml-8 space-y-4">
            <li>
                If the hand makes it to showdown, meaning that on the river the action has both players checking or one
                player betting and the other calling the bet, the player with the 5 card hand wins. To learn more about
                the hand rankings, feel free to check out our poker hand ranking guide <a
                    href="{{ route('games.hand-rankings') }}" class="text-hpc-gold hover:underline">here</a>.
            </li>

            <li>
                If both players get to showdown with the exact same hand strength, then the pot is split evenly between
                both players.
            </li>
        </ol>

        <h3 class="text-xl text-white font-semibold">
            Example
        </h3>

        <p>
            At the river, the pot is $100.
        </p>

        <p>
            Player A decides to go to all-in (meaning, this player bets all of their remaining chips) for $80.
        </p>

        <p>
            Player B has $200 remaining in his stack, but if they call then they only have to put in another $80 to
            match the bet amount of Player A.
        </p>

        <p>
            Player B decides to call. The final pot size at the end of this hand would be $260.
        </p>

        <p>
            ($100 initial pot size when players get to the river + $80 Player A all-in bet + $80 Player B calls)
        </p>

        <div class="py-8 space-y-16">
            <div class="grid lg:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-lg text-white font-semibold">
                        Player A shows
                    </h4>
                </div>

                <div>
                    <h4 class="text-lg text-white font-semibold">
                        Player B shows
                    </h4>
                </div>

                <div class="grid lg:grid-cols-2 gap-2">
                    <div>
                        <img
                            src="{{ asset_version('images/cards/8_of_spades.png') }}"
                            alt="8 of spades"
                            class="w-full h-auto"
                        />
                    </div>

                    <div>
                        <img
                            src="{{ asset_version('images/cards/9_of_clubs.png') }}"
                            alt="9 of clubs"
                            class="w-full h-auto"
                        />
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-2">
                    <div>
                        <img
                            src="{{ asset_version('images/cards/8_of_diamonds.png') }}"
                            alt="8 of diamonds"
                            class="w-full h-auto"
                        />
                    </div>

                    <div>
                        <img
                            src="{{ asset_version('images/cards/9_of_diamonds.png') }}"
                            alt="9 of diamonds"
                            class="w-full h-auto"
                        />
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-5 gap-2">
                <div class="lg:col-span-5">
                    <h4 class="text-lg text-white font-semibold">
                        The final community card runout was
                    </h4>
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
                        src="{{ asset_version('images/cards/10_of_diamonds.png') }}"
                        alt="10 of diamonds"
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
                        src="{{ asset_version('images/cards/2_of_spades.png') }}"
                        alt="2 of spades"
                        class="w-full h-auto"
                    />
                </div>
                <div>
                    <img
                        src="{{ asset_version('images/cards/2_of_diamonds.png') }}"
                        alt="8 of diamonds"
                        class="w-full h-auto"
                    />
                </div>
            </div>

            <div class="grid lg:grid-cols-5 gap-2">
                <div class="lg:col-span-5">
                    <h4 class="text-lg text-white font-semibold">
                        Player A in this situation would have a straight, 7 to the J
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
                        src="{{ asset_version('images/cards/8_of_spades.png') }}"
                        alt="8 of spades"
                        class="w-full h-auto"
                    />
                </div>
                <div>
                    <img
                        src="{{ asset_version('images/cards/9_of_clubs.png') }}"
                        alt="2 of clubs"
                        class="w-full h-auto"
                    />
                </div>
                <div>
                    <img
                        src="{{ asset_version('images/cards/10_of_diamonds.png') }}"
                        alt="10 of diamonds"
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
                        Player B in this situation would have a straight, 7 to the J
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
                        src="{{ asset_version('images/cards/8_of_diamonds.png') }}"
                        alt="8 of diamonds"
                        class="w-full h-auto"
                    />
                </div>
                <div>
                    <img
                        src="{{ asset_version('images/cards/9_of_diamonds.png') }}"
                        alt="9 of diamonds"
                        class="w-full h-auto"
                    />
                </div>
                <div>
                    <img
                        src="{{ asset_version('images/cards/10_of_diamonds.png') }}"
                        alt="10 of diamonds"
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
        </div>

        <p>
            To learn more about the hand rankings, feel free to check out our poker hand ranking guide <a
                href="{{ route('games.hand-rankings') }}" class="text-hpc-gold hover:underline">here</a>. Because
            both players A and B have a straight of the same value (7 to the J), the players split the $260 final pot
            value and both receive $130 each. The hand then ends there, and the dealer button is rotated by one player
            seat clockwise. The blinds move as well in accordance to the dealer button move. Then, a new hand of poker
            begins!
        </p>
    </div>
@endsection
