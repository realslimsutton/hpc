<ul class="divide-y divide-hpc-red-800">
    <x-member.left-sidebar.nav-item
        title="Dashboard"
        href="{{ route('member.dashboard') }}"
        :routes="['member.dashboard']"
    />

    <x-member.left-sidebar.nav-item href="#" title="Deposit History"/>

    <x-member.left-sidebar.nav-item href="#" title="Withdrawal History"/>

    <x-member.left-sidebar.nav-item href="#" title="Loyalty Program"/>

    <x-member.left-sidebar.nav-item href="#" title="Player Bonuses"/>

    <x-member.left-sidebar.nav-item href="#" title="Referral Rewards"/>

    <x-member.left-sidebar.nav-item href="#" title="Giveaways"/>

    <x-member.left-sidebar.nav-item href="#" title="Account Settings" class="rounded-b-xl"/>
</ul>
