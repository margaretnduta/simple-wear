<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Men’s Section
            </h2>
            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('products.create', ['gender' => 'men']) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-md">
                    Add Product
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('status') }}
                </div>
            @endif

            @if($products->count() === 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        No products yet.
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4 text-gray-900 dark:text-gray-100">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-3">
                                @endif

                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                <p class="text-sm opacity-80 mb-2">{{ $product->description }}</p>

                                <p class="font-bold">KES {{ number_format($product->price, 2) }}</p>
                                <p class="text-xs mt-1">
                                    <span class="opacity-70">Type:</span> {{ $product->type ?? '—' }}
                                    •
                                    @if($product->stock_qty > 0)
                                        <span class="text-emerald-600 font-medium">In stock</span>
                                        <span class="opacity-70">({{ $product->stock_qty }})</span>
                                    @else
                                        <span class="text-red-600 font-medium">Out of stock</span>
                                    @endif
                                </p>

                                @if($product->stock_qty > 0)
                                    <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-3 flex items-center gap-2">
                                        @csrf
                                        <input
                                            type="number"
                                            name="qty"
                                            value="1"
                                            min="1"
                                            max="{{ $product->stock_qty }}"
                                            class="w-20 rounded-md border-gray-300 dark:bg-gray-900"
                                        >
                                        <button type="submit" class="px-3 py-1 bg-emerald-600 text-white rounded">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <div class="mt-3 text-sm opacity-70">Unavailable</div>
                                @endif

                                @if(auth()->check() && auth()->user()->is_admin)
                                    <div class="mt-3 flex gap-2">
                                        <a href="{{ route('products.edit', $product) }}" class="px-3 py-1 bg-gray-700 text-white rounded">Edit</a>
                                        <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
