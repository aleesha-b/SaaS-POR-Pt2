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
                    <h3 class="font-bold text-gray-700 text-lg mb-4">{{ __("Book Details") }}</h3>
                    @if($errors->any())
                        <div class="bg-red-200 text-red-800 p-2 rounded border-red-800 mb-4">
                            <i class="fa fa-triangle-exclamation text-xl pl-2 pr-4"></i>
                            You have errors in your form submission.
                        </div>
                    @endif
                    <div class="grid grid-cols-4">
                        <p class="">{{ __("Title") }}</p>
                        <p class="p-2 col-span-3">{{ $book->title }}</p>
                        <p class="">{{ __("Author") }}</p>
                        <p class="p-2 col-span-3">{{ $book->author }}</p>
                        <p class="">{{ __("Genre") }}</p>
                        <p class="p-2 col-span-3">{{ $book->genre }}</p>
                        <p class="">{{ __("Sub Genre") }}</p>
                        <p class="p-2 col-span-3">{{ $book->sub_genre }}</p>
                        <p class="">{{ __("Publisher") }}</p>
                        <p class="p-2 col-span-3">{{ $book->publisher }}</p>
                        <p class="">{{ __("Year Published") }}</p>
                        <p class="p-2 col-span-3">{{ $book->year_published }}</p>
                        <p class="">{{ __("Edition") }}</p>
                        <p class="p-2 col-span-3">{{ $book->edition }}</p>
                        <p class="">{{ __("ISBN 10") }}</p>
                        <p class="p-2 col-span-3">{{ $book->isbn_10 }}</p>
                        <p class="">{{ __("ISBN 13") }}</p>
                        <p class="p-2 col-span-3">{{ $book->isbn_13 }}</p>
                        <p class="">{{ __("Height") }}</p>
                        <p class="p-2 col-span-3">{{ $book->height }}</p>
                        <div class=""></div>
                        <form action=""
                              class="mt-6 col-span-3 flex flex-row gap-4">
                            <a href="{{ route('books.index') }}"
                               class="py-2 px-4 mx-2 w-1/6 text-center rounded border border-stone-600
                               hover:bg-stone-600 text-stone-600 hover:text-white transition duration-500">
                                <i class="fa fa-circle-left"></i> {{ __("Back") }}
                            </a>
                            <a href="{{  route('books.edit', compact('book')) }}"
                               class="py-2 px-4 mx-2 w-1/6 text-center rounded border border-sky-600 hover:bg-sky-600
                               text-sky-600 hover:text-white transition duration-500">
                                <i class="fa fa-pen"></i> {{ __("Edit") }}
                            </a>
                            <a href="{{  route('books.delete', compact('book')) }}"
                                    class="py-2 px-4 mx-2 w-1/6 text-center rounded border border-red-600
                                    hover:bg-red-600 text-red-600 hover:text-white transition duration-500">
                                <i class="fa fa-trash"></i> {{ __("Delete") }}
                            </a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
