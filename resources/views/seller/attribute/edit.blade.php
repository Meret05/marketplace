@extends('layouts.seller')

@section('seller')
    <div>
        <div class="mb-4">
            <a href="{{ route('seller.attributes.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('seller.back') }}</a>
        </div>
        <form action="{{ route('seller.attributes.update', $attribute->id) }}" method="post">
            @method('patch')
            @csrf
            <div>
                <div class="mb-4">
                    <input value="{{old('title', $attribute->title) }}" type="text" name="title" class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('seller.title') }}">
                </div>
                <div class="mb-4">
                    <input type="submit" value="{{ __('seller.update') }}" class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>
    </div>
@endsection
