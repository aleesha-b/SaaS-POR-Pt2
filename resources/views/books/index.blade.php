<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('books.create') }}"
                       class="rounded mb-10 p-2 bg-emerald-800 text-white text-center w-1/5 min-w-64 hover:bg-emerald-500">
                        Add new Book</a>
                    <p class="m-4"></p>
                    <table class="table w-full">
                        <thead class="border border-stone-300">
                        <tr class="bg-stone-300">
                            <th class="p-2 text-right">#</th>
                            <th class="p-2 text-left">Title</th>
                            <th class="p-2 text-left">Author</th>
                            <th class="p-2 text-left">Genre</th>
                            <th class="p-2 text-left">Publisher</th>
                            <th class="p-2 text-left">ISBN</th>
                            <th class="p-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="border border-stone-300">
                        @foreach($books as $book)
                            <tr class="border-b border-stone-300 hover:bg-stone-200">
                            <td class="p-2 text-right">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $book->title }}</td>
                            <td class="p-2">{{ $book->author }}</td>
                            <td class="p-2">{{ $book->genre }}</td>
                            <td class="p-2">{{ $book->publisher }}</td>
                            <td class="p-2">{{ $book->isbn_10 ?? $book->isbn_13 }}</td>
                            <td class="p-2">
                                <a href="{{ route('books.show', $book->id) }}"
                                   class="px-2 mr-2 w-12 text-center rounded-md border border-sky-600 hover:bg-sky-600
                                   hover:text-white transition duration-500">
                                    <span class="sr-only">Show</span>
                                    <i class="fa fa-circle-right"></i>
                                </a>
                                <a href="{{ route('books.edit', compact('book')) }}"
                                   class="px-2 mr-2 w-12 text-center rounded-md border border-sky-600 hover:bg-sky-600
                                   hover:text-white transition duration-500">
                                    <span class="sr-only">Edit</span>
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="{{ route('books.delete', compact('book')) }}"
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
                                {{ $books->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
