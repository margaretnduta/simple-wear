<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gray-900 text-white shadow-sm rounded-lg p-6">
                <div class="text-sm opacity-80">Total Sales</div>
                <div class="text-2xl font-bold mt-1">KES {{ number_format($totalSales, 2) }}</div>
            </div>
            <div class="bg-gray-900 text-white shadow-sm rounded-lg p-6">
                <div class="text-sm opacity-80">All Orders</div>
                <div class="text-2xl font-bold mt-1">{{ $totalOrders }}</div>
            </div>
            <div class="bg-gray-900 text-white shadow-sm rounded-lg p-6">
                <div class="text-sm opacity-80">Pending Orders</div>
                <div class="text-2xl font-bold mt-1">{{ $pendingOrders }}</div>
            </div>
            <div class="bg-gray-900 text-white shadow-sm rounded-lg p-6">
                <div class="text-sm opacity-80">Products</div>
                <div class="text-2xl font-bold mt-1">{{ $productsCount }}</div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">Manage Orders</a>
            <a href="{{ route('products.create') }}" class="ml-3 px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-500">Add Product</a>
            <a href="{{ route('admin.products.index') }}" class="ml-3 px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600">Manage Products</a>
        </div>
    </div>
</x-app-layout>
