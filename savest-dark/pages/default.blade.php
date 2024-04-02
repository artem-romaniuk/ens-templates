@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif>
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-auto text-center text-sm-start">
                        <h1 class="page-header-title" style="@if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }}; @endif @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">{{ $banner['title']['text'] ?? '' }}</h1>
                            @if (! empty($banner['subtitle']['text']))
                                <p class="link-nav" style="@if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">{{ $banner['subtitle']['text'] }}</p>
                            @endif
                    </div>
{{--                    <div class="col-sm-auto">--}}
{{--                        <ol class="breadcrumb mb-0 justify-content-center mt-3 mt-sm-0">--}}
{{--                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active" aria-current="page">About Us</li>--}}
{{--                        </ol>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    @endif
    
    @if (empty($data['content']['blocks'] ?? []))
            <div class="section section-padding-t">
                <div class="container">
                    <div class="row justify-content-center">
                        This is your new, completely empty website.  You will need to add your own content.  In addition, you will probably remove some of the pages linked to above, change the name of some pages, change the order of pages, and of course add new pages.  Currently, this is just a placeholder site for you.  Please consult your training materials for how to log in as an administrator and start adding content.
                    </div>
                </div>
            </div>
        @endif

    @includeif('themes.' . current_theme() . '.editor.index', ['blocks' => $data['content']['blocks'] ?? []])
@endsection
