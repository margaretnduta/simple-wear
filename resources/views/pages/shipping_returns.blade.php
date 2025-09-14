<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Shipping & Returns</h1>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-gray-800 border rounded-xl p-6">
            <h2 class="text-lg font-semibold">Shipping</h2>
            <ul class="mt-3 list-disc ml-5 text-gray-700 dark:text-gray-300 space-y-2 text-sm">
                <li>Orders dispatch within 24–48 hours (Mon–Sat).</li>
                <li>Delivery in Nairobi: 1–2 days. Other regions: 2–5 days.</li>
                <li>Free shipping on orders above KES 5,000.</li>
            </ul>
        </div>
        <div class="bg-white dark:bg-gray-800 border rounded-xl p-6">
            <h2 class="text-lg font-semibold">Returns</h2>
            <ul class="mt-3 list-disc ml-5 text-gray-700 dark:text-gray-300 space-y-2 text-sm">
                <li>30-day return policy for unworn items with tags.</li>
                <li>Initiate returns via <a href="{{ route('contact') }}" class="underline">Contact Us</a>.</li>
                <li>Refunds processed to original payment method in 3–7 business days.</li>
            </ul>
        </div>
    </div>
</x-app-layout>
