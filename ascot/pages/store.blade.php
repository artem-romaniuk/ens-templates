@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="page-heading-rent-venue" style="
            background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}');
            background-size: cover;
            @if (empty($data['banner'][0]['image']['url'])) padding: 20px 0px !important; @endif">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center"
                        style="
                    @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                    @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <span style="
                        @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                        @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                    {{ $banner['subtitle']['text'] }}
                </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (isset($view) && $view == 'checkout')
        <div class="shows-events-tabs">
            <div class="container">
                <div class="row tickets-page pb-4">
                    <div class="col-lg-12 col-xl-12 ticket-item">
                        <div class="down-content mt-4">
                            <store-checkout-component :payment-methods="{{ json_encode(payment_methods() ?? '{}') }}"></store-checkout-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (isset($view) && $view == 'cart')
        <div class="shows-events-tabs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 tabs-content mt-4">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <a href="{{ route('store.index') }}" class="custom-button button">
                                    Continue Shopping
                                </a>

                                <a href="#" class="custom-button button" onclick="event.preventDefault(); document.getElementById('emptyCart').submit();">
                                    Empty Cart
                                </a>

                                <form id="emptyCart" style="display: none;" action="{{ route('store.cart.empty') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="{{ route('store.index', ['view' => 'checkout']) }}" class="custom-button button">
                                    Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 tabs-content mt-4">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 pb-4">
                                @if (! empty($cart))
                                    <div class="row tickets-page mb-0">
                                        @foreach($cart->items as $item)
                                            @includeIf('themes.' . current_theme() . '.blocks.cart-item', ['item' => $item, 'view' => $view])
                                        @endforeach
                                    </div>

                                    <div style="font-size: 1.1em; font-weight: bold; text-align: right;">
                                        @if ($base_shipping > 0)
                                            Base Shipping Charge: {{ $base_shipping }} {{ $currency }}<br />
                                        @endif
                                        Total Due: {{ number_format($cart->total(), 2) }} {{ $currency }}
                                    </div>
                                @else
                                    <div>Cart is empty</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (isset($view) && $view == 'store')
        <div class="shows-events-tabs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 tabs-content mt-4">
                        <div class="row">
                            <div class="col-lg-12 col-xl-3">
                                <div class="sidebar mb-4">
                                    <div class="row">
                                        <div class="col-lg-12 pb-4">
                                            @if (! empty($cart))
                                                <a href="{{ route('store.index', ['view' => 'cart']) }}">Cart ({{ $cart->items->sum('quantity') }})</a>
                                            @endif
                                        </div>

                                        <div class="col-lg-12">
                                            <form action="{{ route('store.index') }}" class="contact-form" method="get">
                                                <fieldset>
                                                    <input class="form-control search-input mb-1" name="search" type="search" placeholder="Search here" value="{{ request('search') }}">
                                                    @foreach(array_filter(request()->query() ?? []) as $name => $value)
                                                        @continue($name == 'search')
                                                        <input name="{{ $name }}" type="hidden" value="{{ $value }}">
                                                    @endforeach
                                                </fieldset>
                                                <button type="submit" class="button" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                            </form>
                                        </div>

                                        @if (isset($categories) && $categories->isNotEmpty())
                                            <div class="col-lg-12">
                                                <div class="category">
                                                    <h6 class="mb-2">Category</h6>
                                                    <ul>
                                                        @if (! empty($store_settings['set_all_category_option_as']) && $store_settings['set_all_category_option_as'] == \App\Enums\Store\SetAllCategoryOptionAs::FIRST_ENTRY->value)
                                                            <li>
                                                                <a href="{{ route('store.index', array_merge(request()->query(), ['category' => 0, 'page' => 1])) }}" @if (request('category', 0) == 0) class="active" @endif>
                                                                    All Categories
                                                                </a>
                                                            </li>
                                                        @endif

                                                        @foreach($categories as $category)
                                                            <li>
                                                                <a href="{{ route('store.index', array_merge(request()->query(), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>{{ $category->name }} <span>({{ $category->products_count }})</span></a>
                                                            </li>
                                                        @endforeach

                                                        @if (! empty($store_settings['set_all_category_option_as']) && $store_settings['set_all_category_option_as'] == \App\Enums\Store\SetAllCategoryOptionAs::LAST_ENTRY->value)
                                                            <li>
                                                                <a href="{{ route('store.index', array_merge(request()->query(), ['category' => 0, 'page' => 1])) }}" @if (request('category', 0) == 0) class="active" @endif>
                                                                    All Categories
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="widget-box">
                                            <div class="col-lg-12">
                                                <div class="category">
                                                    <h6 class="mb-2">Timeframe</h6>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::ALL_LISTINGS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::ALL_LISTINGS->value) class="active" @endif>
                                                                All Listings
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_1_MONTH->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_1_MONTH->value) class="active" @endif>
                                                                Within 1 month
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_3_MONTHS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_3_MONTHS->value) class="active" @endif>
                                                                Within 3 month
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_6_MONTHS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_6_MONTHS->value) class="active" @endif>
                                                                Within 6 month
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_12_MONTHS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_12_MONTHS->value) class="active" @endif>
                                                                Within 12 month
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                @if (! empty($products))
                                    <div class="row tickets-page mb-0">
                                        @foreach($products as $product)
                                            @includeIf('themes.' . current_theme() . '.blocks.product', ['product' => $product])
                                        @endforeach
                                    </div>

                                    @if ($products->lastPage() > 1)
                                        <div class="col-lg-12">
                                            <div class="pagination mt-2 mb-4">
                                                {{ $products->onEachSide(2)->appends(request()->query())->links('vendor.pagination.ascot') }}
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    @endif
@endsection
