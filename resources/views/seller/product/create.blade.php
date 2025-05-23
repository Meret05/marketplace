@extends('layouts.seller')

@section('seller')
    <div>
        <div class="mb-4">
            <a href="{{ route('seller.products.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('seller.back') }}</a>
        </div>
        <form action="{{ route('seller.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="mb-4">
                    <input type="text" name="title" class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('seller.title') }}">
                </div>
                <div class="mb-4">
                    <textarea name="description" class="border border-gray-200 p-2 w-1/4">

                    </textarea>
                </div>
                <div class="mb-4">
                    <select name="category_id" class="border border-gray-200 p-2 w-1/4">
                        <option disabled selected>{{ __('seller.choose-category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="file" class="border border-gray-200 p-2 w-1/4 mb-4" multiple name="images[]">

                <div class="mb-4">
                    <input type="submit" value="{{ __('seller.add') }}"
                           class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>
    </div>
@endsection
