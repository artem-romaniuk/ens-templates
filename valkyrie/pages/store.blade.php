@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <section class="bg-success @if($data['banner'][0]['image']['url']) py-5 @endif" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); background-size: cover;">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row align-items-center py-{{ $data['banner'][0]['image']['url'] ? 5 : 4 }}">
                <div class="col-md-12 text-white">
                    <h1 style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h1>

                    @if (! empty($banner['subtitle']['text']))
                        <h3 style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </h3>
                    @endif
                </div>
            </div>
        </div>
    </section>

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
                                <a href="{{ route('store.index') }}" class="custom-button btn btn-success">
                                    Continue Shopping
                                </a>

                                <a href="#" class="custom-button btn btn-success" onclick="event.preventDefault(); document.getElementById('emptyCart').submit();">
                                    Empty Cart
                                </a>

                                <form id="emptyCart" style="display: none;" action="{{ route('store.cart.empty') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="{{ route('store.index', ['view' => 'checkout']) }}" class="custom-button btn btn-success">
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
                            <div class="col-lg-3">
                                <div class="sidebar mb-4">
                                    <div class="row">
                                        @if (! empty($cart))
                                            <div class="col-lg-12 pb-4">
                                                <a class="text-decoration-none" style="color: #000000;" href="{{ route('store.index', ['view' => 'cart']) }}">Cart ({{ $cart->items->sum('quantity') }})</a>
                                            </div>
                                        @endif

                                        <div class="col-lg-12 mb-4">
                                            <form action="{{ route('store.index') }}" class="contact-form" method="get">
                                                <fieldset>
                                                    <input type="text" name="search" class="form-control mb-2" placeholder="Enter keyword.." value="{{ request('search') }}">
                                                </fieldset>
                                                <button type="submit" class="btn btn-success" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                            </form>
                                        </div>

                                        @if (isset($categories) && $categories->isNotEmpty())
                                            <div class="col-lg-12">
                                                <div class="category">
                                                    <h6 class="h2 mb-2">Category</h6>
                                                    <ul class="list-unstyled pl-3">
                                                        @if (! empty($store_settings['set_all_category_option_as']) && $store_settings['set_all_category_option_as'] == \App\Enums\Store\SetAllCategoryOptionAs::FIRST_ENTRY->value)
                                                            <li class="mb-1">
                                                                <a class="text-decoration-none" href="{{ route('store.index', array_merge(request()->query(), ['category' => 0, 'page' => 1])) }}" @if (request('category', 0) == 0) class="active" @endif>
                                                                    All Categories
                                                                </a>
                                                            </li>
                                                        @endif

                                                        @foreach($categories as $category)
                                                            <li class="mb-1">
                                                                <a class="text-decoration-none" href="{{ route('store.index', array_merge(request()->query(), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>{{ $category->name }} <span>({{ $category->products_count }})</span></a>
                                                            </li>
                                                        @endforeach

                                                        @if (! empty($store_settings['set_all_category_option_as']) && $store_settings['set_all_category_option_as'] == \App\Enums\Store\SetAllCategoryOptionAs::LAST_ENTRY->value)
                                                            <li class="mb-1">
                                                                <a class="text-decoration-none" href="{{ route('store.index', array_merge(request()->query(), ['category' => 0, 'page' => 1])) }}" @if (request('category', 0) == 0) class="active" @endif>
                                                                    All Categories
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="h2 mb-2">Timeframe</h6>
                                                <ul class="list-unstyled pl-3">
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::ALL_LISTINGS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::ALL_LISTINGS->value) class="active" @endif>
                                                            All Listings
                                                        </a>
                                                    </li>

                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_1_MONTH->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_1_MONTH->value) class="active" @endif>
                                                            Within 1 month
                                                        </a>
                                                    </li>
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_3_MONTHS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_3_MONTHS->value) class="active" @endif>
                                                            Within 3 month
                                                        </a>
                                                    </li>
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_6_MONTHS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_6_MONTHS->value) class="active" @endif>
                                                            Within 6 month
                                                        </a>
                                                    </li>
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('store.index', array_merge(array_filter(request()->query()), ['timeframe' => \App\Enums\Store\DefaultTimeframeSelected::WITHIN_12_MONTHS->value, 'page' => 1])) }}" @if (request('timeframe', $store_settings['default_timeframe_selected']) == \App\Enums\Store\DefaultTimeframeSelected::WITHIN_12_MONTHS->value) class="active" @endif>
                                                            Within 12 month
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                @if (! empty($products))
                                    <div class="row">
                                        @foreach($products as $product)
                                            @includeIf('themes.' . current_theme() . '.blocks.product', ['product' => $product])
                                        @endforeach
                                    </div>

                                    @if ($products->lastPage() > 1)
                                        <div class="row">
                                            <div class="col-lg-12">
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
