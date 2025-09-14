<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            @if (empty($cart))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Your cart is empty.
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-2">Product</th>
                                        <th class="py-2">Price</th>
                                        <th class="py-2">Qty</th>
                                        <th class="py-2">Subtotal</th>
                                        <th class="py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $productId => $item)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-2">
                                                <div class="flex items-center gap-3">
                                                    @if($item['image'])
                                                        <img src="{{ asset('storage/'.$item['image']) }}" class="w-16 h-16 object-cover rounded" alt="">
                                                    @endif
                                                    <div>
                                                        <div class="font-semibold">{{ $item['name'] }}</div>
                                                        <div class="text-xs opacity-70 capitalize">{{ $item['gender'] }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-2">KES {{ number_format($item['price'], 2) }}</td>
                                            <td class="py-2">
                                                <form method="POST" action="{{ route('cart.update', $productId) }}" class="flex items-center gap-2">
                                                    @csrf
                                                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                                           class="w-20 rounded-md border-gray-300 dark:bg-gray-900">
                                                    <button class="px-2 py-1 bg-gray-700 text-white rounded">Update</button>
                                                </form>
                                            </td>
                                            <td class="py-2">KES {{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                            <td class="py-2">
                                                <form method="POST" action="{{ route('cart.remove', $productId) }}" onsubmit="return confirm('Remove this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="px-2 py-1 bg-red-600 text-white rounded">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Clear entire cart?');">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded">Clear Cart</button>
                            </form>
                            <div class="text-xl font-bold">Total: KES {{ number_format($total, 2) }}</div>
                        </div>

                        <div class="mt-6 text-right">
                            <a href="{{ route('checkout.show') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
