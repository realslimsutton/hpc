@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <p>
            Pot Limit Omaha (also referred to as “PLO”) is another popular poker game that shares many similarities with
            No Limit Holdem. The biggest similarity is that the objective of the game is the exact same: to make the
            best possible five-card hand using a combination of your hole cards and the five community cards.
        </p>

        <p>
            However, where Pot Limit Omaha differs is that each player is dealt four hole cards instead of two.
            Additionally, players must make their best five-card hand using exactly two of their hole cards and three
            community cards.
        </p>

        <p>
            How the dealer button and blinds work are the exact same as Texas Holdem. The player who sits to the left of
            the dealer button is what we call the <span class="underline">“Small Blind”</span>. The player to the left
            of the small blind is the <span class="underline">“Big Blind”</span>. In a game where the blinds are $1/$2
            (as shown in the example image below), it is mandatory for the <span class="underline">small blind</span> to
            put in $1 into the pot, and for the <span class="underline">big blind</span> to put in $2 into the pot
            before any of the cards are dealt.
        </p>

        <div class="flex justify-center">
            <img
                src="{{ asset_version('images/games/pot-limit-omaha.png') }}"
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
            There are four betting rounds in a Pot Limit Omaha poker hand:
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

                    <li>
                        In Pot Limit Omaha, as the name suggests, a player can only bet or raise up to the current pot
                        size. So, for example, a player can’t go all in for $100 when the pot size is only $5. The max
                        you could bet is $5.
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

        <p>
            If the hand makes it to showdown, meaning that on the river the action has both players checking or one
            player betting and the other calling the bet, the player with the 5 card hand wins. To learn more about the
            hand rankings, feel free to check out our poker hand ranking guide <a
                href="{{ route('games.hand-rankings') }}" class="text-hpc-gold hover:underline">here</a>.
        </p>

        <h3 class="text-xl text-white font-semibold">
            Making hands in Pot Limit Omaha
        </h3>

        <p>
            It is incredibly important for players to know that they must play exactly two of their hole cards and three
            of the community cards to make their best possible hand.
        </p>

        <h3 class="text-xl text-white font-semibold">
            Example:
        </h3>

        <div class="py-8 space-y-16">
            <div class="grid lg:grid-cols-4 gap-2">
                <div class="lg:col-span-4">
                    <h4 class="text-lg text-white font-semibold">
                        Player A has the following hole cards in their hand in a Pot Limit Omaha game
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
                        src="{{ asset_version('images/cards/9_of_diamonds.png') }}"
                        alt="9 of diamonds"
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
            </div>

            <div class="grid lg:grid-cols-5 gap-2">
                <div class="lg:col-span-5">
                    <h4 class="text-lg text-white font-semibold">
                        The community cards final board runout is the following
                    </h4>
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
                        src="{{ asset_version('images/cards/5_of_hearts.png') }}"
                        alt="5 of hearts"
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
                        src="{{ asset_version('images/cards/king_of_hearts.png') }}"
                        alt="King of hearts"
                        class="w-full h-auto"
                    />
                </div>
                <div>
                    <img
                        src="{{ asset_version('images/cards/ace_of_spades.png') }}"
                        alt="Ace of spades"
                        class="w-full h-auto"
                    />
                </div>
            </div>

            <div class="grid lg:grid-cols-5 gap-2">
                <div class="lg:col-span-5 space-y-2">
                    <p>
                        Some people may say that Player A has a flush here because he has 5 hearts. However, Player A
                        <span class="underline">does not</span> have a flush here because in Pot Limit Omaha, you <span
                            class="underline">must</span>use <span class="underline">exactly</span> two of your hole
                        cards and three of the community cards to make your best possible hand. In order for Player A to
                        have a flush here, he needs to have two hearts in his hand to combine with three hearts of the
                        community cards.
                    </p>

                    <p>
                        Player A’s real hand here is a pair of aces with a high card of K, Q, 9.
                    </p>
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
                        src="{{ asset_version('images/cards/ace_of_spades.png') }}"
                        alt="Ace of spades"
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
                        src="{{ asset_version('images/cards/9_of_diamonds.png') }}"
                        alt="9 of diamonds"
                        class="w-full h-auto"
                    />
                </div>
            </div>
        </div>
    </div>
@endsection
