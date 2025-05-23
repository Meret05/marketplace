@extends('layouts.layout')

@section('content')

    <div class="bg-light mt-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach ($breadcrumbs as $crumb)
                        <li class="breadcrumb-item">
                            @if ($crumb instanceof \App\Models\Catalog)
                                <a class="text-decoration-none text-dark-emphasis" href="#">{{ $crumb->title }}</a>
                            @else
                                <a class="text-decoration-none text-dark-emphasis" href="#">{{ $crumb->title }}</a>
                            @endif
                        </li>
                    @endforeach
                    <li class="text-dark-emphasis breadcrumb-item active" aria-current="page">
                        {{ $product->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="pb-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="mb-3 d-flex justify-content-center">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ $previewImage ? asset('storage/' . $previewImage->path) : '#' }}"
                                         style="width: 27rem; height: 27rem;"
                                         class="border fit d-block w-100" alt="...">
                                </div>
                                @foreach($product->images as $image)
                                    <div class="carousel-item">
                                        <img style="width: 27rem; height: 27rem;"
                                             class="border fit d-block w-100"

                                             src="{{ $image ? asset('storage/' . $image->path) : '#' }}"/>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                                    data-bs-slide="prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                     class="bi bi-arrow-left text-black" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                                </svg>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                                    data-bs-slide="next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                     class="bi bi-arrow-right text-black" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        @foreach($product->images as $image)
                            <a data-fslightbox="mygalley" class="border mx-1 me-2" target="_blank"
                               data-type="image"
                               href="{{ asset('storage/' . $image->path) }}"
                               class="item-thumb">
                                <img width="60" height="60" class="rounded-2"
                                     src="{{ asset('storage/' . $image->path) }}"/>
                            </a>
                        @endforeach
                    </div>
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{ $product->title }}
                        </h4>
                        <div class="mb-2">
                            <span class="fw-semibold">{{ __('product.sku') }}: {{ $product->sku }}</span>
                        </div>

                        <label class="mb-1 fw-semibold">{{ __('product.description') }}:</label>
                        <p>
                            {{ $product->description }}
                        </p>

                        <hr/>

                        <div class="mb-4">
                            <div>
                                @if(!empty($attributesArray))
                                    <form method="GET" action="{{ route('client.products.show', $product->id) }}">
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

                                        <button type="submit" class="mt-2 rounded-0 btn btn-outline-dark shadow-0">
                                            {{ __('product.find-variation') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4">
                            <div>
                                @if ($variation && $attributesArray)
                                    <h3>{{ __('product.founded-variation') }}:</h3>
                                    <ul>
                                        @foreach ($variation->combinations as $combo)
                                            <li>{{ $combo->attributeValue->attribute->title }}
                                                : {{ $combo->attributeValue->value }}</li>
                                        @endforeach
                                    </ul>
                                    <p>Цена: {{ number_format($variation->price, 2) }} m</p>

                                    <livewire:add-to-cart :variation="$variation"/>

                                @elseif(count($selectedAttributes))
                                    <p>{{ __('product.not-found') }}</p>
                                @elseif($variations && !$attributesArray)
                                    @foreach($variations as $variation)
                                        <p>{{ __('product.price') }}: {{ number_format($variation->price, 2) }} m</p>

                                        <livewire:add-to-cart :variation="$variation"/>

                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <section class="bg-light border-top">
        <div class="container my-5">
            <header class="mb-4">
                <h3>{{ __('product.similar-products') }}</h3>
            </header>

            <div class="row">
                @foreach($similarProducts as $similarProduct)
                    <div style="width: 14.2rem;">
                        @php
                            $firstImage = $similarProduct->images->first();
                            $similarProduct->minPrice == $similarProduct->maxPrice
                            ? $priceCombine = $similarProduct->minPrice
                            : $priceCombine = $similarProduct->minPrice . '-' . $similarProduct->maxPrice
                        @endphp

                        <a href="{{ route('client.products.show', $similarProduct->id) }}"><img
                                src="{{ $firstImage ? asset('storage/' . $firstImage->path) : '#' }}"
                                class="rounded-top card-img-top"
                                alt="...">
                            <div class="card-body text-center border border-bottom-0 bg-white py-1">
                                <a href="{{ route('client.products.show', $similarProduct->id) }}"
                                   class="text-decoration-none mb-4">
                                    <p class="card-title text-black text-truncate px-2">{{ $similarProduct->title }}</p>
                                </a>
                            </div>
                            <div class="card-body text-center border border-top-0 rounded-bottom bg-white py-1">
                                <a href="#"
                                   class="text-decoration-none text-black card-text fw-semibold">{{ $similarProduct->variations ? $priceCombine : '0' }}
                                    m</a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
