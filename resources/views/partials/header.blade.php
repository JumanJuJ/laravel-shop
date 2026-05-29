{{-- header class="sticky top-0 z-50 mx-auto border-b border-zinc-200 bg-white" STICKY CLASS --}}
<header class=" sticky top-0 z-50 mx-auto border-b border-zinc-200 bg-white">
    <div class="flex items-center justify-between rounded-lg border border-zinc-200 p-4">
        <div class="flex items-center gap-2">  
            {{-- usiamo flex per raggruppare logo e nome del sito --}}
            <img src="{{asset('logos/logo.png')}}" alt="Laravel-Shop Logo" class="size-12" />

            <a href="{{ route('home') }}" class="text-xl font-bold hover-layout">
                <span>Laravel-Shop</span>
            </a>
        </div>

        <nav class="flex items-center">

            <a href="{{ route('about-us') }}" class="flex items-center gap-2 px-4 py-2 font-bold text-zinc-950 hover-layout">

                <span>Chi siamo</span>
                
            </a>
        </nav>

        <nav class="flex items-center">

            <a href="tel:+390000000000" class="flex items-center gap-2 px-4 py-2 font-bold text-zinc-950 hover-layout">
                <flux:icon name="phone" class="size-4" />

                <span>+39 000 000 0000</span>
                
            </a>
        </nav>

    </div>

</header>