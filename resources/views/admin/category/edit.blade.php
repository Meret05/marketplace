@extends('layouts.admin')

@section('admin')
    <div>
        <div class="mb-4">
            <a href="{{ route('admin.categories.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('admin.back') }}</a>
        </div>
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
            @method('patch')
            @csrf
            <div>
                <div class="mb-4">
                    <input type="text" name="title" class="border border-gray-200 p-2 w-1/4" value="{{ old('title', $category->title) }}" placeholder="{{ __('admin.title') }}">
                </div>
                <div class="mb-4">
                    <select name="catalog_id" class="border border-gray-200 p-2 w-1/4">
                        @foreach($catalogs as $catalog)
                            <option
                                value="{{ $catalog->id }}" {{ old('catalog_id', $category->catalog_id) == $catalog->id ? 'selected' : '' }}>
                                {{ $catalog->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <select name="parent_id" class="border border-gray-200 p-2 w-1/4">
                        <option value="{{ null }}">{{ __('admin.choose-category') }}</option>
                        @foreach($categories as $parentCategory)
                            <option value="{{ $parentCategory->id }}" {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                {{ $parentCategory->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <input type="submit" value="{{ __('admin.update') }}" class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>
    </div>
@endsection
