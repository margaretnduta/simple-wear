<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('products.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">Add Product</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Men -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-3">Men</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-2">#</th>
                                    <th class="py-2">Name</th>
                                    <th class="py-2">Type</th>
                                    <th class="py-2">Price</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Qty</th>
                                    <th class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($men as $p)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="py-2">{{ $p->id }}</td>
                                        <td class="py-2">{{ $p->name }}</td>
                                        <td class="py-2">{{ $p->type ?? '—' }}</td>
                                        <td class="py-2">KES {{ number_format($p->price, 2) }}</td>
                                        <td class="py-2">
                                            @if($p->stock_qty > 0)
                                                <span class="px-2 py-0.5 rounded text-xs bg-emerald-600 text-white">In stock</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded text-xs bg-red-600 text-white">Out</span>
                                            @endif
                                        </td>
                                        <td class="py-2">{{ $p->stock_qty }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('products.edit', $p) }}" class="px-3 py-1 bg-gray-700 text-white rounded">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="py-4" colspan="7">No products.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Women -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-3">Women</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-2">#</th>
                                    <th class="py-2">Name</th>
                                    <th class="py-2">Type</th>
                                    <th class="py-2">Price</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Qty</th>
                                    <th class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($women as $p)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="py-2">{{ $p->id }}</td>
                                        <td class="py-2">{{ $p->name }}</td>
                                        <td class="py-2">{{ $p->type ?? '—' }}</td>
                                        <td class="py-2">KES {{ number_format($p->price, 2) }}</td>
                                        <td class="py-2">
                                            @if($p->stock_qty > 0)
                                                <span class="px-2 py-0.5 rounded text-xs bg-emerald-600 text-white">In stock</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded text-xs bg-red-600 text-white">Out</span>
                                            @endif
                                        </td>
                                        <td class="py-2">{{ $p->stock_qty }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('products.edit', $p) }}" class="px-3 py-1 bg-gray-700 text-white rounded">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="py-4" colspan="7">No products.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
