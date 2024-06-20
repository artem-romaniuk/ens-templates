<div class="col-lg-12 py-3">
    <div class="card-blog" style="height: 100%; max-width: 100%; padding: 16px 0;">
        <div class="container">
            <div class="row" style="min-height: 200px;">
                <div class="col-lg-7">
                    <h5 class="post-title">{{ $item->product->name }}</h5>
                    @if (! empty($item->product->description))
                        <div>
                            {!! $item->product->description !!}
                        </div>
                    @endif
                </div>

                <div class="col-lg-2">
                    @php($availableUnits = available_units_by_product_with_cart($item->product, $cart ?? null))

                    @if (isset($view) && $view == 'cart')
                        <form id="addToCart{{ $item->product->id }}" action="{{ route('store.cart.change', $item->product->id) }}" method="POST">
                            @csrf

                            <select name="quantity" onchange="event.preventDefault(); document.getElementById('addToCart{{ $item->product->id }}').submit();">
                                @for ($i = 1; $i <= ($availableUnits + $item->quantity); $i++)
                                    <option value="{{ ($i - $item->quantity) }}" @if ($i == $item->quantity) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </form>
                    @else
                        <div>{{ $item->quantity }}</div>
                    @endif
                </div>

                <div class="col-lg-3">
                    @php($availableUnits = available_units_by_product_with_cart($item->product, $cart ?? null))

                    <div>Price: {{ $item->quantity }} * {{ number_format($item->productPrice(), 2) }} = {{ number_format($item->subtotal(), 2) }} USD</div>
                    <div>Shipping / Handling: {{ number_format($item->product->shipping(), 2) }} USD</div>

                    @if ($item->quantity > 1 && $item->product->additionalShippingPerUnit() > 0)
                        <div>Additional Item S/H (ea): {{ $item->quantity - 1 }} * {{ number_format($item->product->additionalShippingPerUnit(), 2) }} = {{ number_format($item->additionalShipping(), 2) }} USD</div>
                    @endif

                    @if (isset($view) && $view == 'cart')
                        <form id="removeCartItem{{ $item->id }}" action="{{ route('store.cart.item.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a href="#" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('removeCartItem{{ $item->id }}').submit();">
                                Remove Item
                            </a>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
