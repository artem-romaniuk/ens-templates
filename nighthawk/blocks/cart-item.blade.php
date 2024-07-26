<div class="col-lg-12 py-3 entry mb-4">
    <article>
        <div class="container">
            <div class="row" style="min-height: 200px;">
                <div class="col-lg-7">
                    <h5 class="post-title" style="font-size: 1em;">{{ $item->product->name }}</h5>
                    @if (! empty($item->product->description))
                        <div style="font-size: 0.9em;">
                            {!! $item->product->description !!}
                        </div>
                    @endif
                </div>

                <div class="col-lg-1">
                    @php($availableUnits = available_units_by_product_with_cart($item->product, $cart ?? null))

                    <form id="addToCart{{ $item->product->id }}" action="{{ route('store.cart.change', $item->product->id) }}" method="POST">
                        @csrf

                        <select name="quantity" class="form-control-sm" onchange="event.preventDefault(); document.getElementById('addToCart{{ $item->product->id }}').submit();">
                            @for ($i = 1; $i <= ($availableUnits + $item->quantity); $i++)
                                <option value="{{ ($i - $item->quantity) }}" @if ($i == $item->quantity) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                    </form>
                </div>

                <div class="col-lg-4" style="text-align: right;">
                    @php($availableUnits = available_units_by_product_with_cart($item->product, $cart ?? null))

                    <div style="font-size: 0.9em; margin-bottom: 18px;">
                        <div>Price: {{ $item->quantity }} * {{ number_format($item->productPrice(), 2) }} = {{ number_format($item->subtotal(), 2) }} {{ $currency }}</div>

                        @if (\App\Enums\StoreProductChargeType::BASE_SHIPPING_RATE->value != $item->product->charge_type)
                            <div>Shipping / Handling: {{ number_format($item->product->shippingFirstUnit(), 2) }} {{ $currency }}</div>

                            @if ($item->quantity > 1 && $item->product->additionalShippingPerUnit() > 0)
                                <div>Additional Item S/H (ea): {{ $item->quantity - 1 }} * {{ number_format($item->product->additionalShippingPerUnit(), 2) }} = {{ number_format($item->additionalShipping(), 2) }} {{ $currency }}</div>
                            @endif
                        @endif
                    </div>

                    <form id="removeCartItem{{ $item->id }}" action="{{ route('store.cart.item.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a href="#" class="custom-button" onclick="event.preventDefault(); document.getElementById('removeCartItem{{ $item->id }}').submit();">
                            Remove Item
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </article>
</div>
