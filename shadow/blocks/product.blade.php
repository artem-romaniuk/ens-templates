<div class="col-lg-12 py-3">
    <div class="card-blog" style="height: 100%; max-width: 100%; padding: 16px 0;">
        <div class="container">
            <div class="row" style="min-height: 200px;">
                <div class="col-lg-3">
                    @if (! empty($product->getFirstMediaUrl('products')))
                        <div class="post-thumb" style="background-image: url('{{ $product->getFirstMediaUrl('products') }}'); background-position: top center; background-size: contain; background-repeat: no-repeat; height: 100%; width: 100%;">
                        </div>
                    @endif
                </div>

                <div class="col-lg-6">
                    <h5 class="post-title">{{ $product->name }}</h5>
                    @if (! empty($product->description))
                        <div>
                            {!! $product->description !!}
                        </div>
                    @endif
                </div>

                <div class="col-lg-3">
                    @php($availableUnits = available_units_by_product_with_cart($product, $cart ?? null))

                    <form id="addToCart{{ $product->id }}" action="{{ route('store.cart.change', $product->id) }}" method="POST">
                        @csrf

                        <div>Price: {{ number_format(auth()->check() ? $product->member_price : $product->price, 2) }} USD</div>
                        <div>Shipping / Handling: {{ number_format($product->shipping(), 2) }} USD</div>
                        <div class="additional-shipping-info" style="display: none;">Additional Item S/H (ea): {{ number_format($product->additionalShippingPerUnit(), 2) }} USD</div>

                        @if ($availableUnits > 0)
                            <select name="quantity">
                                @for ($i = 1; $i <= $availableUnits; $i++)
                                    <option value="{{ $i }}" @if ($i == 1) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>

                            <a href="#" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('addToCart{{ $product->id }}').submit();">
                                Add to Cart
                            </a>
                        @else
                            <div>Out of Stock</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
