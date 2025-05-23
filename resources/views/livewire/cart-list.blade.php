<div class="mb-3">
    <table class="table">
        <thead>
        <tr>
            <th>{{ __('cart.product') }}</th>
            <th>{{ __('cart.quantity') }}</th>
            <th>{{ __('cart.price') }}</th>
            <th>{{ __('cart.total-price') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse ($items as $item)
            @php
                $firstImage = $item->variation->product->images->first();
            @endphp
            <tr class="align-middle">
                <td>
                    <a class="text-decoration-none" href="{{ route('client.products.show', $item->variation->product->id) }}" style="height: 15rem;">
                        <img src="{{ $firstImage ? asset('storage/' . $firstImage->path) : '#' }}"
                             class="card-img-top"
                             style="height: 70px; width: 50px; object-fit: contain"/>
                    </a>
                    <a class="text-decoration-none" href="{{ route('client.products.show', $item->variation->product->id) }}">{{ $item->variation->product->title}} | {{ $item->variation->sku}}</a>
                </td>
                <td>
                    <button wire:click="decrement({{ $item->id }})" class="btn btn-sm btn-outline-secondary">-</button>
                    <span class="mx-2">{{ $item->quantity }}</span>
                    <button wire:click="increment({{ $item->id }})" class="btn btn-sm btn-outline-secondary">+</button>
                </td>
                <td>{{ $item->price }} m</td>
                <td>{{ $item->price * $item->quantity }} m</td>
                <td>
                    <button wire:click="remove({{ $item->id }})" class="p-0 border-0 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">{{ __('cart.empty') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    @if($items->isNotEmpty())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5>{{ __('cart.total-price') }}: {{ $this->total }} m</h5>
            <button wire:click="flushCart" class="btn btn-dark">{{ __('cart.clear-cart') }}</button>
        </div>
    @endif


</div>
