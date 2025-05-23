@extends('layouts.layout')

@section('content')

    <div class="container">
        <h2 class="my-4">{{ __('cart.shopping-cart') }}</h2>

        <livewire:cart-list/>

    </div>

@endsection
