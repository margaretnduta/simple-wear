<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Thank You') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-2">Your order has been placed successfully.</p>
                    <p class="mb-4">Order ID: <span class="font-semibold">{{ $orderId }}</span></p>
                    <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-900 text-white rounded-md">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
