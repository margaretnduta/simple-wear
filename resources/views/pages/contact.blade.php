<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800">Contact Us</h1>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-8">

            <!-- Info card -->
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-gray-900">We’d love to hear from you</h2>
                <p class="mt-2 text-gray-700">Questions, returns, feedback—reach out anytime.</p>

                <div class="mt-4 space-y-2 text-gray-700 text-sm">
                    <div>Email: <a class="underline" href="mailto:support@simplewear.test">support@simplewear.test</a></div>
                    <div>Phone: +254 700 000 000</div>
                    <div>Location: Nairobi, Kenya</div>
                </div>

                <div class="mt-6">
                    <img src="{{ asset('images/contact.jpg') }}" alt="Contact SimpleWear"
                         class="w-full h-56 object-cover rounded-lg border">
                </div>
            </div>

            <!-- Functional form -->
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">Send us a message</h3>

                @if (session('status'))
                    <div class="mt-3 p-2 rounded bg-emerald-100 text-emerald-800 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-3 p-2 rounded bg-red-100 text-red-800 text-sm">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="mt-4 space-y-4" method="POST" action="{{ route('contact.send') }}">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-700">Your Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 w-full rounded-md border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="mt-1 w-full rounded-md border-gray-300"  required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700">Message</label>
                        <textarea rows="5" name="message"
                                  class="mt-1 w-full rounded-md border-gray-300"
                                  placeholder="How can we help?" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 rounded-md bg-gray-900 text-white">Send</button>
                   
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
