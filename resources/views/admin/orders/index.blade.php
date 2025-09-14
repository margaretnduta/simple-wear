<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Orders') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm underline">Back to Admin</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center gap-2 text-sm">
                <a href="{{ route('admin.orders.index') }}" class="px-2 py-1 rounded {{ $status ? '' : 'bg-gray-900 text-white' }}">All ({{ $counts['all'] }})</a>
                @foreach (['pending','paid','processing','shipped','completed','cancelled'] as $st)
                    <a href="{{ route('admin.orders.index', ['status' => $st]) }}"
                       class="px-2 py-1 rounded {{ $status === $st ? 'bg-gray-900 text-white' : '' }}">
                        {{ ucfirst($st) }} ({{ $counts[$st] }})
                    </a>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-2">ID</th>
                                    <th class="py-2">Customer</th>
                                    <th class="py-2">Phone</th>
                                    <th class="py-2">Total</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Created</th>
                                    <th class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="py-2">#{{ $order->id }}</td>
                                        <td class="py-2">{{ $order->customer_name }} <span class="opacity-70 text-xs">{{ $order->email }}</span></td>
                                        <td class="py-2">{{ $order->phone }}</td>
                                        <td class="py-2">KES {{ number_format($order->total, 2) }}</td>
                                        <td class="py-2 capitalize">{{ $order->status }}</td>
                                        <td class="py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="px-2 py-1 bg-gray-900 text-white rounded">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="py-4" colspan="7">No orders found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
