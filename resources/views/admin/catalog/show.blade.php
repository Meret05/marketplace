@extends('layouts.admin')

@section('admin')
    <div class="mb-4">
        <a href="{{ route('admin.catalogs.index') }}"
           class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('admin.back') }}</a>
    </div>
    <div class="relative overflow-x-auto mb-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <tbody>
            <tr class="bg-white border-b  border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">ID</td>
                <td class="px-6 py-4">{{ $catalog->id }}</td>
            </tr>
            <tr class="bg-white border-b  border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ __('admin.title') }}</td>
                <td class="px-6 py-4">{{ $catalog->title }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <img src="{{ $image ? asset('storage/' . $image->path) : '#'}}" class="border h-150 max-w-xs mb-2" style="object-fit: cover">
@endsection
