@if (isset($data['id']))
    @php($data = data_block($data['id']))

    @if (! empty($data['entity']))
        @if ($data['entity'] == 'posts' && $data['items']->isNotEmpty())
            <div class="blog-post-section section" style="padding: 0;">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>
                    <div class="row mb-n6">
                        @foreach($data['items'] as $post)
                            @include('themes.' . current_theme() . '.blocks.post', ['post' => $post])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($data['entity'] == 'events' && $data['items']->isNotEmpty())
            <div class="blog-post-section section" style="padding: 0;">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row mb-n6">
                        @foreach($data['items'] as $event)
                            @include('themes.' . current_theme() . '.blocks.event', ['event' => $event])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($data['entity'] == 'facts' && $data['items']->isNotEmpty())
            <div class="blog-post-section section" style="padding: 0;">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row mb-n6">
                        @foreach($data['items'] as $fact)
                            @include('themes.' . current_theme() . '.blocks.fact', ['fact' => $fact])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($data['entity'] == 'links' && $data['items']->isNotEmpty())
            <div class="blog-post-section section" style="padding: 0;">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row mb-n6">
                        @foreach($data['items'] as $link)
                            @include('themes.' . current_theme() . '.blocks.link', ['link' => $link])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($data['entity'] == 'officers' && $data['items']->isNotEmpty())
            <style>
                @media screen and (max-width: 600px) {
                    .officers-block {
                        width: 100%!important;
                        padding: 0!important;
                    }
                }
            </style>

            <div class="blog-post-section section">
                <div class="container">
                    <div class="row my-3 text-center">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                            <h3>{{ $data['subtitle'] }}</h3>
                        @endif
                    </div>

                    <div class="mx-auto d-flex @if (isset($data['data']['columns']) && $data['data']['columns'] == 1) flex-column w-100 @else flex-wrap justify-content-center @endif" style="width: fit-content">
                        @foreach($data['items'] as $leader)
                            <div class="mb-4 px-8 officers-block" style="width: {{ 100 / ($data['data']['columns'] ?? 1) }}%">
                                <h6 class="text-center">{{ $leader->name }}</h6>
                                <div>
                                    @foreach($leader->positions as $position)
                                        <div class="d-flex justify-content-center" style="align-items: center">
                                            <div style="width: 50%; text-align: right">{{ $position->name }}: </div>
                                            <div class="mx-1"></div>
                                            <div style="width: 50%;">
                                                @foreach($position->users as $user)
                                                    <div>
                                                        @if (! empty($position->email))
                                                            <a href="mailto:{{ $position->email }}">{{ $user->organization_name ?? $user->name }}</a>
                                                        @else
                                                            {{ $user->organization_name ?? $user->name }}
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($data['entity'] == 'contact_form')
            <div class="blog-post-section section">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="contact-form mx-auto" style="max-width: 80%">
                        @if ($errors->any() || (session()->has('status') && session('status') == 'error'))
                            <div class="form-message alert-danger fade show alert mb-4">
                                @if ($errors->any())
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {!! $data['data']['fail_send_message'] !!}
                                @endif
                            </div>
                        @endif

                        @if (session()->has('status') && session('status') == 'success')
                            <div class="form-message alert-success fade show alert mb-4">
                                {!! $data['data']['success_send_message'] !!}
                            </div>
                        @endif

                        <form action="{{ route('mails.contact-form') }}" method="post">
                            @csrf

                            <div class="form-group mb-3 mb-xl-4">
                                <label value="">Send Email To</label>
                                <select class="form-control" name="email_to" required>
                                    @if (settings('company.email'))
                                        <optgroup label="General Inquiry">
                                            <option value="{{ settings('company.email') }}" @if (! old('email_to')) selected @endif>{{ settings('company.email') }}</option>
                                        </optgroup>
                                    @else
                                        <option value="">Send Email To</option>
                                    @endif

                                    @foreach($data['items'] as $leader)
                                        <optgroup label="{{ $leader->name }}">
                                            @foreach($leader->positions as $position)
                                                @foreach($position->users as $user)
                                                    @continue(empty($position->email))
                                                    <option value="{{ $position->email }}" @if ($position->email == old('email_to')) selected @endif>
                                                        {{ $position->name }}: {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 mb-xl-4">
                                <input type="text" class="form-control" name="from_name" value="{{ old('from_name') }}" placeholder="{{ __('From Sender Name') }}" required />
                            </div>
                            <div class="form-group mb-3 mb-xl-4">
                                <input type="email" class="form-control" name="from_email" value="{{ old('from_email') }}" placeholder="{{ __('From Sender Email') }}" required />
                            </div>
                            <div class="form-group mb-3 mb-xl-4">
                                <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="{{ __('Subject') }}" required />
                            </div>
                            <div class="form-group mb-5 mb-xl-4">
                                <textarea class="form-control" name="text" rows="5" style="resize: none" placeholder="{{ __('Message') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-icon-right" type="submit"><span>Send Now</span> <i class="icofont-double-right icon"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if ($data['entity'] == 'join_form')
            <join-form-component :plans="{{ $data['items'] ?? [] }}" :payment-methods="{{ json_encode(payment_methods() ?? '{}') }}"></join-form-component>
        @endif

        @if ($data['entity'] == 'surname_research' && has_tenant_module('surname_research'))
            <surname-research-component />
        @endif

        @if ($data['entity'] == 'gallery' && $data['items']->isNotEmpty())
            <section class="py-0" style="width: 100%;">
                <div class="container blog">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    @php($gallery = $data['items']->first())

                    @if ($gallery->media->isNotEmpty())
                        <div class="row">
                            @foreach($gallery->getMedia('gallery') as $media)
                                <div class="col-12 col-md-4 mb-4 mb-4">
                                    <div class="card h-100 gallery_item">
                                        <a href="{{ $media->getUrl() }}" data-fancybox="gallery" data-caption="{{ $media->custom_properties['description'] ?? '' }}"  class="post-thumb" style="background-image: url('{{ $media->getUrl() }}'); background-position: center center; background-size: cover; height: 250px;">
                                            @if($media->custom_properties['description'] ?? '')
                                                <div class="gallery_caption">{{ $media->custom_properties['description'] }}</div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'publications' && $data['items']->isNotEmpty())
            <section class="py-0" style="width: 100%;">
                <div class="container blog">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    @foreach($data['items'] ?? [] as $block)
                        <div class="row posts-list tickets-page mb-4">
                            @if (! empty($block['criteria']['group_by']) && $block['criteria']['group_by'] != 'none')
                                @php($items = $block['items']->sortByDesc('issue')->sortByDesc('volume')->sortByDesc($block['criteria']['group_by'])->groupBy($block['criteria']['group_by']))

                                @foreach($items as $group => $publications)
                                    <div class="col-12">
                                        <h4 class="mb-2 font-weight-medium text-center">{{ ucfirst($block['criteria']['group_by']) }} {{ $group }}</h4>
                                    </div>

                                    @foreach($publications as $publication)
                                        @includeIf('themes.' . current_theme() . '.blocks.publication', ['publication' => $publication, 'criteria' => $block['criteria']])
                                    @endforeach
                                @endforeach
                            @else
                                @foreach($block['items'] as $publication)
                                    @includeIf('themes.' . current_theme() . '.blocks.publication', ['publication' => $publication, 'criteria' => $block['criteria']])
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'files' && $data['items']->isNotEmpty())
            <div class="blog-post-section section" style="padding: 0;">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row mb-n6">
                        @foreach($data['items'] as $file)
                            @include('themes.' . current_theme() . '.blocks.file', ['file' => $file])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif
@endif
