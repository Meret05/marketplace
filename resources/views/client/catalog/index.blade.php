@extends('layouts.layout')

@section('content')

        <div class="container my-5">
            <header class="mb-4">
                <h3>{{ __('catalog.catalogs') }}</h3>
            </header>

            <div class="row">
                @foreach($catalogs as $catalog)
                    <div class="mb-4" style="width: 14.2rem; height: 11rem;">
                        <a href="{{ route('client.catalogs.show', $catalog->id) }}">
                            <img src="{{ $catalog->image ? asset('storage/' . $catalog->image->path) : '#' }}" class="h-75  rounded-top card-img-top" style="object-fit: cover">
                        <div class="card-body text-center border rounded-bottom bg-white py-1">
                            <a href="#" class="text-decoration-none text-black card-text fw-semibold">{{ $catalog->title }}</a>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
