<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        @include('partials.head', ['title' => 'Home'])
    </head>

<body class="font-sans text-zinc-950 antialiased dark:bg-zinc-950 dark:text-white">

    <div x-data="{ mobileMenuOpen: false, selectedProduct: 0 }" class="min-h-screen">

        @include('partials.header')

        <main>
            <section id="description" class="relative">
                <img src="{{ asset('images/about-us.png') }}" alt="About-us Image" class="h-100 w-full object-cover rounded-md" />

                <div class="absolute inset-0 flex flex-col justify-center std-container text-white">
                    <h1 class="text-6xl font-bold">
                        Laravel Shop
                    </h1>
                    <p class="mt-6 text-xl">
                        Siamo un'azienda dedicata alla vendita di prodotti di alta qualità...
                    </p>
                </div>
            </section>

        </main>

    </div>

</body>
</html>