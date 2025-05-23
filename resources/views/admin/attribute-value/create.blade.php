@extends('layouts.admin')

@section('admin')
    <div>
        <div class="mb-4">
            <a href="{{ route('admin.attribute-values.index') }}"
               class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('admin.back') }}</a>
        </div>
        <form action="{{ route('admin.attribute-values.store') }}" method="POST">
            @csrf
            <div>
                <div class="mb-4">
                    <input type="text" name="value" class="border border-gray-200 p-2 w-1/4" placeholder="{{ __('admin.value') }}">
                </div>
                <div class="mb-4">
                    <select name="attribute_id" class="border border-gray-200 p-2 w-1/4">
                        <option disabled selected>{{ __('admin.choose-attribute') }}</option>
                        @foreach($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <input type="submit" value="{{ __('admin.add') }}"
                           class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">
                </div>
            </div>
        </form>
    </div>
@endsection
