@extends('layouts.layout')

@section('content')

    <section>
        <div class="container my-5">
            <header class="mb-4">
                <h3>{{ $catalog->title }}</h3>
            </header>

            <div class="row">
                <div class="border bg-white rounded col">
                    <div class="mb-3 mt-2">
                        <form>
                            <div class="form-label">{{ __('filter.choose-category') }}</div>
                            <select name="category_id[]" multiple class="form-select form-select-sm select2"
                                    aria-label=".form-select-sm example">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            @if (request()->has('category_id') && in_array($category->id, (array) request()->category_id))
                                                selected
                                        @endif>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-3 form-label">{{ __('filter.choose-store') }}</div>
                            <select name="store_id[]" multiple class="form-select form-select-sm select2"
                                    aria-label=".form-select-sm example">
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}"
                                            @if (request()->has('store_id') && in_array($store->id, (array) request()->store_id))
                                                selected
                                        @endif>
                                        {{ $store->title }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="price_min" class="mt-3 form-label">{{ __('filter.price-from') }}</label>
                            <input
                                type="number"
                                name="price_range[min]"
                                id="price_min"
                                class="form-control form-control-sm"
                                min="0"
                                step="0.01"
                                placeholder="{{ __('filter.min-price') }}"
                                value="{{ request('price_range.min') }}"
                            >
                            <label for="price_max" class="mt-3 form-label">{{ __('filter.price-to') }}</label>
                            <input
                                type="number"
                                name="price_range[max]"
                                id="price_max"
                                class="form-control form-control-sm"
                                min="0"
                                step="0.01"
                                placeholder="{{ __('filter.max-price') }}"
                                value="{{ request('price_range.max') }}"
                            >
                            <label for="sort_price" class="mt-3 form-label">{{ __('filter.sorting-by-price') }}</label>
                            <select name="sort_price" id="sort_price" class="form-select form-select-sm">
                                <option value=""
                                        @if(!request('sort_price')) selected @endif>{{ __('filter.not-sorting') }}</option>
                                <option value="asc"
                                        @if(request('sort_price') === 'asc') selected @endif>{{ __('filter.from-low-to-high') }}</option>
                                <option value="desc"
                                        @if(request('sort_price') === 'desc') selected @endif>{{ __('filter.from-high-to-low') }}</option>
                            </select>
                            <div class="mt-3 flex">
                                <button type="submit" class="btn btn-primary">{{ __('filter.apply') }}</button>
                                <a href="{{ route(Route::currentRouteName(), ['catalog' => $catalog->id]) }}"
                                   class="btn btn-outline-secondary">{{ __('filter.clean') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-9">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                                <div class="card w-100 my-2 shadow-2-strong rounded-0">

                                    @php
                                        $firstImage = $product->images->first();
                                        $product->minPrice == $product->maxPrice
                                        ? $priceCombine = $product->minPrice
                                        : $priceCombine = $product->minPrice . '-' . $product->maxPrice;
                                        $attributes = $product->usedAttributesWithValues();
                                $attributesArray = $attributes->toArray();
                                    @endphp

                                    <a class=" " href="{{ route('client.products.show', $product->id) }}"
                                       style="height: 15rem;">
                                        <img src="{{ $firstImage ? asset('storage/' . $firstImage->path) : '#' }}"
                                             class="card-img-top"
                                             style="height: 100%; object-fit: contain"/>
                                    </a>

                                    <div class="card-body d-flex flex-column">
                                        <a href="{{ route('client.products.show', $product->id) }}"
                                           class="text-decoration-none mb-4">
                                            <p class="card-title text-black text-truncate">{{ $product->title }}</p>
                                        </a>
                                        <p class="card-text fw-bolder ">{{ $product->variations ? $priceCombine : '0' }}
                                            m</p>
                                        @if($product->variations && !$attributesArray)
                                            @foreach($product->variations as $variation)
                                                <div class="d-flex align-items-center px-0 pb-0 mt-auto">
                                                    <livewire:add-to-cart :variation="$variation"/>
                                                </div>
                                            @endforeach

                                        @elseif($product->variations && $attributesArray)
                                            <div class="mb-3 d-flex align-items-center">
                                                <div class="d-flex">
                                                    <button type="button"
                                                            class="me-3 rounded-0 btn shadow-0 btn-outline-dark"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $product->id }}">
                                                        {{ __('product.add-to-cart') }}
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $product->id }}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel{{ $product->id }}"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="exampleModalLabel{{ $product->id }}">{{ $product->title }}</h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="GET"
                                                                  action="{{ route('client.products.show', $product->id) }}">
                                                                @foreach ($attributes as $attribute)
                                                                    <label>{{ $attribute->title }}</label>
                                                                    <select class="form-select w-50 mb-2"
                                                                            name="attributes[{{ $attribute->id }}]">
                                                                        <option value=""></option>
                                                                        @foreach ($attribute->values as $value)
                                                                            <option value="{{ $value->id }}"
                                                                                {{ (request()->input("attributes.{$attribute->id}") == $value->id) ? 'selected' : '' }}>
                                                                                {{ $value->value }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                            class="mt-2 rounded-0 btn btn-outline-dark shadow-0">
                                                                        {{ __('product.find-variation') }}
                                                                    </button>
                                                                    <button type="button"
                                                                            class="mt-2 rounded-0 btn btn-dark shadow-0"
                                                                            data-bs-dismiss="modal">
                                                                        {{ __('product.close') }}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

