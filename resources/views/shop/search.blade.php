<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="font-semibold text-xl text-gray-800">Search</h1>
            <form method="GET" action="{{ route('search') }}" class="hidden sm:flex items-center gap-2">
                <input type="text" name="q" value="{{ old('q', $q) }}" placeholder="Search products..."
                       class="w-64 rounded-md border-gray-300" />
                <button class="px-4 py-2 bg-gray-900 text-white rounded-md">Search</button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($q === '')
                <div class="bg-white border rounded-xl p-6 text-gray-600">
                    Type something to search for products.
                </div>
            @elseif($total === 0)
                <div class="bg-white border rounded-xl p-6 text-gray-600">
                    No results for <span class="font-semibold">“{{ $q }}”</span>.
                </div>
            @else
                <div class="mb-4 text-gray-700">
                    Found <span class="font-semibold">{{ $total }}</span> result{{ $total === 1 ? '' : 's' }} for
                    <span class="font-semibold">“{{ $q }}”</span>.
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white border rounded-xl overflow-hidden">
                            @if($product->image_path)
                                <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
                            @endif

                            <div class="p-4">
                                <div class="text-xs uppercase text-gray-500">{{ $product->gender === 'men' ? 'Men' : 'Women' }}</div>
                                <h3 class="font-semibold text-gray-900 line-clamp-1">{{ $product->name }}</h3>
                                <div class="mt-1 font-bold">KES {{ number_format($product->price, 2) }}</div>

                                <div class="mt-3 flex items-center justify-between">
                                    @if(auth()->check() && auth()->user()->is_admin)
                                        <a href="{{ route('products.edit', $product) }}" class="text-sm px-3 py-1 rounded-md bg-gray-700 text-white">Edit</a>
                                    @else
                                        <form method="POST" action="{{ route('cart.add', $product) }}" class="flex items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="qty" value="1">
                                            <button type="submit" class="text-sm px-3 py-1 rounded-md bg-emerald-600 text-white hover:bg-emerald-500">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @endif
                                </div>
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
