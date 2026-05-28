    @php
    $products = [
        [
            'name' => 'Prosciutto 1',
            'summary' => 'Il prosciutto è un salume ottenuto dalla coscia del maiale, stagionato e spesso affumicato, apprezzato per il suo sapore ricco e la sua consistenza morbida.',
            'image' => '../../images/product.png',
        ],
        [
            'name' => 'Prosciutto 2',
            'summary' => 'Il prosciutto è un salume ottenuto dalla coscia del maiale, stagionato e spesso affumicato, apprezzato per il suo sapore ricco e la sua consistenza morbida.',
            'image' => '../../images/product.png',
        ],
        [
            'name' => 'Prosciutto 3',
            'summary' => 'Il prosciutto è un salume ottenuto dalla coscia del maiale, stagionato e spesso affumicato, apprezzato per il suo sapore ricco e la sua consistenza morbida.',
            'image' => '../../images/product.png',
        ],
    ];
    @endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        @include('partials.head', ['title' => 'Home'])
    </head>

<body class=" font-sans text-zinc-950 antialiased dark:bg-zinc-950 dark:text-white">

    <div x-data="{ mobileMenuOpen: false, selectedProduct: 0 }" class="min-h-screen">

    @include('partials.header')

    <main>
        <section id="hero" class="bg-cover bg-center py-32 rounded-lg overflow-hidden" 
        style="height: calc(100vh - 82px); background-image: url('{{ asset('images/hero.png') }}')"> {{-- css puro --}}

            <div class="mx-auto max-w-4xl pr-423 text-body">

                <h1 class="text-6xl font-bold">
                    Laravel Shop
                </h1>

                <p class="mt-6 text-xl whitespace-nowrap">
                    Build modern <br>
                    ecommerce experiences
                </p>
        </section>

        <section id="products" class="py-16">
            <div class= "mx-auto">
                <h2 class="text-3xl font-bold">Our products</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <x-product-card :name="$product['name']" :summary="$product['summary']" :image="$product['image']" />
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</body>