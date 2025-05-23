@extends('layouts.admin')

@section('admin')
    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}"
           class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('admin.back') }}</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="mb-4 w-full text-sm text-left rtl:text-right text-gray-500">
            <tbody>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">ID</td>
                <td class="px-6 py-4">{{ $product->id }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ __('admin.title') }}</td>
                <td class="px-6 py-4">{{ $product->title }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ __('admin.sku') }}</td>
                <td class="px-6 py-4">{{ $product->sku }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ __('admin.description') }}</td>
                <td class="px-6 py-4">{{ $product->description }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ __('admin.catalog') }}</td>
                <td class="px-6 py-4">{{ $product->category->catalog->title }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ __('admin.category') }}</td>
                <td class="px-6 py-4">{{ $product->category->title }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ __('admin.store') }}</td>
                <td class="px-6 py-4">{{ $store ? $store->title : 'null' }}</td>
            </tr>
            </tbody>
        </table>
        <div class="grid grid-cols-3">
            @foreach($images as $image)
                <img src="{{ asset('storage/' . $image->path) }}" class="border h-150 max-w-xs mb-2" style="object-fit: cover">
            @endforeach
        </div>
    </div>
@endsection
