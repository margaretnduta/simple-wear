@php
    // Optional flash message from newsletter form
    $msg = session('newsletter_status');
@endphp

<footer class="bg-gray-900 text-gray-300 mt-14">
    @if($msg)
        <div class="bg-emerald-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 text-sm">
                {{ $msg }}
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Brand / About + Social --}}
        <div>
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="SimpleWear" class="h-10 w-auto">
                <span class="text-xl font-semibold text-white">SimpleWear</span>
            </div>
            <p class="mt-3 text-sm text-gray-400">
                Quality everyday fashion for men and women. Simple fits, solid prices, fast delivery.
            </p>
            <div class="mt-4 flex items-center gap-3">
                <a href="#" class="hover:text-white" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M22 12.07C22 6.49 17.52 2 12 2S2 6.49 2 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9V12.07h2.54V9.8c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.92h2.78l-.44 2.9h-2.34V22c4.78-.8 8.44-4.94 8.44-9.93z"/></svg>
                </a>
                <a href="#" class="hover:text-white" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm11 2a1 1 0 100 2 1 1 0 000-2zM12 7a5 5 0 100 10 5 5 0 000-10z"/></svg>
                </a>
                <a href="#" class="hover:text-white" aria-label="Twitter/X">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M20.4 3H23l-5.2 6 6 8h-4.7l-3.7-5-4.2 5H1l5.5-6.5L1 3h4.8l3.4 4.7L13.8 3h6.6zM6.7 5.1H4.7l11 14h2l-11-14z"/></svg>
                </a>
            </div>
        </div>

        {{-- Quick Links --}}
        <div>
            <h3 class="text-white font-semibold mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                <li><a href="{{ route('men') }}" class="hover:text-white">Men</a></li>
                <li><a href="{{ route('women') }}" class="hover:text-white">Women</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-white">Cart</a></li>
                @auth
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-white">Your Account</a></li>
                    @if(auth()->user()->is_admin)
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-white">Admin</a></li>
                    @endif
                @endauth
                <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
            </ul>
        </div>

        {{-- Help / Contact --}}
        <div>
            <h3 class="text-white font-semibold mb-3">Help</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                <li><a href="{{ route('shipping') }}" class="hover:text-white">Shipping & Returns</a></li>
                <li><a href="{{ route('privacy') }}" class="hover:text-white">Privacy Policy</a></li>
                <li><a href="{{ route('terms') }}" class="hover:text-white">Terms of Service</a></li>
            </ul>

            <div class="mt-4 text-sm text-gray-400">
                <div>Email: support@simplewear.test</div>
                <div>Phone: +254 700 000 000</div>
                <div>Nairobi, Kenya</div>
            </div>
        </div>

        {{-- Newsletter --}}
        <div>
            <h3 class="text-white font-semibold mb-3">Stay in the loop</h3>
            <p class="text-sm text-gray-400 mb-3">Promos, new drops, and more.</p>

            <form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex gap-2">
                @csrf
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="you@example.com"
                    class="w-full rounded-md border-0 bg-gray-800 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-emerald-600 px-3 py-2"
                >
                <button class="px-4 py-2 rounded-md bg-emerald-600 text-white hover:bg-emerald-500">
                    Subscribe
                </button>
            </form>

            @error('email')
                <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-xs text-gray-400 flex items-center justify-between">
            <div>© {{ date('Y') }} SimpleWear. All rights reserved.</div>
            <div>Built with Laravel & Breeze</div>
        </div>
    </div>
</footer>
