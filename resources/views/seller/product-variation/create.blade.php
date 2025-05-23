@extends('layouts.seller')

@section('seller')
    <div>
        <div class="mb-4">
            <a href="{{ route('seller.products.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('seller.back') }}</a>
        </div>
        <form action="{{ route('seller.variations.store', $product->id) }}" method="post">
            @csrf
            <div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-4">
                    <input type="number" name="price" class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('seller.price') }}">
                </div>
                <div class="mb-4">
                    <input type="number" name="quantity" class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('seller.stock') }}">
                </div>
                <div class="mb-4">
                    @foreach($attributes as $attribute)
                        <div class="mb-4">
                            <label for="attribute_{{ $attribute->id }}">{{ $attribute->title }}:</label>
                            <select name="attributes[{{ $attribute->id }}]" id="attribute_{{ $attribute->id }}">
                                <option value=""></option>
                                @foreach($attribute->values as $value)
                                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
                <div class="mb-4">
                    <input type="submit" value="{{ __('seller.add') }}"
                           class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>
    </div>
@endsection
