@extends('themes.' . current_theme() . '.layouts.main')

@push('scripts')
    <script>
        window.onload = (event) => {
            class ClassWatcher {
                constructor(targetNode, classToWatch, classAddedCallback, classRemovedCallback) {
                    this.targetNode = targetNode
                    this.classToWatch = classToWatch
                    this.classAddedCallback = classAddedCallback
                    this.classRemovedCallback = classRemovedCallback
                    this.observer = null
                    this.lastClassState = targetNode.classList.contains(this.classToWatch)

                    this.init()
                }

                init() {
                    this.observer = new MutationObserver(this.mutationCallback)
                    this.observe()
                }

                observe() {
                    this.observer.observe(this.targetNode, { attributes: true })
                }

                disconnect() {
                    this.observer.disconnect()
                }

                mutationCallback = mutationsList => {
                    for (let mutation of mutationsList) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            let currentClassState = mutation.target.classList.contains(this.classToWatch)
                            if (this.lastClassState !== currentClassState) {
                                this.lastClassState = currentClassState
                                if (currentClassState) {
                                    this.classAddedCallback()
                                } else {
                                    this.classRemovedCallback()
                                }
                            }
                        }
                    }
                }
            }

            function setBannerBg() {
                const bannerItem = document.querySelector('.carousel-item.active');
                if (bannerItem) {
                    const imageSrc = bannerItem.getAttribute('data-banner-image');

                    if (document.styleSheets.length > 0) {
                        document.styleSheets[document.styleSheets.length - 1].deleteRule(0);
                        document.styleSheets[document.styleSheets.length - 1].insertRule('#hero::after{background: linear-gradient(to right, rgba(30, 67, 86, 0.8), rgba(30, 67, 86, 0.6)), url("' + imageSrc + '") center top no-repeat; background-size: cover}', 0);
                    }
                }
            }

            setBannerBg();

            Array.from(document.querySelectorAll('.carousel-item')).forEach(item => {
                new ClassWatcher(item, 'active', () => { setBannerBg() }, () => {});
            });
        };
    </script>
@endpush

@section('content')
    <section id="hero" class="d-flex justify-cntent-center align-items-center">
        @if (! empty($data['banner']))
            <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="{{ $data['hero_section']['delay'] ?? 5000 }}">

                @foreach($data['banner'] as $banner)
                    <div class="carousel-item @if ($loop->first) active @endif" data-banner-image="{{ $banner['image']['url'] ?? '' }}">
                        <div class="carousel-container">
                            <h2 class="animate__animated animate__fadeInDown" 
                                style="
                                    @if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif
                                    @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px !important; @endif">
                                {{ $banner['title']['text'] ?? '' }}
                            </h2>

                            <h4 class="animate__animated animate__fadeInDown" 
                                style="
                                    @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif
                                    @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px !important; @endif">
                                {{ $banner['subtitle']['text'] ?? '' }}
                            </h4>

                            @if (! empty($banner['description']))
                                <p class="animate__animated animate__fadeInUp" 
                                    style="
                                        @if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }}; @endif
                                        @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px; @endif">
                                        {{ $banner['description']['text'] }}
                                    </p>
                            @endif

                            @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                <a class="btn-get-started animate__animated animate__fadeInUp" href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}">
                                    {{ $banner['button']['text'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
                </a>
            </div>
        @endif
    </section>

    <main id="main">
        <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
