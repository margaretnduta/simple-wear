<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-6 md:grid-cols-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-3">Order Summary</h3>
                    <ul class="space-y-2 text-sm">
                        @foreach($cart as $item)
                            <li class="flex justify-between">
                                <span>{{ $item['name'] }} × {{ $item['qty'] }}</span>
                                <span>KES {{ number_format($item['price'] * $item['qty'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4 text-right font-bold text-lg">
                        Total: KES {{ number_format($total, 2) }}
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-3">Customer Details</h3>
                    <form method="POST" action="{{ route('checkout.place') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm mb-1">Full Name *</label>
                            <input type="text" name="customer_name" required class="w-full rounded-md border-gray-300 dark:bg-gray-900" value="{{ old('customer_name') }}">
                            @error('customer_name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Email</label>
                            <input type="email" name="email" class="w-full rounded-md border-gray-300 dark:bg-gray-900" value="{{ old('email') }}">
                            @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Phone</label>
                            <input type="text" name="phone" class="w-full rounded-md border-gray-300 dark:bg-gray-900" value="{{ old('phone') }}">
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Address</label>
                            <textarea name="address" rows="3" class="w-full rounded-md border-gray-300 dark:bg-gray-900">{{ old('address') }}</textarea>
                        </div>

                        <div class="text-right pt-2">
                            <button class="px-4 py-2 bg-emerald-600 text-white rounded">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
