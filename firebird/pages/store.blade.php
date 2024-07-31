@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    </div>

    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <section class="d-flex justify-content-center flex-column align-items-center page-banner" style="background-image: url('{{ $banner['image']['url'] ?? '' }}'); min-height: 90px; max-height: 300px; background-size: cover; @if($banner['image']['url']) height: 300px; @else margin-top: 10px; @endif">
            <h2
                class="animate__animated animate__fadeInDown text-center"
                style="
                    @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                    @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
            </h2>

            @if (! empty($banner['subtitle']['text']))
                <p
                    class="animate__animated animate__fadeInUp"
                    style="
                        @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                        @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                    {{ $banner['subtitle']['text'] }}
                </p>
            @endif
        </section>
    @endif

    @if (isset($view) && $view == 'checkout')
        <section class="py-4 blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <store-checkout-component :payment-methods="{{ json_encode(payment_methods() ?? '{}') }}"></store-checkout-component>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($view) && $view == 'cart')
        <section class="py-4 blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('store.index') }}" class="cta-btn custom-button">
                            Continue Shopping
                        </a>

                        <a href="#" class="cta-btn custom-button mx-1" onclick="event.preventDefault(); document.getElementById('emptyCart').submit();">
                            Empty Cart
                        </a>

                        <form id="emptyCart" style="display: none;" action="{{ route('store.cart.empty') }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>

                        <a href="{{ route('store.index', ['view' => 'checkout']) }}" class="cta-btn custom-button">
                            Checkout
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 pt-4">
                        @if (! empty($cart))
                            @foreach($cart->items as $item)
                                @includeIf('themes.' . current_theme() . '.blocks.cart-item', ['item' => $item, 'view' => $view])
                            @endforeach

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
        </section>
    @endif

    @if (isset($view) && $view == 'store')
        <section class="py-4 blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 entries">
                        <div class="row">
                            @if (! empty($products))
                                @foreach($products as $product)
                                    @includeIf('themes.' . current_theme() . '.blocks.product', ['product' => $product])
                                @endforeach
                            @endif
                        </div>

                        @if ($products->lastPage() > 1)
                            <div class="blog-pagination mb-4">
                                {{ $products->onEachSide(2)->appends(request()->query())->links('vendor.pagination.shadow') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4 entries sidebar">
                        @if (! empty($cart))
                            <section class="service_section mb-4">
                                <div class="service_container mx-0 py-3">
                                    <div class="sidebar-item search-form">
                                        <div class="sidebar-item">
                                            <a href="{{ route('store.index', ['view' => 'cart']) }}">Cart ({{ $cart->items->sum('quantity') }})</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif

                        <section class="service_section mb-4">
                            <div class="service_container mx-0 py-3">
                                <div class="sidebar-item search-form">
                                    <form action="{{ route('store.index') }}" class="d-flex" method="get">
                                        <input type="text" placeholder="Search" class="mb-0" name="search" value="{{ request('search') }}">
                                        <button class="cta-btn mt-0 ml-2" type="submit">Go</button>
                                    </form>
                                </div>
                            </div>
                        </section>

                        @if (isset($categories) && $categories->isNotEmpty())
                            <section class="service_section mb-4">
                                <div class="service_container mx-0 py-3">
                                    <h5 class="sidebar-title">Categories</h5>
                                    <div class="sidebar-item categories box mt-4">
                                        <ul class="detail-box px-2 mt-0">
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
                            </section>
                        @endif

                        <section class="service_section mb-4">
                            <div class="service_container mx-0 py-3">
                                <h5 class="sidebar-title">Timeframe</h5>
                                <div class="sidebar-item categories box mt-4">
                                    <ul class="detail-box px-2 mt-0">
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
                        </section>
                    </div>
                </div>
            </div>
        </section>

        <section class="container py-0">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    @endif
@endsection
