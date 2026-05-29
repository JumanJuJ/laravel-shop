<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        @include('partials.head', ['title' => 'Home'])
    </head>
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
            [
            'name' => 'Prosciutto 4',
            'summary' => 'Il prosciutto è un salume ottenuto dalla coscia del maiale, stagionato e spesso affumicato, apprezzato per il suo sapore ricco e la sua consistenza morbida.',
            'image' => '../../images/product.png',
        ],

    ];
@endphp

<body class="font-sans text-zinc-950 antialiased dark:bg-zinc-950 dark:text-white">

    <div x-data="{ mobileMenuOpen: false, selectedProduct: 0 }" class="min-h-screen">

        @include('partials.header')             

        <main>
            <section id="hero" class="bg-cover bg-center overflow-hidden"
                style="height: calc(100vh - 82px); background-image: url('{{ asset('images/hero.png') }}')">

                <div class="std-container h-full flex flex-col justify-center text-body">
                    <h1 class="text-6xl font-bold">
                        Laravel Shop
                    </h1>
                    <p class="mt-6 text-xl">
                        Build modern <br>
                        ecommerce experiences
                    </p>
                </div>

            </section>

            <section id="products" class="std-padding">
            <div class="wrapper-container">
                    <h2 class="text-3xl font-bold py-2">Our products</h2>
                    <div class="grid grid-cols-[repeat(4,1fr)] gap-2 justify-center">
                        @foreach ($products as $product)
                            <x-product-card :name="$product['name']" :summary="$product['summary']" :image="$product['image']" />
                        @endforeach
                    </div>
                
            </div>
            </section>
        </main>

    </div>

</body>
</html>