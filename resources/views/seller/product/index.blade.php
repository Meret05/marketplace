@extends('layouts.seller')

@section('seller')
    <div class="mb-4">
        <a href="{{ route('seller.products.create') }}"
           class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">{{ __('seller.add') }}</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-gray-700 border-b bg-gray-50 ">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">{{ __('seller.title') }}</th>
                <th class="px-6 py-3">{{ __('seller.sku') }}</th>
                <th class="px-6 py-3">{{ __('seller.actions') }}</th>
                <th class="px-6 py-3">{{ __('seller.variations') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $product->id }}</td>
                    <td class="px-6 py-4"><a
                            href="{{ route('seller.products.show', $product->id) }}">{{ $product->title }}</a></td>
                    <td class="px-6 py-4"><a
                            href="{{ route('seller.products.show', $product->id) }}">{{ $product->sku }}</a></td>
                    <td class="px-6 py-4 flex">
                        <a href="{{ route('seller.variations.create', $product->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 mt-1 mr-4 cursor-pointer"
                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </a>
                        <a href="{{ route('seller.products.edit', $product->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor"
                                 class="size-5 mt-1 mr-4 cursor-pointer text-emerald-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                            </svg>
                        </a>
                        <form action="{{ route('seller.products.destroy', $product->id) }}" method="post">
                            @method('delete')
                            @csrf
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-5 mt-1 mr-4 cursor-pointer text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <button class="toggle-button" data-target="variations-{{ $product->id }}">
                            <svg class="w-4 h-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                <tr id="variations-{{ $product->id }}" class="hidden">
                    <td colspan="4" class="px-6 py-4 bg-gray-50">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-gray-700 border-b bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">{{ __('seller.variation-sku') }}</th>
                                <th class="px-4 py-2">{{ __('seller.price') }}</th>
                                <th class="px-4 py-2">{{ __('seller.stock') }}</th>
                                <th class="px-4 py-2">{{ __('seller.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->variations as $variation)
                                <tr class="bg-white border-b border-gray-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $variation->sku }}</td>
                                    <td class="px-6 py-4"><a
                                            href="#">{{ $variation->price }}</a>
                                    </td>
                                    <td class="px-6 py-4"><a
                                            href="#">{{ $variation->quantity }}</a>
                                    </td>
                                    <td class="px-6 py-4 flex">
                                        <form action="{{ route('seller.variations.destroy', $variation->id) }}"
                                              method="post">
                                            @method('delete')
                                            @csrf
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor" class="size-5 cursor-pointer text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buttons = document.querySelectorAll('.toggle-button');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const targetId = button.getAttribute('data-target');
                    const targetRow = document.getElementById(targetId);

                    if (targetRow) {
                        targetRow.classList.toggle('hidden');
                    }
                });
            });
        });
    </script>
@endsection
