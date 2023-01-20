<section
    id="why-join-our-club"
    class="bg-gray-800 py-12 bg-center bg-cover bg-no-repeat text-white text-center"
    style="background-image: url('{{ asset('images/why-join-our-club-bg.jpg') }}')"
>
    <div class="w-full max-w-screen-2xl mx-auto px-4 flex flex-col items-center justify-center gap-8">
        <h2 class="text-6xl font-bold">
            Why Join Our <span class="text-hpc-gold">Club?</span>
        </h2>

        <div class="space-y-6 text-center">
            <p class="font-medium">
                At Highroll Poker Club, your satisfaction is our top priority!
            </p>

            <p class="font-medium">
                We ensure our customers are entirely satisfied and that their experience is according to their
                expectations.
            </p>
        </div>

        <div class="w-full grid lg:grid-cols-2 gap-8">
            <div class="flex items-center justify-center">
                <iframe
                    src="https://www.youtube.com/embed/3Z0hOY0xNMo?controls=1&rel=0&playsinline=0&modestbranding=0&autoplay=0&enablejsapi=1&origin=https%3A%2F%2Fpokerclub.demowebsitemanager.com&widgetid=1"
                    allow="fullscreen; accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    class="border-0 w-full h-[360px]"
                ></iframe>
            </div>

            <div class="space-y-6">
                <x-landing.why-join-our-club.card icon="heroicon-o-shield-check">
                    <x-slot:title>
                        Secure Poker Games
                    </x-slot:title>

                    <p class="font-medium">
                        At Highroll Poker Club, <span class="text-hpc-gold">your security is what our team relentlessly works for.</span>
                    </p>

                    <p class="font-medium">
                        We operate a <span class="text-hpc-gold">24/7 security floor staff</span> in addition to <span
                            class="text-hpc-gold">GPS, IP, and device detection</span> through the club software.
                    </p>
                </x-landing.why-join-our-club.card>

                <x-landing.why-join-our-club.card icon="heroicon-o-phone-outgoing">
                    <x-slot:title>
                        Efficient 24/7 Customer Service
                    </x-slot:title>

                    <p class="font-medium">
                        Our customer service staff <span class="text-hpc-gold">consists of experienced poker players only.</span>
                    </p>

                    <p class="font-medium">
                        At Highroll Poker Club, our staff are all fellow poker players who will truly understand your
                        concerns.
                    </p>
                </x-landing.why-join-our-club.card>

                <x-landing.why-join-our-club.card icon="heroicon-o-user">
                    <x-slot:title>
                        No More Untrustworthy Agent Networks
                    </x-slot:title>

                    <p class="font-medium">
                        At other poker clubs online, you need to trust your deposit with random independent agents.
                    </p>

                    <p class="font-medium">
                        At Highroll Poker Club, we cut out the middleman and handle all our deposits in-house. Our model
                        creates <span class="text-hpc-gold">consistency</span> in the <span class="text-hpc-gold">security of user deposits</span>
                        through our own <span class="text-hpc-gold">securely configured</span> cold storage vaults and
                        processes.
                    </p>
                </x-landing.why-join-our-club.card>

                <x-landing.why-join-our-club.card icon="heroicon-o-cash">
                    <x-slot:title>
                        Instant Deposits and Withdrawals
                    </x-slot:title>

                    <p class="font-medium">
                        The main reason behind our evolution into becoming <span class="text-hpc gold">one of the most dominant poker clubs</span>
                        online is that we provide the <span class="text-hpc gold">best user experience</span> for our
                        players.
                    </p>

                    <p class="font-medium">
                        Once we're contacted, <span class="text-hpc-gold">we process your deposit/withdrawal requests immediately!</span>
                    </p>
                </x-landing.why-join-our-club.card>
            </div>
        </div>
    </div>
</section>
