@extends('layouts.admin')

@section('admin')
    <div>
        <div class="mb-4">
            <a href="{{ route('admin.products.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('admin.back') }}</a>
        </div>
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div>
                <div class="mb-4">
                    <input value="{{ old('title', $product->title) }}" type="text" name="title"
                           class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('admin.title') }}">
                </div>
                <div class="mb-4">
                    <textarea name="description" class="border border-gray-200 p-2 w-1/4">{{ old('description', $product->description) }}
                    </textarea>
                </div>
                <div class="mb-4">
                    <select name="category_id" class="border border-gray-200 p-2 w-1/4">
                        <option disabled selected>{{ __('admin.choose-category') }}</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="file" class="border border-gray-200 p-2 w-1/4 mb-4" multiple name="images[]">
                <div class="mb-4">
                    <input type="submit" value="{{ __('admin.update') }}"
                           class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>

        <div class="grid grid-cols-3">
            @foreach($images as $image)
                <form action="{{ route('admin.image.destroy', $image->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="mb-4 relative w-fit">
                        <img src="{{ asset('storage/' . $image->path) }}" class="border h-150 max-w-xs me-3" style="object-fit: cover">
                        <button type="submit"
                                class="absolute top-2 right-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection
