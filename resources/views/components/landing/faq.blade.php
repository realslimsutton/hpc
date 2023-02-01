<section
    id="faq"
    class="relative py-24 bg-gray-800 text-white text-center text-center lg:text-left"
>
    <div class="w-full max-w-screen-2xl mx-auto px-6 flex flex-col items-center justify-center gap-8">
        <h2 class="text-6xl font-bold">
            Frequently <span class="text-hpc-gold">Asked</span> Questions
        </h2>

        <div
            class="w-full flex flex-col md:flex-row gap-2 md:gap-8"
        >
            <div x-data="{expanded: -1}" class="w-full md:w-1/2 flex flex-col gap-2">
                <x-landing.faq.card :id="0">
                    <x-slot:title>
                        What is a Highroll Poker Club?
                    </x-slot:title>

                    <p>
                        Highroll Poker Club is a thriving community of passionate poker players. We offer highly secure
                        online poker games through the ClubGG app and provide our players with some of the most
                        lucrative rewards programs in today’s industry.
                    </p>
                </x-landing.faq.card>

                <x-landing.faq.card :id="1">
                    <x-slot:title>
                        How do I join the club?
                    </x-slot:title>

                    <p>
                        To join Highroll Poker Club, get in touch with one of our representatives through any of our
                        social media or Telegram @highrollpokerclub.
                    </p>

                    <p>
                        Once you get in touch with our representatives, we’ll get you on the tables in no time! To join
                        our club on the ClubGG app, simply follow the steps in the “Join” section of our website.
                    </p>
                </x-landing.faq.card>

                <x-landing.faq.card :id="2">
                    <x-slot:title>
                        What games do you offer?
                    </x-slot:title>

                    <p>
                        We offer 24/7 access to cash games and tournaments in No-Limit Texas Holdem, Pot-Limit Omaha,
                        and Pot-Limit Omaha 5. The stakes in our cash games range from $0.05/0.10 all the way up to
                        $5/10. We offer around the clock variety for whatever game you’re looking for! Learn more about
                        our game variety in the “<a href="#" class="text-hpc-gold">Games</a>” section on our website.
                    </p>
                </x-landing.faq.card>

                <x-landing.faq.card :id="3">
                    <x-slot:title>
                        What type of rakeback programs do you have for players?
                    </x-slot:title>

                    <p>
                        Our loyalty program allows our players to earn up to 50% rakeback! Rakeback is released on a
                        by-request basis. Additionally, points can be saved up to cash out a higher reward tier.
                    </p>

                    <ul>
                        <li>
                            Bronze Tier – 20.00%
                        </li>

                        <li>
                            Gold Tier – 22.50%
                        </li>

                        <li>
                            Platinum Tier – 27.00%
                        </li>

                        <li>
                            Diamond Tier – 35.00%
                        </li>

                        <li>
                            Highroller – 50.00%
                        </li>
                    </ul>

                    <p>
                        Our first-time deposit bonus match of 100% up to $2,000 also acts as an additional 20% rakeback
                        while active. So realistically, you can potentially earn up to 70% rakeback!
                    </p>

                    <p>
                        Learn more about our promotions and rakeback programs in the “<a href="#" class="text-hpc-gold">Promotions</a>”
                        section on our website.
                    </p>
                </x-landing.faq.card>
            </div>

            <div x-data="{expanded: -1}" class="w-full md:w-1/2 flex flex-col gap-2">
                <x-landing.faq.card :id="0">
                    <x-slot:title>
                        What type of bonuses and promotions do you offer?
                    </x-slot:title>

                    <p>
                        Our first-time deposit bonus match of 100% up to $2,000 is available for all members who choose
                        to deposit with cryptocurrency. For members who instead choose to deposit through other forms of
                        payment, the bonus match is 50% up to $500.
                    </p>

                    <p>
                        Our referral program allows you to passively earn up to 10% of the gross revenues of the members
                        you bring into the club! Payouts are made weekly each Sunday at midnight. Amounts of referral
                        rewards are viewable in the member dashboard on our website.
                    </p>

                    <p>
                        Learn more about our promotions and rakeback programs in the “<a href="#" class="text-hpc-gold">Promotions</a>”
                        section on our website.
                    </p>
                </x-landing.faq.card>

                <x-landing.faq.card :id="1">
                    <x-slot:title>
                        What makes Highroll Poker Club different from the rest?
                    </x-slot:title>

                    <p>
                        We at Highroll Poker Club give back more to our community than any poker club in existence
                        today. Currently, we reinvest about 95% of our club revenue back into our player pool through
                        our referral rewards, rakeback programs, giveaways, and freerolls.
                    </p>

                    <p>
                        Our every intention is for Highroll Poker Club to reshape the poker industry in not only
                        customer service but for what it means to have a poker room that truly cares about the players
                        within it. Learn more about what our club offers in the “<a href="#why-join-our-club"
                                                                                    class="text-hpc-gold">Why Join Our
                            Club?</a>” section on our website.
                    </p>
                </x-landing.faq.card>

                <x-landing.faq.card :id="2">
                    <x-slot:title>
                        Is Highroll Poker Club trustworthy?
                    </x-slot:title>

                    <p>
                        Highroll Poker Club was established in 2021 and has been the longest and oldest private poker
                        game on the ClubGG app (launched in January 2021). We have a dedicated player pool of over 5,000
                        members that have entrusted us with their poker experience over the past 2 years. This is a
                        responsibility that we take very seriously, which is why we consistently review feedback on how
                        we can improve our operations.
                    </p>

                    <p>
                        We are a club that routinely listens to its player pool, which has differentiated us from the
                        rest of our competition, solidifying our position as the most trustworthy poker club online
                        today.
                    </p>
                </x-landing.faq.card>

                <x-landing.faq.card :id="3">
                    <x-slot:title>
                        Why is Highroll Poker Club hosted on ClubGG?
                    </x-slot:title>

                    <p>
                        We decided to host our club on the ClubGG app due to its connection with one of the largest
                        poker sites in the world today, GGPoker. Unlike PokerBros, PPPoker, or Pokerrr2, our app has had
                        millions of dollars invested into security by a well-respected poker site.
                    </p>

                    <p>
                        The RNG (Random Number Generator) of ClubGG is also certified by one of the most rigorous
                        independent third-party auditors in Las Vegas today, BMM Testlabs. This app was designed with
                        legal regulation in mind and surpasses the competition in true fairness in the random
                        distribution of cards.
                    </p>
                </x-landing.faq.card>
            </div>
        </div>
    </div>
</section>
