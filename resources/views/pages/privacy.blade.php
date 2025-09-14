<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Privacy Policy</h1>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 text-gray-700 dark:text-gray-300">
        <div class="bg-white dark:bg-gray-800 border rounded-xl p-6 space-y-4 text-sm leading-7">
            <p>We respect your privacy. This policy explains what data we collect and how we use it.</p>
            <h2 class="font-semibold">Information we collect</h2>
            <ul class="list-disc ml-5 space-y-1">
                <li>Account info (name, email)</li>
                <li>Order & delivery details</li>
                <li>Usage analytics to improve our services</li>
            </ul>
            <h2 class="font-semibold mt-4">How we use your data</h2>
            <ul class="list-disc ml-5 space-y-1">
                <li>To fulfill orders and provide support</li>
                <li>To send order updates and important notices</li>
                <li>With consent, to send promos (you can opt out)</li>
            </ul>
        </div>
    </div>
</x-app-layout>
