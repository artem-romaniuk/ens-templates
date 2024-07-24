@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main id="main">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <section class="d-flex justify-content-center flex-column align-items-center page-banner"
                    style="
                        background-image: url('{{ $banner['image']['url'] ?? '' }}');
                        @if(empty($banner['image']['url'])) height: 100px !important; padding: 30px 0px !important; @endif
                        @if(($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply'])) padding: 90px 0px 35px !important;  @endif">
                <h2
                    class="animate__animated animate__fadeInDown text-center"
                    style="
                        @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                        @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                    {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                </h2>

                @if (! empty($banner['subtitle']['text']))
                    <p
                        class="animate__animated animate__fadeInUp text-center"
                        style="
                            @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                            @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                        {{ $banner['subtitle']['text'] }}
                    </p>
                @endif
            </section>
        @endif

        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">{{ $name ?? '' }}</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </section>

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
                            <a href="{{ route('store.index') }}" class="custom-button">
                                Continue Shopping
                            </a>

                            <a href="#" class="custom-button" onclick="event.preventDefault(); document.getElementById('emptyCart').submit();">
                                Empty Cart
                            </a>

                            <form id="emptyCart" style="display: none;" action="{{ route('store.cart.empty') }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                            <a href="{{ route('store.index', ['view' => 'checkout']) }}" class="custom-button">
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
            <section id="blog" class="blog">
                <div class="container" data-aos="fade-up">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                @if (! empty($products))
                                    @foreach($products as $product)
                                        @includeIf('themes.' . current_theme() . '.blocks.product', ['product' => $product])
                                    @endforeach
                                @endif
                            </div>

                            @if ($products->lastPage() > 1)
                                <nav aria-label="Page Navigation">
                                    {{ $products->onEachSide(2)->appends(request()->query())->links('vendor.pagination.shadow') }}
                                </nav>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar">
                                @if (! empty($cart))
                                    <div class="sidebar-item">
                                        <a href="{{ route('store.index', ['view' => 'cart']) }}">Cart ({{ $cart->items->sum('quantity') }})</a>
                                    </div>
                                @endif

                                <div class="sidebar-item search-form">
                                    <form action="{{ route('store.index') }}" class="search-widget" method="get">
                                        <input type="text" name="search" placeholder="Enter keyword.." value="{{ request('search') }}">
                                        <button type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div>

                                @if (isset($categories) && $categories->isNotEmpty())
                                    <h3 class="sidebar-title">Category</h3>
                                    <div class="sidebar-item categories">
                                        <ul class="categories">
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
                                @endif

                                @if (isset($store_settings['default_timeframe_selected']) && $store_settings['default_timeframe_selected'] >= 0 && $store_settings['default_timeframe_selected'] != \App\Enums\Store\DefaultTimeframeSelected::NOT_DISPLAYED->value)
                                    <h3 class="sidebar-title">Timeframe</h3>
                                    <div class="sidebar-item categories">
                                        <ul class="categories">
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container py-0 page-content">
                @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
            </section>
        @endif
    </main>
@endsection
