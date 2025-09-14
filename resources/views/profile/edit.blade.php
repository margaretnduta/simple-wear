<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Profile') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 md:grid-cols-2">
            <!-- Profile Info -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-3">Profile Information</h3>

                    @if (session('status'))
                        <div class="mb-3 p-2 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-3 p-2 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="block text-sm mb-1">Name</label>
                            <input type="text" name="name" class="w-full rounded-md border-gray-300 dark:bg-gray-900"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Email</label>
                            <input type="email" name="email" class="w-full rounded-md border-gray-300 dark:bg-gray-900"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="pt-2">
                            <button class="px-4 py-2 bg-gray-900 text-white rounded">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-3">Update Password</h3>

                    <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm mb-1">Current Password</label>
                            <input type="password" name="current_password" class="w-full rounded-md border-gray-300 dark:bg-gray-900" required>
                            @error('current_password') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="block text-sm mb-1">New Password</label>
                            <input type="password" name="password" class="w-full rounded-md border-gray-300 dark:bg-gray-900" required>
                            @error('password') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="w-full rounded-md border-gray-300 dark:bg-gray-900" required>
                        </div>

                        <div class="pt-2">
                            <button class="px-4 py-2 bg-gray-900 text-white rounded">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order History (customers only) -->
            @if(!$user->is_admin)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold mb-3">Your Orders</h3>

                        @if(!$orders || $orders->count() === 0)
                            <div class="opacity-80">No orders yet.</div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th class="py-2">Order #</th>
                                            <th class="py-2">Date</th>
                                            <th class="py-2">Items</th>
                                            <th class="py-2">Total</th>
                                            <th class="py-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                                <td class="py-2">#{{ $order->id }}</td>
                                                <td class="py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                                <td class="py-2">{{ $order->items->sum('qty') }}</td>
                                                <td class="py-2">KES {{ number_format($order->total, 2) }}</td>
                                                <td class="py-2 capitalize">{{ $order->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $orders->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
