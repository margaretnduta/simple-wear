<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order') }} #{{ $order->id }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm underline">Back to Orders</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 md:grid-cols-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-2">Customer</h3>
                    <div><span class="opacity-70">Name:</span> {{ $order->customer_name }}</div>
                    <div><span class="opacity-70">Email:</span> {{ $order->email }}</div>
                    <div><span class="opacity-70">Phone:</span> {{ $order->phone }}</div>
                    <div class="mt-2"><span class="opacity-70">Address:</span><br>{{ $order->address }}</div>
                    <div class="mt-4 font-bold">Total: KES {{ number_format($order->total, 2) }}</div>
                    <div class="mt-2">Placed: {{ $order->created_at->format('Y-m-d H:i') }}</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-2">Status</h3>

                    @if (session('status'))
                        <div class="mb-3 p-2 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="flex items-center gap-2">
                        @csrf
                        <select name="status" class="rounded-md border-gray-300 dark:bg-gray-900">
                            @foreach (['pending','paid','processing','shipped','completed','cancelled'] as $st)
                                <option value="{{ $st }}" {{ $order->status === $st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                        <button class="px-3 py-1 bg-gray-900 text-white rounded">Update</button>
                    </form>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-3">Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-2">Product</th>
                                    <th class="py-2">Price</th>
                                    <th class="py-2">Qty</th>
                                    <th class="py-2">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="py-2">{{ $item->name }}</td>
                                        <td class="py-2">KES {{ number_format($item->price, 2) }}</td>
                                        <td class="py-2">{{ $item->qty }}</td>
                                        <td class="py-2">KES {{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 text-right font-bold">
                        Total: KES {{ number_format($order->total, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
