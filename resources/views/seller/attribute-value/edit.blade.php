@extends('layouts.seller')

@section('seller')
    <div>
        <div class="mb-4">
            <a href="{{ route('seller.attribute-values.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('seller.back') }}</a>
        </div>
        <form action="{{ route('seller.attribute-values.update', $attributeValue->id) }}" method="POST">
            @method('patch')
            @csrf
            <div>
                <div class="mb-4">
                    <input type="text" value="{{ old('value', $attributeValue->value) }}" name="value" class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('seller.value') }}">
                </div>
                <div class="mb-4">
                    <select name="attribute_id" class="border border-gray-200 p-2 w-1/4">
                        <option disabled selected>{{ __('seller.choose-attribute') }}</option>
                        @foreach($attributes as $attribute)
                            <option
                                value="{{ $attribute->id }}" {{ old('attribute_id', $attributeValue->attribute_id) == $attribute->id ? 'selected' : '' }}>
                                {{ $attribute->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <input type="submit" value="{{ __('seller.update') }}"
                           class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>
    </div>
@endsection
