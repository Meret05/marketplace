<div class="mb-3 d-flex align-items-center">
    <div class="d-flex">
        <button wire:click="addToCart({{ $variation->id }})"
                class="me-3 rounded-0 btn shadow-0 {{ $justAddedVariationId === $variation->id ? 'btn-success' : 'btn-outline-dark' }}">
            {{ __('product.add-to-cart') }}
        </button>
    </div>
</div>
