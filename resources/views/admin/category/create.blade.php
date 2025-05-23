@extends('layouts.admin')

@section('admin')
    <div>
        <div class="mb-4">
            <a href="{{ route('admin.categories.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('admin.back') }}</a>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div>
                <div class="mb-4">
                    <input type="text" name="title" class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('admin.title') }}">
                </div>
                <div class="mb-4">
                    <select name="catalog_id" class="border border-gray-200 p-2 w-1/4">
                        <option disabled selected>{{ __('admin.choose-catalog') }}</option>
                        @foreach($catalogs as $catalog)
                            <option value="{{ $catalog->id }}">{{ $catalog->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <select name="parent_id" class="border border-gray-200 p-2 w-1/4">
                        <option disabled selected>{{ __('admin.choose-category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <input type="submit" value="{{ __('admin.add') }}" class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>
    </div>
@endsection
