@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <p>
            Tournament style is the most popular format to play poker in throughout the world. Tournaments play
            essentially the exact same whether you’re playing a No Limit Holdem tournament or a Pot Limit Omaha
            tournament.
        </p>

        <div class="space-y-2">
            <h3 class="text-xl text-white font-semibold">
                Comparison to Cash Games:
            </h3>

            <p>
                In cash games, players sit down at the table with real money and bet with real money throughout each
                hand.
                However, in tournaments players instead all buy-in for the same amount of money and receive the same
                amount
                of starting chips to play with. The last person standing wins as players battle it out to increase their
                own
                stack size and knock everyone out of the tournament.
            </p>

            <p>
                In cash games, the blind levels stay the exact same. For example, if you sit down at a $1/$2 blind level
                cash game, then the blinds will forever stay at $1/$2.
            </p>

            <p>
                In tournaments, the blind levels increase every 5-10 minutes. The exact time for each blind level is
                dependent on the tournament structure you’re playing in.
            </p>
        </div>

        <div class="space-y-2">
            <h3 class="text-xl text-white font-semibold">
                Late Registration and Rebuy:
            </h3>

            <p>
                Most tournaments offer late registration periods where players who have busted out can buy back in for
                the same exact starting stack that they began the tournament with. However, as the blinds increase it
                becomes increasingly more difficult to battle your way back into a big stack as other players who have
                consistently won chips will be in a better position to win the tournament.
            </p>

            <p>
                Additionally, the late registration period allows for players who have not yet played since the
                beginning of the tournament to get in on the action for a set time window before all future registration
                is no longer accepted.
            </p>
        </div>

        <div class="space-y-2">
            <h3 class="text-xl text-white font-semibold">
                Example:
            </h3>

            <p>
                Player A busts out of a $100 buy-in tournament that had a starting stack size of 50,000 for each player.
                Player A can choose to pay another $100 to get back into the tournament with another 50,000 chips.
            </p>
        </div>
    </div>
@endsection
