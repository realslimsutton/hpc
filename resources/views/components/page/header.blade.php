<header
    id="main-header"
    class="fixed top-0 w-full z-50 border-b border-transparent transition-all"
    x-data="{
        expanded: false,
        onScroll() {
            window.scrollY === 0 ? $refs.header.classList.remove('scrolled') : $refs.header.classList.add('scrolled')
        },
        init() {
            this.onScroll();
        }
    }"
    x-ref="header"
    x-on:scroll.window="onScroll"
    x-on:click.away="expanded = false"
>
    <div class="h-full relative w-full max-w-screen-2xl mx-auto px-6 flex items-center justify-between">
        <div class="h-full">
            <a href="{{ route('home') }}">
                <img src="{{ asset_version('images/transparent-logo.png') }}" alt="Logo" class="h-full w-auto"/>
            </a>
        </div>

        <nav class="hidden lg:flex items-center gap-6 py-5">
            <ul class="flex items-center gap-4">
                <x-page.header.link
                    :href="route('home')"
                    :routes="['home']"
                >
                    Home
                </x-page.header.link>

                <li>
                    <x-page.header.game-menu placement="bottom-center"/>
                </li>

                <x-page.header.link :href="route('home', ['#faq'])">
                    FAQ
                </x-page.header.link>

                <li>
                    <x-page.header.promotions-menu placement="bottom-center"/>
                </li>

                <x-page.header.link
                    :to="route('tracker.index')"
                    :routes="['tracker.index', 'tracker.player', 'tracker.session', 'tracker.location']"
                >
                    Tracker
                </x-page.header.link>

                <x-page.header.link
                    :to="route('contact')"
                    :routes="['contact']"
                >
                    Contact
                </x-page.header.link>
            </ul>

            <div class="h-6 w-px border border-white"></div>

            <ul class="flex items-center gap-4">
                @guest
                    <x-page.header.link
                        :href="route('auth.login')"
                        :routes="['auth.login']"
                    >
                        Login
                    </x-page.header.link>

                    <li>
                        <x-button
                            tag="a"
                            :href="route('auth.register')"
                            size="sm"
                            class="uppercase"
                        >
                            Register
                        </x-button>
                    </li>
                @else
                    <li>
                        <x-page.header.user-menu>
                            <span
                                @class([
                                    'flex items-center justify-center gap-0.5 p-4 lg:p-0 text-white uppercase font-semibold transition-colors hover:text-hpc-gold focu:text-hpc-gold',
                                    '!text-hpc-gold' => in_array(Route::currentRouteName(), [
                                        'member.dashboard'
                                     ])
                                ])
                            >
                                My Account
                            </span>
                        </x-page.header.user-menu>
                    </li>
                @endguest
            </ul>
        </nav>

        <nav class="flex lg:hidden items-center gap-6 py-5">
            <ul class="flex items-center gap-4">
                <li>
                    @guest
                        <x-page.header.guest-menu>
                            @svg('heroicon-o-user-circle', 'h-8 w-8')
                        </x-page.header.guest-menu>
                    @else
                        <x-page.header.user-menu>
                            <span
                                @class([
                                    'flex items-center justify-center gap-0.5 p-4 lg:p-0 text-white uppercase font-semibold transition-colors hover:text-hpc-gold focu:text-hpc-gold',
                                    '!text-hpc-gold' => in_array(Route::currentRouteName(), [
                                        'member.dashboard'
                                     ])
                                ])
                            >
                                @svg('heroicon-o-user-circle', 'h-8 w-8')
                            </span>
                        </x-page.header.user-menu>
                    @endguest
                </li>
                <li>
                    <button
                        class="flex item-center justify-center text-white transition-colors hover:text-hpc-gold"
                        x-on:click.prevent="expanded = !expanded"
                    >
                        @svg('heroicon-o-menu', 'h-8 w-8')
                    </button>
                </li>
            </ul>
        </nav>
    </div>

    <div
        class="lg:hidden"
        x-show="expanded"
        x-collapse
        x-cloak
    >
        <nav class="bg-gray-900">
            <ul>
                <x-page.header.link
                    :href="route('home')"
                    :routes="['home']"
                >
                    Home
                </x-page.header.link>

                <li>
                    <x-page.header.game-menu placement="bottom-center"/>
                </li>

                <x-page.header.link :href="route('home', ['#faq'])">
                    FAQ
                </x-page.header.link>

                <li>
                    <x-page.header.promotions-menu placement="bottom-center"/>
                </li>

                <x-page.header.link
                    :to="route('tracker.index')"
                    :routes="['tracker.index', 'tracker.player', 'tracker.session', 'tracker.location']"
                >
                    Tracker
                </x-page.header.link>

                <x-page.header.link
                    :to="route('contact')"
                    :routes="['contact']"
                >
                    Contact
                </x-page.header.link>
            </ul>
        </nav>
    </div>
</header>
