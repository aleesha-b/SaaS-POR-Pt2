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
                    <h3 class="font-bold text-gray-700 text-lg mb-4">{{ __("Add Book") }}</h3>
                    @if($errors->any())
                        <div class="bg-red-200 text-red-800 p-2 rounded border-red-800 mb-4">
                            <i class="fa fa-triangle-exclamation text-xl pl-2 pr-4"></i>
                            You have errors in your form submission.
                        </div>
                    @endif
                        <form action="{{ route('books.store') }}"
                              class="flex-col gap-4"
                              method="post">

                            @csrf
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Title" class="">{{ __("Title") }}</label>
                                <input type="text"
                                       id="Title" name="title"
                                       value="{{ old('title') }}"
                                       class="p-2 col-span-5">
                                @error('title')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Subtitle" class="">{{ __("Subtitle") }}</label>
                                <input type="text"
                                       id="Subtitle" name="subtitle"
                                       value="{{ old('subtitle') }}"
                                       class="p-2 col-span-5">
                                @error('subtitle')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Authors" class="">{{ __("Author/s") }}</label>
                                <input type="text"
                                       id="Authors" name="authors"
                                       value="{{ old('authors') }}"
                                       class="p-2 col-span-5">
                                @error('authors')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Genres" class="">{{ __("Genre/s") }}</label>
                                <input type="text"
                                       id="Genres" name="genres"
                                       value="{{ old('genres') }}"
                                       class="p-2 col-span-5">
                                @error('genres')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Publisher" class="">{{ __("Publisher") }}</label>
                                <input type="text"
                                       id="Publisher" name="publisher"
                                       value="{{ old('publisher') }}"
                                       class="p-2 col-span-5">
                                @error('publisher')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Year Published" class="">{{ __("Year Published") }}</label>
                                <input type="text"
                                       id="Year Published" name="year_published"
                                       value="{{ old('year_published') }}"
                                       class="p-2 col-span-5">
                                @error('year_published')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Edition" class="">{{ __("Edition") }}</label>
                                <input type="text"
                                       id="Edition" name="edition"
                                       value="{{ old('edition') }}"
                                       class="p-2 col-span-5">
                                @error('edition')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="ISBN 10" class="">{{ __("ISBN 10") }}</label>
                                <input type="text"
                                       id="ISBN 10" name="isbn_10"
                                       value="{{ old('isbn_10') }}"
                                       class="p-2 col-span-5">
                                @error('isbn_10')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="ISBN 13" class="">{{ __("ISBN 13") }}</label>
                                <input type="text"
                                       id="ISBN 13" name="isbn_13"
                                       value="{{ old('isbn_13') }}"
                                       class="p-2 col-span-5">
                                @error('isbn_13')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Height" class="">{{ __("Height") }}</label>
                                <input type="text"
                                       id="Height" name="height"
                                       value="{{ old('height') }}"
                                       class="p-2 col-span-5">
                                @error('height')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-4">
                                <span></span>

                                <div class="mt-6 col-span-5 flex flex-row gap-4 -ml-2">
                                    <a href="{{ route('books.index') }}"
                                       class="py-2 px-4 mx-2 w-1/6 text-center rounded border border-stone-600
                                       hover:bg-stone-600 text-stone-600 hover:text-white transition duration-500">
                                        <i class="fa fa-circle-left"></i> {{ __("Back") }}
                                    </a>

                                    <button type="submit"
                                            class="py-2 px-4 mx-2 w-1/6 text-center rounded border border-emerald-600
                                            hover:bg-emerald-600 text-emerald-600 hover:text-white transition duration-500">
                                        <i class="fa fa-save"></i> {{ __("Save") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
