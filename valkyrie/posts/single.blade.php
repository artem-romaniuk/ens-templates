@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="shows-events-tabs rent-venue-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content my-4 py-3" style="background: white">
                    <div class="blog-single-wrap pt-0">
                        <div class="header">
                            @if (! empty($data['banner']))
                                @php($banner = $data['banner'][0])
                                @if (! empty($banner['image']['url']))
                                    <div>
                                        <img src="{{ $banner['image']['url'] }}" alt="" style="width: 100%; height: auto;">
                                    </div>
                                @endif
                            @endif

                            <ul class="list-unstyled d-flex justify-content-between mt-3">
                                <li class="text-muted">{{ $created_at }}</li>
                                <li class="text-muted text-right">{{ $author->name }}</li>
                            </ul>
                        </div>

                        <h1 class="post-title my-4">{!! $title ?? $name !!}</h1>

                        <div class="post-content page-content">
                            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
