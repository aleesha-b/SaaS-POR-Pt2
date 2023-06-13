<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-lg bg-gray-50 font-semibold">Library Application Administrator Interface</h1>
                    @auth()
                    <p class="bg-gray-50">Welcome to the interface for your library API. Navigate to the books and genres table to view
                        your stored data.</p>
                    @endauth
                    @guest()
                    <p class="bg-gray-50">Welcome to the interface for your library API. Login to access your database.</p>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
