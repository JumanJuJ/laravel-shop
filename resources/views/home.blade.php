@php
    $navItems = [
        ['label' => 'Prodotti', 'href' => '#prodotti'],
        ['label' => 'Servizi', 'href' => '#servizi'],
        ['label' => 'Realizzazioni', 'href' => '#realizzazioni'],
        ['label' => 'Chi siamo', 'href' => '#chi-siamo'],
        ['label' => 'Contatti', 'href' => '#contatti'],
    ];

    $products = [
        [
            'name' => 'Infissi in alluminio',
            'summary' => 'Soluzioni su misura per isolamento, luce naturale e durata nel tempo.',
            'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=80',
            'meta' => 'Casa e professionale',
        ],
        [
            'name' => 'Persiane e oscuranti',
            'summary' => 'Controllo della luce, protezione e stile coerente con la facciata.',
            'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80',
            'meta' => 'Comfort e privacy',
        ],
        [
            'name' => 'Porte e portoni',
            'summary' => 'Ingressi robusti, sicuri e curati nei dettagli per ogni contesto.',
            'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
            'meta' => 'Sicurezza su misura',
        ],
    ];

    $companyImages = [
        [
            'src' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=900&q=80',
            'alt' => 'Persiane installate su una facciata in pietra',
        ],
        [
            'src' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80',
            'alt' => 'Porta di ingresso moderna con finiture curate',
        ],
    ];

    $companyHighlights = [
        [
            'icon' => 'wrench-screwdriver',
            'title' => 'Prodotti e installazioni',
            'text' => 'Una gamma completa di serramenti, oscuranti e porte realizzati con posa precisa e materiali durevoli.',
        ],
        [
            'icon' => 'user-group',
            'title' => 'Servizi e consulenza',
            'text' => "Ogni progetto viene seguito su misura, dalla scelta delle finiture fino all'assistenza dopo la consegna.",
        ],
    ];

    $services = [
        [
            'icon' => 'wrench-screwdriver',
            'title' => 'Installazione',
            'text' => 'Posa precisa e gestione ordinata del cantiere.',
            'color' => 'dark',
        ],
        [
            'icon' => 'sparkles',
            'title' => 'Personalizzazione',
            'text' => 'Finiture, colori e misure progettate intorno agli spazi.',
            'color' => 'blue',
        ],
        [
            'icon' => 'shield-check',
            'title' => 'Assistenza',
            'text' => 'Controlli, manutenzione e supporto dopo la consegna.',
            'color' => 'green',
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        @include('partials.head', ['title' => 'Home'])
    </head>

    <body class="bg-white font-sans text-zinc-950 antialiased dark:bg-zinc-950 dark:text-white">
        {{-- Wrapper generale della pagina: contiene tutto il contenuto visibile e inizializza Alpine.
            mobileMenuOpen gestisce il menu su mobile, selectedProduct gestisce il tab prodotto attivo,
            products rende disponibili a JavaScript i dati definiti sopra in PHP. --}}
        <div x-data="{ mobileMenuOpen: false, selectedProduct: 0, products: @js($products) }" class="min-h-screen">
            {{-- Header fisso in alto: resta sopra il contenuto mentre si scorre la pagina.
                Usa uno sfondo scuro semi-trasparente con blur per rimanere leggibile sul video hero. --}}
            <header class="fixed inset-x-0 top-0 z-50 border-b border-white/15 bg-zinc-950/70 text-white backdrop-blur-xl">
                {{-- Barra superiore dei contatti: area piccola sopra la navbar con indirizzo e telefono. --}}
                <div class="border-b border-white/10">
                    {{-- Contenitore centrato della top bar: limita la larghezza a max-w-7xl e gestisce il layout responsive. --}}
                    <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-2 text-xs text-white/80 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                        <span>Via Roma 12, Parma</span>
                        <a href="tel:+390000000000" class="inline-flex items-center gap-2 hover:text-white">
                            <flux:icon.phone class="size-4" />
                            +39 000 000000
                        </a>
                    </div>
                </div>

                {{-- Navbar principale: logo a sinistra, link centrali su desktop, CTA e bottone menu su mobile. --}}
                <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 lg:px-8" aria-label="Navigazione principale">
                    <a href="{{ route('home') }}" class="text-lg font-semibold tracking-normal">
                        Serramenti Studio
                    </a>

                    {{-- Link di navigazione desktop: nascosti su mobile, visibili da md in su. --}}
                    <div class="hidden items-center gap-8 md:flex">
                        @foreach ($navItems as $item)
                            <a href="{{ $item['href'] }}" class="text-sm text-white/78 transition hover:text-white">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Pulsante di conversione desktop: porta alla sezione contatti/preventivo. --}}
                    <div class="hidden md:block">
                        <flux:button href="#contatti" variant="primary" size="sm">
                            Richiedi preventivo
                        </flux:button>
                    </div>

                    <button
                        type="button"
                        class="inline-flex size-10 items-center justify-center rounded-md border border-white/15 md:hidden"
                        x-on:click="mobileMenuOpen = ! mobileMenuOpen"
                        aria-label="Apri menu"
                    >
                        <flux:icon.bars-3 class="size-5" x-show="! mobileMenuOpen" />
                        <flux:icon.x-mark class="size-5" x-show="mobileMenuOpen" x-cloak />
                    </button>
                </nav>

                {{-- Menu mobile: compare solo quando mobileMenuOpen e true.
                    x-transition aggiunge una piccola animazione, x-cloak evita il flash prima che Alpine parta. --}}
                <div x-show="mobileMenuOpen" x-transition x-cloak class="border-t border-white/10 px-4 pb-4 md:hidden">
                    {{-- Lista verticale dei link mobile: ogni click chiude il menu e porta alla sezione scelta. --}}
                    <div class="grid gap-2">
                        @foreach ($navItems as $item)
                            <a href="{{ $item['href'] }}" x-on:click="mobileMenuOpen = false" class="rounded-md px-3 py-2 text-sm text-white/80 hover:bg-white/10 hover:text-white">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </header>

            <main>
                {{-- Hero: prima sezione della homepage.
                    position relative permette a video, overlay e contenuto di stare nello stesso blocco a livelli diversi. --}}
                <section class="relative min-h-[92vh] overflow-hidden">
                    {{-- Video di sfondo: absolute lo fa coprire tutto il hero, object-cover evita deformazioni.
                        muted e playsinline sono importanti per permettere autoplay anche su mobile. --}}
                    <video
                        class="absolute inset-0 h-full w-full object-cover"
                        autoplay
                        muted
                        loop
                        playsinline
                        poster="https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&w=2200&q=85"
                        aria-label="Video di sfondo con dettagli di serramenti moderni"
                    >
                        <source src="{{ asset('videos/home-hero.mp4') }}" type="video/mp4">
                    </video>
                    {{-- Overlay scuro sopra al video: migliora il contrasto del testo e rende la hero piu leggibile. --}}
                    <div class="absolute inset-0 bg-zinc-950/55"></div>

                    {{-- Contenitore del contenuto hero: relative lo porta sopra video e overlay.
                        min-h uguale alla section, items-end posiziona testo e CTA verso il basso. --}}
                    <div class="relative mx-auto flex min-h-[92vh] max-w-7xl items-end px-4 pb-16 pt-36 sm:pb-20 lg:px-8">
                        {{-- Colonna testo della hero: limita la larghezza del titolo per evitare righe troppo lunghe. --}}
                        <div class="max-w-3xl">
                            <flux:badge class="mb-5 bg-white/12 text-white ring-white/20">
                                Serramenti su misura
                            </flux:badge>

                            <h1 class="max-w-3xl text-4xl font-semibold leading-tight tracking-normal text-white sm:text-6xl">
                                Qualita e design per infissi pensati intorno alla tua casa.
                            </h1>

                            <p class="mt-6 max-w-2xl text-base leading-7 text-white/82 sm:text-lg">
                                Progettiamo, realizziamo e installiamo serramenti, oscuranti e porte con materiali durevoli, finiture curate e assistenza diretta.
                            </p>

                            {{-- Gruppo CTA hero: su mobile i pulsanti sono impilati, da sm diventano affiancati. --}}
                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <flux:button href="#prodotti" variant="primary" icon="arrow-right">
                                    Scopri i prodotti
                                </flux:button>
                                <flux:button href="#contatti" variant="outline" class="border-white/25 bg-white/10 text-white hover:bg-white/15">
                                    Parla con noi
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Sezione azienda: blocco introduttivo subito dopo la hero con immagini, testo e punti chiave. --}}
                <section id="chi-siamo" class="bg-white py-20 text-zinc-950 sm:py-28">
                    <div class="mx-auto grid max-w-7xl gap-10 px-4 lg:grid-cols-[0.95fr_1.05fr] lg:items-start lg:px-8">
                        <div class="grid gap-4 sm:grid-cols-2">
                            @foreach ($companyImages as $image)
                                <img
                                    src="{{ $image['src'] }}"
                                    alt="{{ $image['alt'] }}"
                                    class="aspect-[4/5] w-full rounded-lg object-cover"
                                >
                            @endforeach
                        </div>

                        <div class="lg:pl-4">
                            <p class="text-sm font-semibold uppercase tracking-normal text-blue-700">
                                Chi siamo
                            </p>

                            <h2 class="mt-3 text-4xl font-semibold leading-tight tracking-normal text-blue-950 sm:text-5xl">
                                Serramenti Studio
                            </h2>

                            <div class="mt-5 grid gap-5 text-base leading-7 text-zinc-600">
                                <p>
                                    Da oltre quarant'anni realizziamo e installiamo serramenti in alluminio, porte e oscuranti pensati per durare nel tempo e valorizzare ogni spazio.
                                </p>
                                <p>
                                    Seguiamo ogni cliente con un percorso semplice: ascolto delle esigenze, scelta dei materiali, progettazione su misura e posa curata nei dettagli.
                                </p>
                                <p>
                                    Il nostro obiettivo e offrire prodotti personalizzati, assistenza diretta e un risultato coerente con lo stile della casa o dell'ambiente professionale.
                                </p>
                            </div>

                            <p class="mt-8 text-base text-zinc-700">
                                Ad oggi offriamo:
                            </p>

                            <div class="mt-6 divide-y divide-zinc-200 border-y border-zinc-200">
                                @foreach ($companyHighlights as $highlight)
                                    <div class="grid gap-4 py-5 sm:grid-cols-[2.75rem_1fr]">
                                        <div class="flex size-11 items-center justify-center text-blue-800">
                                            <flux:icon :name="$highlight['icon']" class="size-7" />
                                        </div>

                                        <div>
                                            <h3 class="text-sm font-semibold text-zinc-950">{{ $highlight['title'] }}</h3>
                                            <p class="mt-1 text-sm leading-6 text-zinc-600">
                                                {{ $highlight['text'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-8">
                                <flux:button href="#realizzazioni" variant="primary" icon="arrow-right">
                                    Guarda tutti i lavori eseguiti
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Sezione prodotti: presenta le categorie principali e usa Alpine per cambiare contenuto senza ricaricare pagina. --}}
                <section id="prodotti" class="bg-white py-20 dark:bg-zinc-950 sm:py-28">
                    {{-- Contenitore centrato: mantiene allineamento e padding coerenti con header e hero. --}}
                    <div class="mx-auto max-w-7xl px-4 lg:px-8">
                        {{-- Intestazione della sezione prodotti: testo a sinistra e tab/categorie a destra su desktop. --}}
                        <div class="grid gap-10 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
                            <div>
                                <flux:heading size="xl">Prodotti di eccellenza</flux:heading>
                                <flux:text class="mt-4 max-w-xl text-base leading-7">
                                    Parti da una linea prodotti chiara: poche categorie forti, immagini grandi e testi brevi. Poi ogni card puo portare a una pagina dettaglio.
                                </flux:text>
                            </div>

                            {{-- Tab prodotti: ogni bottone imposta selectedProduct e cambia immagine/testo sotto. --}}
                            <div class="flex flex-wrap gap-2 lg:justify-end">
                                @foreach ($products as $index => $product)
                                    <button
                                        type="button"
                                        x-on:click="selectedProduct = {{ $index }}"
                                        class="rounded-md border px-4 py-2 text-sm transition"
                                        x-bind:class="selectedProduct === {{ $index }} ? 'border-zinc-950 bg-zinc-950 text-white dark:border-white dark:bg-white dark:text-zinc-950' : 'border-zinc-200 text-zinc-700 hover:border-zinc-400 dark:border-zinc-800 dark:text-zinc-300'"
                                    >
                                        {{ $product['name'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Card prodotto attivo: layout a due colonne su desktop, immagine sopra e testo sotto su mobile. --}}
                        <div class="mt-10 grid overflow-hidden rounded-lg border border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900/40 lg:grid-cols-2">
                            {{-- Colonna immagine: Alpine aggiorna src e alt in base al prodotto selezionato. --}}
                            <div class="aspect-[4/3] lg:aspect-auto">
                                <img
                                    x-bind:src="products[selectedProduct].image"
                                    x-bind:alt="products[selectedProduct].name"
                                    class="h-full w-full object-cover"
                                >
                            </div>

                            {{-- Colonna contenuto prodotto: mostra badge, titolo, descrizione e CTA del prodotto attivo. --}}
                            <div class="flex min-h-[360px] flex-col justify-between gap-10 p-6 sm:p-10">
                                <div>
                                    <flux:badge x-text="products[selectedProduct].meta"></flux:badge>
                                    <h2 class="mt-5 text-3xl font-semibold tracking-normal" x-text="products[selectedProduct].name"></h2>
                                    <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-300" x-text="products[selectedProduct].summary"></p>
                                </div>

                                <flux:button href="#contatti" icon="arrow-right" variant="primary" class="w-fit">
                                    Richiedi informazioni
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Sezione chi siamo: alterna immagini e testo per comunicare metodo, esperienza e fiducia. --}}
                <section id="metodo" class="border-y border-zinc-200 bg-zinc-50 py-20 dark:border-zinc-800 dark:bg-zinc-900/45 sm:py-28">
                    {{-- Griglia principale chi siamo: immagini a sinistra e testo a destra su desktop. --}}
                    <div class="mx-auto grid max-w-7xl gap-10 px-4 lg:grid-cols-[0.95fr_1.05fr] lg:items-center lg:px-8">
                        {{-- Collage immagini: due foto verticali sfalsate per dare movimento visivo alla sezione. --}}
                        <div class="grid grid-cols-2 gap-4">
                            <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=900&q=80" alt="Laboratorio artigianale" class="aspect-[4/5] rounded-lg object-cover">
                            <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=900&q=80" alt="Dettaglio progetto casa" class="mt-10 aspect-[4/5] rounded-lg object-cover">
                        </div>

                        {{-- Blocco testo chi siamo: racconta il posizionamento e prepara i numeri sotto. --}}
                        <div>
                            <flux:heading size="xl">Un metodo semplice: ascolto, progetto, posa.</flux:heading>
                            <flux:text class="mt-5 text-base leading-7">
                                La homepage deve far capire subito cosa fai, per chi lo fai e perche fidarsi. Qui puoi raccontare anni di esperienza, materiali, garanzie e attenzione alla posa senza riempire tutto di testo.
                            </flux:text>

                            {{-- Metriche sintetiche: numeri rapidi da leggere per dare credibilita immediata. --}}
                            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                                <div>
                                    <div class="text-3xl font-semibold">40+</div>
                                    <div class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">anni di esperienza</div>
                                </div>
                                <div>
                                    <div class="text-3xl font-semibold">100%</div>
                                    <div class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">su misura</div>
                                </div>
                                <div>
                                    <div class="text-3xl font-semibold">3</div>
                                    <div class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">step chiari</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Sezione servizi: tre card compatte per spiegare cosa fa l'azienda oltre alla vendita del prodotto. --}}
                <section id="servizi" class="bg-white py-20 dark:bg-zinc-950 sm:py-28">
                    {{-- Contenitore servizi: stessa larghezza delle altre sezioni per mantenere ritmo visivo. --}}
                    <div class="mx-auto max-w-7xl px-4 lg:px-8">
                        {{-- Titolo e descrizione servizi: introduce le card senza appesantire la pagina. --}}
                        <div class="max-w-2xl">
                            <flux:heading size="xl">Servizi</flux:heading>
                            <flux:text class="mt-4 text-base leading-7">
                                Tre blocchi bastano per partire: installazione, personalizzazione e assistenza.
                            </flux:text>
                        </div>

                        {{-- Griglia card servizi: una colonna su mobile, tre colonne da md in su. --}}
                        <div class="mt-10 grid gap-4 md:grid-cols-3">
                            @foreach ($services as $service)
                                <x-service-card
                                    :icon="$service['icon']"
                                    :title="$service['title']"
                                    :text="$service['text']"
                                    :color="$service['color'] ?? 'dark'"
                                />
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- Sezione realizzazioni: fascia scura che separa visivamente la pagina e valorizza le immagini. --}}
                <section id="realizzazioni" class="bg-zinc-950 py-20 text-white sm:py-28">
                    {{-- Griglia realizzazioni: testo descrittivo a sinistra, galleria immagini a destra. --}}
                    <div class="mx-auto max-w-7xl px-4 lg:px-8">
                        <div class="grid gap-8 lg:grid-cols-[0.75fr_1.25fr] lg:items-end">
                            {{-- Testo introduttivo alla galleria: spiega cosa rappresentano le immagini. --}}
                            <div>
                                <flux:heading size="xl" class="text-white">Realizzazioni recenti</flux:heading>
                                <p class="mt-4 text-base leading-7 text-white/70">
                                    Una galleria asciutta fa lavorare le immagini. Qui poi puoi collegare casi studio o foto prima/dopo.
                                </p>
                            </div>
                            {{-- Galleria: immagini quadrate in griglia, responsive da due a tre colonne. --}}
                            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                                @foreach ([
                                    'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=700&q=80',
                                    'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=700&q=80',
                                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=700&q=80',
                                ] as $image)
                                    <img src="{{ $image }}" alt="Realizzazione serramenti" class="aspect-square rounded-lg object-cover">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Sezione contatti: CTA finale, pensata per trasformare l'interesse in una chiamata o email. --}}
                <section id="contatti" class="bg-white py-20 dark:bg-zinc-950 sm:py-28">
                    {{-- Contenitore CTA: card larga con testo a sinistra e azioni a destra su desktop. --}}
                    <div class="mx-auto max-w-7xl px-4 lg:px-8">
                        <div class="grid gap-8 rounded-lg border border-zinc-200 p-6 dark:border-zinc-800 sm:p-10 lg:grid-cols-[1fr_auto] lg:items-center">
                            {{-- Testo CTA: chiarisce il prossimo passo per l'utente. --}}
                            <div>
                                <flux:heading size="lg">Vuoi parlare del tuo progetto?</flux:heading>
                                <flux:text class="mt-3 text-base leading-7">
                                    Inserisci qui telefono, email e link alla pagina contatti. Questa e la CTA finale della homepage.
                                </flux:text>
                            </div>
                            {{-- Azioni CTA: pulsanti diretti per telefono ed email. --}}
                            <div class="flex flex-col gap-3 sm:flex-row">
                                <flux:button href="tel:+390000000000" variant="primary" icon="phone">
                                    Chiama ora
                                </flux:button>
                                <flux:button href="mailto:info@example.com" variant="outline" icon="envelope">
                                    Scrivici
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            {{-- Footer: chiusura della pagina con nome azienda e dati essenziali. --}}
            <footer class="border-t border-zinc-200 bg-zinc-50 py-8 text-sm text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900/45 dark:text-zinc-400">
                {{-- Contenitore footer: impila i dati su mobile e li affianca su schermi piu larghi. --}}
                <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <span>Serramenti Studio</span>
                    <span>P.IVA 00000000000 - Parma</span>
                </div>
            </footer>
        </div>

        @fluxScripts
    </body>
</html>
