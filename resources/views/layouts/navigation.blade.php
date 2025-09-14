<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left: Logo -->
            <div class="flex items-center">
                <a href="{{ (auth()->check() && auth()->user()->is_admin) ? route('admin.dashboard') : route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Right: Links + Search -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                {{-- Search (desktop) --}}
                <form method="GET" action="{{ route('search') }}" class="hidden md:flex items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..."
                           class="w-56 rounded-md border-gray-300" />
                    <button class="ml-2 px-3 py-2 text-sm rounded-md bg-gray-900 text-white">Go</button>
                </form>

                @auth
                    @if(auth()->user()->is_admin)
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Admin</x-nav-link>
                        <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">Orders</x-nav-link>
                        <x-nav-link :href="route('products.create')" :active="request()->routeIs('products.create')">Add Product</x-nav-link>
                    @else
                        <!-- Customer links -->
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>

                        <!-- Categories dropdown -->
                        <div class="relative" x-data="{ openCat:false }">
                            <button @click="openCat = !openCat"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                                <span>Categories</span>
                                <svg class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="openCat" @click.away="openCat=false"
                                 class="absolute right-0 mt-2 w-40 bg-white border rounded-md shadow-lg z-[999]">
                                <a href="{{ route('men') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Men</a>
                                <a href="{{ route('women') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Women</a>
                            </div>
                        </div>

                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-nav-link>
                        <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-nav-link>

                        <!-- Cart with badge -->
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                            <span class="inline-flex items-center">
                                <svg class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.01 9h11.24l-1.2 6H8.2l-1.19-6zM6.16 7l-.94-4H3V2h2l1.78 9H18c.46 0 .86.31.97.76l1.76 7.04-.97.24-1.76-7.04H8.2L6.16 7z"/></svg>
                                Cart
                                @if(!empty($cartCount))
                                    <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs bg-emerald-600 text-white">{{ $cartCount }}</span>
                                @endif
                            </span>
                        </x-nav-link>
                    @endif

                    <!-- Account dropdown (ALL logged-in users) -->
                    <div class="relative" x-data="{ openAcc:false }">
                        <button @click="openAcc = !openAcc" class="inline-flex items-center focus:outline-none">
                            <svg class="h-6 w-6 text-gray-700" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8V22h19.2v-2.8c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                            <svg class="ml-1 h-4 w-4 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openAcc" @click.away="openAcc=false"
                             class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-[1000]">
                            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left block px-3 py-2 text-sm hover:bg-gray-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>

                    <!-- Categories dropdown -->
                    <div class="relative" x-data="{ openCat:false }">
                        <button @click="openCat = !openCat"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                            <span>Categories</span>
                            <svg class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openCat" @click.away="openCat=false"
                             class="absolute right-0 mt-2 w-40 bg-white border rounded-md shadow-lg z-[999]">
                            <a href="{{ route('men') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Men</a>
                            <a href="{{ route('women') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Women</a>
                        </div>
                    </div>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-nav-link>

                    <!-- Guest Account dropdown: Login + Register -->
                    <div class="relative" x-data="{ openGuest:false }">
                        <button @click="openGuest = !openGuest" class="inline-flex items-center focus:outline-none">
                            <svg class="h-6 w-6 text-gray-700" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8V22h19.2v-2.8c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                            <svg class="ml-1 h-4 w-4 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openGuest" @click.away="openGuest=false"
                             class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-[1000]">
                             <a href="{{ route('login') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Log in</a>
                             <a href="{{ route('register') }}" class="block px-3 py-2 text-sm hover:bg-gray-50">Register</a>
                        </div>
                    </div>

                    <!-- Cart (no badge count for guests by default) -->
                    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        <span class="inline-flex items-center">
                            <svg class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.01 9h11.24l-1.2 6H8.2l-1.19-6zM6.16 7l-.94-4H3V2h2l1.78 9H18c.46 0 .86.31.97.76l1.76 7.04-.97.24-1.76-7.04H8.2L6.16 7z"/></svg>
                            Cart
                        </span>
                    </x-nav-link>
                @endguest
            </div>

            <!-- Mobile hamburger -->
            <div class="sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                        <path :class="{'hidden': open, 'block': !open }" class="block" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'block': open }" class="hidden" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t">
        {{-- Search (mobile) --}}
        <form method="GET" action="{{ route('search') }}" class="px-4 py-3">
            <div class="flex items-center">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..."
                       class="w-full rounded-md border-gray-300" />
                <button class="ml-2 px-3 py-2 text-sm rounded-md bg-gray-900 text-white">Go</button>
            </div>
        </form>

        <div class="py-3 space-y-1 px-4">
            @auth
                @if(auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Admin</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">Orders</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('products.create')" :active="request()->routeIs('products.create')">Add Product</x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-responsive-nav-link>
                    <div class="px-2 py-1 text-xs text-gray-500">Categories</div>
                    <x-responsive-nav-link :href="route('men')" :active="request()->routeIs('men')">Men</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('women')" :active="request()->routeIs('women')">Women</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        Cart
                        @if(!empty($cartCount))
                            <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs bg-emerald-600 text-white">{{ $cartCount }}</span>
                        @endif
                    </x-responsive-nav-link>
                @endif

                <div class="pt-3 pb-4 border-t">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}"> @csrf
                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-responsive-nav-link>
                <div class="px-2 py-1 text-xs text-gray-500">Categories</div>
                <x-responsive-nav-link :href="route('men')" :active="request()->routeIs('men')">Men</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('women')" :active="request()->routeIs('women')">Women</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-responsive-nav-link>

                <!-- Guest: login + register -->
                <div class="mt-3 space-y-1 border-t pt-3">
                    <x-responsive-nav-link :href="route('login')">Log in</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
                </div>

                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">Cart</x-responsive-nav-link>
            @endguest
        </div>
    </div>
</nav>
