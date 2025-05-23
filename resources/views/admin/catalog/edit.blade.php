@extends('layouts.admin')

@section('admin')
    <div>
        <div class="mb-4">
            <a href="{{ route('admin.catalogs.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('admin.back') }}</a>
        </div>

        <form action="{{ route('admin.catalogs.update', $catalog->id) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div>
                <div class="mb-4">
                    <input type="text" name="title" class="border border-gray-200 p-2 w-1/4"
                           value="{{ old('title', $catalog->title) }}" placeholder="{{ __('admin.title') }}">
                </div>
                <input type="file" class="border border-gray-200 p-2 w-1/4 mb-4" multiple name="image">
                <div class="mb-4">
                    <input type="submit" value="{{ __('admin.update') }}"
                           class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>

        <div class="grid grid-cols-4">
            <form action="{{ $image ? route('admin.image.destroy', $image->id) : "#" }}" method="post">
                @method('delete')
                @csrf
                <div class="mb-4 relative w-fit">
                    <img src="{{$image ? asset('storage/' . $image->path) : '#' }}" class="border h-150 max-w-xs me-3"
                         style="object-fit: cover">
                    <button type="submit"
                            class="absolute top-2 right-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="{{ $image ? "" : "opacity-0"}} size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
