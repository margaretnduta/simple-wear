<x-app-layout>
    {{-- HERO SECTION --}}
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid lg:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
                    SimpleWear — Everyday fashion, simple prices.
                </h1>
                <p class="mt-3 text-gray-600">
                    Clean fits for Men & Women. Essentials that feel good and last longer.
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <a href="{{ route('men') }}" class="px-5 py-3 bg-gray-900 text-white rounded-md hover:bg-gray-800">Shop Men</a>
                    <a href="{{ route('women') }}" class="px-5 py-3 border border-gray-300 rounded-md hover:bg-gray-100">Shop Women</a>
                </div>
            </div>

            {{-- Replace with your own hero image: public/images/hero.jpg --}}
            <div class="rounded-xl overflow-hidden border">
                <img src="{{ asset('images/hero.jpg') }}" alt="SimpleWear Hero" class="w-full h-80 object-cover">
            </div>
        </div>
    </section>

    {{-- CATEGORY CARDS --}}
    <section class="bg-gray-50 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-xl font-semibold text-gray-900">Shop by Category</h2>

            <div class="mt-6 grid sm:grid-cols-2 gap-6">
                <a href="{{ route('men') }}" class="group relative rounded-xl overflow-hidden border bg-white">
                    <img src="{{ asset('images/cat-men.jpg') }}" alt="Men" class="w-full h-56 object-cover group-hover:scale-[1.02] transition">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40"></div>
                    <div class="absolute bottom-0 p-4 text-white font-semibold">Men</div>
                </a>
                <a href="{{ route('women') }}" class="group relative rounded-xl overflow-hidden border bg-white">
                    <img src="{{ asset('images/cat-women.jpg') }}" alt="Women" class="w-full h-56 object-cover group-hover:scale-[1.02] transition">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40"></div>
                    <div class="absolute bottom-0 p-4 text-white font-semibold">Women</div>
                </a>
            </div>

          
        </div>
    </section>

    {{-- LATEST PRODUCTS CAROUSEL (scroll-snap; no JS needed) --}}
    <section class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">Latest Products</h2>
                <div class="text-sm text-gray-500">New drops & recent additions</div>
            </div>

            @if($latest->count() === 0)
                <div class="mt-6 p-6 border rounded-xl text-gray-600">No products yet. Check back soon.</div>
            @else
                <div class="mt-6 relative">
                    <div class="flex gap-5 overflow-x-auto snap-x snap-mandatory pb-2"
                         style="scrollbar-width: thin;">
                        @foreach($latest as $product)
                            <div class="snap-start shrink-0 w-64 bg-white border rounded-xl overflow-hidden">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
                                @endif

                                <div class="p-4">
                                    <div class="text-sm text-gray-500 uppercase">{{ $product->gender === 'men' ? 'Men' : 'Women' }}</div>
                                    <h3 class="font-semibold text-gray-900 line-clamp-1">{{ $product->name }}</h3>
                                    <div class="mt-1 font-bold">KES {{ number_format($product->price, 2) }}</div>

                                    <div class="mt-3 flex items-center justify-between">
                                        @if(auth()->check() && auth()->user()->is_admin)
                                            <a href="{{ route('products.edit', $product) }}" class="text-sm px-3 py-1 rounded-md bg-gray-700 text-white">Edit</a>
                                        @else
                                            <form method="POST" action="{{ route('cart.add', $product) }}" class="flex items-center gap-2">
                                                @csrf
                                                <input type="hidden" name="qty" value="1">
                                                <button type="submit" class="text-sm px-3 py-1 rounded-md bg-emerald-600 text-white hover:bg-emerald-500">
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
        </div>
    </section>

    {{-- ABOUT TEASER --}}
    <section class="bg-gray-50 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid lg:grid-cols-2 gap-8 items-center">
            <div class="bg-white border rounded-xl p-6">
                <h2 class="text-xl font-semibold text-gray-900">About SimpleWear</h2>
                <p class="mt-2 text-gray-700">
                    We keep it simple: timeless essentials, fair prices, fast delivery made for everyday life.
                </p>
                <p class="mt-2 text-gray-700">
                    Based in Kenya, shipping nationwide. Read more about our story.
                </p>
                <a href="{{ route('about') }}" class="mt-4 inline-flex items-center px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">
                    Learn More
                </a>
            </div>

            {{-- Replace with your own image: public/images/about-teaser.jpg --}}
            <div class="rounded-xl overflow-hidden border">
                <img src="{{ asset('images/about.jpg') }}" alt="About SimpleWear" class="w-full h-72 object-cover">
            </div>
        </div>
    </section>

    {{-- NEWSLETTER CTA --}}
    <section class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="rounded-xl bg-gray-900 text-white p-6 sm:p-8 grid lg:grid-cols-2 gap-6 items-center">
                <div>
                    <h3 class="text-xl font-semibold">Stay in the loop</h3>
                    <p class="mt-1 text-gray-200">Promos, new drops, and more—straight to your inbox.</p>
                </div>
                <div>
                    <form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex gap-2">
                        @csrf
                        <input type="email" name="email" required placeholder="you@example.com"
                               class="w-full rounded-md border-0 text-gray-900 px-3 py-2">
                        <button class="px-4 py-2 rounded-md bg-emerald-600 hover:bg-emerald-500">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
