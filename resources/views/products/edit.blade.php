<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- UPDATE FORM (no nested forms!) --}}
                    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm mb-1">Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-900" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Type</label>
                            <input type="text" name="type" value="{{ old('type', $product->type) }}"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-900">
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Gender / Section</label>
                            <select name="gender" class="w-full rounded-md border-gray-300 dark:bg-gray-900" required>
                                <option value="men" {{ old('gender', $product->gender) === 'men' ? 'selected' : '' }}>Men</option>
                                <option value="women" {{ old('gender', $product->gender) === 'women' ? 'selected' : '' }}>Women</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Price (KES)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-900" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Stock Quantity</label>
                            <input type="number" name="stock_qty" min="0" value="{{ old('stock_qty', $product->stock_qty) }}"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-900" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Description</label>
                            <textarea name="description" rows="4" class="w-full rounded-md border-gray-300 dark:bg-gray-900">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Image (optional)</label>
                            @if($product->image_path)
                                <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded mb-2">
                            @endif
                            <input type="file" name="image" accept="image/*" class="w-full">
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md">Update</button>
                            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white rounded-md">Cancel</a>
                        </div>
                    </form>

                    {{-- DELETE FORM (separate, not nested) --}}
                    <div class="mt-4">
                        <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Delete Product</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
