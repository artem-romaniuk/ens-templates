<div class="col-lg-12 mb-2 ticket-item">
        <div class="down-content" style="height: 100%; max-width: 100%; padding: 16px 0;">
            <div class="container">
                <div class="row" style="min-height: 200px;">
                    <div class="col-lg-8 position-relative">
                        @if (! empty($store_settings['days_mark_item_as_new']) && $product->created_at > now()->subDays((int) $store_settings['days_mark_item_as_new']))
                            <div style="background: #6C55F9;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
                        @endif

                        <h5 class="post-title" style="font-size: 1em;">{{ $product->name }}</h5>
                        @if (! empty($product->description))
                            <div style="font-size: 0.9em;">
                                {!! $product->description !!}
                            </div>
                        @endif

                        @if (! empty($store_settings['display_item_updated_at']))
                            <div style="font-size: 0.8em;">{{ $product->updated_at?->format('m/d/Y') ?? '' }}</div>
                        @endif
                    </div>

                    <div class="col-lg-4" style="text-align: right;">
                        @if (! empty($product->getFirstMediaUrl('products')))
                            <img src="{{ $product->getFirstMediaUrl('products') }}" style="max-width: 200px; margin-bottom: 16px;">
    {{--                        <div class="post-thumb" style="background-image: url('{{ $product->getFirstMediaUrl('products') }}'); background-position: top center; background-size: contain; background-repeat: no-repeat; max-height: 300px; height: 100%; width: 100%;">--}}
    {{--                        </div>--}}
                        @endif

                        @php($availableUnits = available_units_by_product_with_cart($product, $cart ?? null))

                        <form id="addToCart{{ $product->id }}" action="{{ route('store.cart.change', $product->id) }}" method="POST">
                            @csrf

                            <div style="font-size: 0.9em; margin-bottom: 16px;">
                                <div>Price: {{ number_format(auth()->check() ? $product->member_price : $product->price, 2) }} {{ $currency }}</div>

                                @if (\App\Enums\StoreProductChargeType::BASE_SHIPPING_RATE->value != $product->charge_type)
                                    <div>Shipping / Handling: {{ number_format($product->shippingFirstUnit(), 2) }} {{ $currency }}</div>
                                    <div class="additional-shipping-info" style="display: none;">Additional Item S/H (ea): {{ number_format($product->additionalShippingPerUnit(), 2) }} {{ $currency }}</div>
                                @endif
                            </div>

                            @if ($availableUnits > 0)
                                <select class="form-control-sm" name="quantity" style="margin: 6px 0; display: inline;">
                                    @for ($i = 1; $i <= $availableUnits; $i++)
                                        <option value="{{ $i }}" @if ($i == 1) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>

                                <a href="#" class="custom-button button" onclick="event.preventDefault(); document.getElementById('addToCart{{ $product->id }}').submit();">
                                    Add to Cart
                                </a>
                            @else
                                <div style="color: #660000">Out of Stock</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

