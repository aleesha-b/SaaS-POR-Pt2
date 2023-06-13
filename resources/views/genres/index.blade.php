<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('genres.create') }}"
                       class="rounded mb-10 p-2 bg-emerald-800 text-white text-center w-1/5 min-w-64 hover:bg-emerald-500">
                        Add new Genre</a>
                    <p class="m-4"></p>
                    <table class="table w-full">
                        <thead class="border border-stone-300">
                        <tr class="bg-stone-300">
                            <th class="p-2 text-right">#</th>
                            <th class="p-2 text-left">Genre</th>
                            <th class="p-2 text-left">Description</th>
                            <th class="p-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="border border-stone-300">
                        @foreach($genres as $genre)
                            <tr class="border-b border-stone-300 hover:bg-stone-200">
                            <td class="p-2 text-right">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $genre->name }}</td>
                            <td class="p-2">{{ $genre->description }}</td>
                            <td class="p-2">
                                <a href="{{ route('genres.edit', compact('genre')) }}"
                                   class="px-2 mr-2 w-12 text-center rounded-md border border-sky-600 hover:bg-sky-600
                                   hover:text-white transition duration-500">
                                    <span class="sr-only">Edit</span>
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="{{ route('genres.delete', compact('genre')) }}"
                                   class="px-2 w-12 text-center rounded-md border border-red-600 hover:bg-red-500
                                   hover:text-white transition duration-500">
                                    <span class="sr-only">Delete</span>
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="border border-stone-300">
                        <tr>
                            <td colspan="5" class="p-2">
                                {{ $genres->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
