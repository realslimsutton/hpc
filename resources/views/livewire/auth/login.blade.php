<form wire:submit.prevent="save" class="w-full my-20 mt-0 md:mt-20 space-y-8">
    <div class="flex items-center justify-center text-center">
        <h3 class="my-6 text-white font-semibold text-xl">
            Sign into your account
        </h3>
    </div>

    {{ $this->form }}

    <div>
        <x-button type="submit" class="flex justify-center w-full" wire:loading.attr="disabled">
            Login
        </x-button>
    </div>
</form>
