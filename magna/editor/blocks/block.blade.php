@if (isset($data['id']))
    @php($data = data_block($data['id']))

    @if (! empty($data['entity']))
        @if ($data['entity'] == 'posts' && $data['items']->isNotEmpty())
            <section class="py-0">
                <div class="container">
                    <div class="section-title pb-0">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row">
                        @foreach($data['items'] as $post)
                            @includeIf('themes.' . current_theme() . '.blocks.post', ['post' => $post])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'events' && $data['items']->isNotEmpty())
            <section class="py-0">
                <div class="container">
                    <div class="section-title pb-0">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row mb-n6">
                        @foreach($data['items'] as $event)
                            @includeIf('themes.' . current_theme() . '.blocks.event', ['event' => $event])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'facts' && $data['items']->isNotEmpty())
            <div class="section-title">
                @if (! empty($data['title']))
                    <h2>{{ $data['title'] }}</h2>
                @endif

                @foreach($data['items'] as $fact)
                    @includeIf('themes.' . current_theme() . '.blocks.fact', ['fact' => $fact])
                @endforeach
            </div>
        @endif

        @if ($data['entity'] == 'links' && $data['items']->isNotEmpty())
            <section class="py-0">
                <div class="container">
                    <div class="section-title pb-0">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row">
                        @foreach($data['items'] as $link)
                            @includeIf('themes.' . current_theme() . '.blocks.link', ['link' => $link])
                        @endforeach
                    </div>
                </div>
            </section>
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

            <section class="py-0">
                <div class="container">
                    <div class="section-title pb-0">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>

                            @if (! empty($data['subtitle']))
                                <h5 class="mb-4">{{ $data['subtitle'] }}</h5>
                            @endif
                        @endif
                    </div>

                    <div class="mx-auto d-flex @if (isset($data['data']['columns']) && $data['data']['columns'] == 1) flex-column w-100 @else flex-wrap justify-content-center @endif">
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
            </section>
        @endif

        @if ($data['entity'] == 'contact_form')
            <section class="py-0">
                <div class="container">
                    <div class="section-title pb-0">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row">
                        <div class="contact-form contact mx-auto" style="max-width: 80%">
                            <form action="{{ route('mails.contact-form') }}" method="post" role="form" class="php-email-form mb-0">
                                @csrf

                                <div class="form-group my-3">
                                    <label>Send Email To</label>
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
                                <div class="row">
                                    <div class="col-md-6 form-group mt-3 mt-md-0">
                                        <input type="text" class="form-control" name="from_name" value="{{ old('from_name') }}" placeholder="{{ __('From Sender Name') }}" required />
                                    </div>
                                    <div class="col-md-6 form-group mt-3 mt-md-0">
                                        <input type="email" class="form-control" name="from_email" value="{{ old('from_email') }}" placeholder="{{ __('From Sender Email') }}" required />
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="{{ __('Subject') }}" required />
                                </div>
                                <div class="form-group mt-3">
                                    <textarea class="form-control" name="text" rows="5" style="resize: none" placeholder="{{ __('Message') }}"></textarea>
                                </div>
                                <div class="my-3">
                                    @if ($errors->any() || (session()->has('status') && session('status') == 'error'))
                                        <div class="error-message" style="display: block">
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
                                        <div class="sent-message" style="display: block">{!! $data['data']['success_send_message'] !!}</div>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit"><span>Send Now</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'join_form')
            <join-form-component :plans="{{ $data['items'] ?? [] }}" :payment-methods="{{ json_encode(payment_methods() ?? '{}') }}"></join-form-component>
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
            <section class="py-0">
                <div class="container">
                    <div class="section-title pb-0">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row contact">
                        @foreach($data['items'] as $file)
                            @includeIf('themes.' . current_theme() . '.blocks.file', ['file' => $file])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif
@endif
