@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif style="@if (empty($banner['image']['url'])) padding: 0px 0px 20px 0px !important; @endif">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-auto text-center text-sm-start">
                        <h1
                            class="page-header-title"
                            style="
                                @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                                @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                            {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                        </h1>
                        @if (! empty($banner['subtitle']['text']))
                            <p
                                class="link-nav"
                                style="
                                        @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                        @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                                {{ $banner['subtitle']['text'] }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (isset($view) && $view == 'checkout')
        <div class="page-section pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <store-checkout-component :payment-methods="{{ json_encode(payment_methods() ?? '{}') }}"></store-checkout-component>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (isset($view) && $view == 'cart')
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('store.index') }}" class="custom-button btn">
                            Continue Shopping
                        </a>

                        <a href="#" class="custom-button btn" onclick="event.preventDefault(); document.getElementById('emptyCart').submit();">
                            Empty Cart
                        </a>

                        <form id="emptyCart" style="display: none;" action="{{ route('store.cart.empty') }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>

                        <a href="{{ route('store.index', ['view' => 'checkout']) }}" class="custom-button btn">
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
        <div class="event-section section section-padding pb-0">
            <div class="container">
                <div class="row justify-content-between flex-xl-row-reverse">
                    <div class="col-lg-12 col-xl-8">
                        @if (! empty($products))
                            @foreach($products as $product)
                                @includeIf('themes.' . current_theme() . '.blocks.product', ['product' => $product])
                            @endforeach
                        @endif

                        @if ($products->lastPage() > 1)
                            <div class="col-12">
                                <div class="mt-6 mt-md-10">
                                    {{ $products->onEachSide(2)->appends(request()->query())->links() }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-12 col-xl-4">
                        <div class="sidebar-wrap mt-8 mt-xl-0 pe-0 pe-xl-6">
                            @if (! empty($cart))
                                <div class="sidebar-widget mb-4">
                                    <div class="sidebar-widget-body py-2">
                                        <a href="{{ route('store.index', ['view' => 'cart']) }}">Cart ({{ $cart->items->sum('quantity') }})</a>
                                    </div>
                                </div>
                            @endif

                            <div class="sidebar-search-widget mb-4">
                                <form action="{{ route('store.index') }}" method="get">
                                    <input class="form-control search-input" name="search" type="search" placeholder="Search here" value="{{ request('search') }}">
                                    @foreach(array_filter(request()->query() ?? []) as $name => $value)
                                        @continue($name == 'search')
                                        <input name="{{ $name }}" type="hidden" value="{{ $value }}">
                                    @endforeach
                                    <button type="submit"><i class="icofont-search-1"></i></button>
                                </form>
                            </div>

                            @if (isset($categories) && $categories->isNotEmpty())
                                <div class="sidebar-widget">
                                    <h3 class="sidebar-widget-title mb-2">Categories</h3>
                                    <div class="sidebar-widget-body">
                                        <ul class="sidebar-category-list">
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

                            @if (isset($store_settings['default_timeframe_selected']) && $store_settings['default_timeframe_selected'] >= 0 && $store_settings['default_timeframe_selected'] != \App\Enums\Store\DefaultTimeframeSelected::NOT_DISPLAYED->value)
                                <div class="sidebar-widget">
                                    <h3 class="sidebar-widget-title">Timeframe</h3>
                                    <div class="sidebar-widget-body">
                                        <ul class="sidebar-category-list">
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
                            @endif
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
