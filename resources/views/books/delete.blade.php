<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-bold text-gray-700 text-lg mb-4">
                        {{ __("Delete Book") }}
                    </h3>
                    <div class="grid grid-cols-4">
                        <p class="">{{ __("Title") }}</p>
                        <p class="p-2 col-span-3">
                            {{ $book->title }}
                        </p>
                        <p class="">{{ __("Author/s") }}</p>
                        <p class="p-2 col-span-3">
                            @if(!empty($book->authors))
                                @foreach($book->authors as $author)
                                    {{ $loop->first ? '' : ', ' }}
                                    {{ $author->given_name }} {{ $author->family_name }}
                                @endforeach
                            @else
                                &nbsp;
                            @endif
                            &nbsp;
                        </p>
                        <p class="">{{ __("Genre/s") }}</p>
                        <p class="p-2 col-span-3">
                            @foreach($book->genres as $genre)
                                {{ $loop->first ? '' : ', ' }}
                                {{ $genre->name }}
                            @endforeach
                        </p>
                        <p class="">{{ __("Publisher") }}</p>
                        <p class="p-2 col-span-3">
                            @if(isset($book->publisher))
                                {{ $book->publisher }}
                            @else
                                &nbsp;
                            @endif
                        </p>
                        <p class="">{{ __("Year Published") }}</p>
                        <p class="p-2 col-span-3">
                            @if(isset($book->year_published))
                                {{ $book->year_published }}
                            @else
                                &nbsp;
                            @endif
                        </p>
                        <p class="">{{ __("Edition") }}</p>
                        <p class="p-2 col-span-3">
                            @if(isset($book->edition))
                                {{ $book->edition }}
                            @else
                                &nbsp;
                            @endif
                        </p>
                        <p class="">{{ __("ISBN 10") }}</p>
                        <p class="p-2 col-span-3">
                            @if(isset($book->isbn_10))
                                {{ $book->isbn_10 }}
                            @else
                                &nbsp;
                            @endif
                        </p>
                        <p class="">{{ __("ISBN 13") }}</p>
                        <p class="p-2 col-span-3">
                            @if(isset($book->isbn_13))
                                {{ $book->isbn_13 }}
                            @else
                                &nbsp;
                            @endif
                        </p>
                        <p class="">{{ __("Height") }}</p>
                        <p class="p-2 col-span-3">
                            @if(isset($book->height))
                                {{ $book->height }}
                            @else
                                &nbsp;
                            @endif
                        </p>
                        <div class=""></div>
                        <form action="{{ route('books.destroy', compact(['book'])) }}"
                              method="POST"
                              class="mt-6 col-span-3 flex flex-row gap-4">
                            @csrf
                            @method('delete')
                            <a href="{{ route('books.index') }}"
                               class="py-2 px-4 mx-2 w-1/6 text-center
                                      rounded border border-stone-600
                                      hover:bg-stone-600
                                      text-stone-600 hover:text-white
                                      transition duration-500">
                                <i class="fa fa-circle-left"></i> {{ __("Back") }}
                            </a>

                            <button type="submit"
                                    class="py-2 px-4 mx-2 w-1/6 text-center
                                       rounded border border-red-600
                                       hover:bg-red-600
                                       text-red-600 hover:text-white
                                       transition duration-500">
                                <i class="fa fa-trash"></i> {{ __("Delete") }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
