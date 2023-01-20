<section
    class="relative py-[135px] bg-cover bg-center md:bg-top bg-no-repeat before:absolute before:inset-0 before:bg-hpc-red/80"
    style="background-image: url('{{ asset_version('images/page-banner.jpg') }}')"
>
    <div class="absolute h-[300px] md:h-[100px] bottom-0 inset-x-0 bg-[linear-gradient(to_top,rgba(90,4,16,1),rgba(90,4,16,0))]"></div>

    <div class="flex items-center justify-center relative">
        <h1 class="text-7xl text-white font-bold">
            {{ $slot }}
        </h1>
    </div>
</section>
