<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800">About SimpleWear</h1>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-8">
            <!-- Text card -->
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-gray-900">Our Story</h2>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    SimpleWear brings you quality everyday fashion for men and women clean designs,
                    fair prices, and fast delivery. We curate essentials you’ll actually wear.
                </p>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Built in Kenya, loved everywhere. We partner with reliable suppliers and prioritize
                    customer experience from checkout to delivery.
                </p>
            </div>

            <!-- Image card -->
            <div class="bg-white border rounded-xl p-2 shadow-sm">
                {{-- Optional hero image — drop your file at public/images/about-hero.jpg --}}
                <img src="{{ asset('images/about.jpg') }}" alt="About SimpleWear"
                     class="w-full h-72 object-cover rounded-lg">
                
            </div>
        </div>
    </div>
</x-app-layout>
