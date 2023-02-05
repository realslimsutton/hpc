@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <p>
            Most tournaments will only payout the top 12% of players in a scaling payout structure.
        </p>

        <p>
            For example, the payout structure of a $1,000 prize pool tournament with 45 entrants paying out the top
            12.5% of registered players would be:
        </p>

        <table class="w-full text-center">
            <thead>
                <tr>
                    <th>
                        Place
                    </th>

                    <th>
                        % of prize pool
                    </th>

                    <th>
                        Prize awarded
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="py-2">
                        1<sup>st</sup>
                    </td>

                    <td class="py-2">
                        27.99%
                    </td>

                    <td class="py-2">
                        $279.99
                    </td>
                </tr>

                <tr>
                    <td class="py-2">
                        2<sup>nd</sup>
                    </td>

                    <td class="py-2">
                        21.32%
                    </td>

                    <td class="py-2">
                        $213.25
                    </td>
                </tr>

                <tr>
                    <td class="py-2">
                        3<sup>rd</sup>
                    </td>

                    <td class="py-2">
                        16.24%
                    </td>

                    <td class="py-2">
                        $162.42
                    </td>
                </tr>

                <tr>
                    <td class="py-2">
                        4<sup>th</sup>
                    </td>

                    <td class="py-2">
                        12.37%
                    </td>

                    <td class="py-2">
                        $123.71
                    </td>
                </tr>

                <tr>
                    <td class="py-2">
                        5<sup>th</sup>
                    </td>

                    <td class="py-2">
                        9.42%
                    </td>

                    <td class="py-2">
                        $94.21
                    </td>
                </tr>

                <tr>
                    <td class="py-2">
                        6<sup>th</sup>
                    </td>

                    <td class="py-2">
                        7.17%
                    </td>

                    <td class="py-2">
                        $71.76
                    </td>
                </tr>

                <tr>
                    <td class="py-2">
                        7<sup>th</sup>
                    </td>

                    <td class="py-2">
                        5.46%
                    </td>

                    <td class="py-2">
                        $54.47
                    </td>
                </tr>
            </tbody>
        </table>

        <h3 class="text-xl text-white font-semibold">
            Hand-for-Hand Play:
        </h3>

        <p>
            The final few hands before the players make it “in the money” of the payout structure is known as the
            “money bubble”. To ensure fairness for all players on the money bubble, tournaments will have each table
            play hand for hand to make sure that everyone is playing the same amount of hands.
        </p>

        <p>
            Hand for Hand play is used to prevent players from “stalling” in order to make it into payout structure.
            Significant pay jumps in the payout structure make hand for hand play absolutely mandatory for the
            competitive integrity of the poker tournament.
        </p>
    </div>
@endsection
