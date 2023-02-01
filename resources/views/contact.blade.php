@extends('layouts.base')

@section('body')
    <x-page.banner>
        Contact Us
    </x-page.banner>

    <div class="w-full max-w-screen-2xl mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12">
        <div class="w-full max-w-4xl mx-auto">
            <h2 class="text-2xl text-center">
                We are here to help you 7 days a week and respond within 24 hours. Plus, you can find most answers to
                your questions on the FAQ page.
            </h2>
        </div>

        <div class="w-full grid lg:grid-cols-2 gap-12">
            <div class="flex flex-col justify-center gap-8">
                <h3 class="text-2xl">
                    General Inquiries
                </h3>

                <div class="space-y-6">
                    <x-contact.step :index="1" title="Join our Discord server">
                        <p>
                            We provide exclusive giveaways on our discord server along with 24/7 access to customer
                            support agents!
                        </p>

                        <div>
                            <a href="https://discord.gg/hrpc" class="text-hpc-gold hover:underline">
                                Join the Highroll Poker Community Discord Server!
                            </a>
                        </div>
                    </x-contact.step>

                    <x-contact.step :index="2" title="Message us on Telegram">
                        <p>
                            Our Telegram support staff is online 24/7, ready to help with any questions you may have!
                        </p>

                        <div>
                            <a href="https://t.me/highrollpokerclub" class="text-hpc-gold hover:underline">
                                Highroll Poker Club - Cashier
                            </a>
                        </div>
                    </x-contact.step>

                    <x-contact.step :index="2" title="Find us on Social Media"></x-contact.step>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <iframe
                    src="https://www.youtube.com/embed/3Z0hOY0xNMo?controls=1&rel=0&playsinline=0&modestbranding=0&autoplay=0&enablejsapi=1&origin=https%3A%2F%2Fpokerclub.demowebsitemanager.com&widgetid=1"
                    allow="fullscreen; accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    class="border-0 w-full h-[360px]"
                ></iframe>
            </div>
        </div>
    </div>
@endsection
