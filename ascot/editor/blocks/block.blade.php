@if (isset($data['id']))
    @php($data = data_block($data['id']))

    @if (! empty($data['entity']))
        @if ($data['entity'] == 'posts' && $data['items']->isNotEmpty())
            <section class="py-0" style="width: 100%;">
                <div class="container blog">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    <div class="row posts-list tickets-page">
                        @foreach($data['items'] as $post)
                            @includeIf('themes.' . current_theme() . '.blocks.post', ['post' => $post])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'events' && $data['items']->isNotEmpty())
            <section class="py-0" style="width: 100%;">
                <div class="container blog">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    <div class="row posts-list tickets-page">
                        @foreach($data['items'] as $event)
                            @includeIf('themes.' . current_theme() . '.blocks.event', ['event' => $event])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'facts' && $data['items']->isNotEmpty())
            <section class="py-0" style="width: 100%;">
                <div class="container blog">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    <div class="row posts-list tickets-page">
                        @foreach($data['items'] as $fact)
                            @includeIf('themes.' . current_theme() . '.blocks.fact', ['fact' => $fact])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'links' && $data['items']->isNotEmpty())
            <section class="py-0" style="width: 100%;">
                <div class="container blog">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    <div class="row posts-list tickets-page">
                        @foreach($data['items'] as $link)
                            @includeIf('themes.' . current_theme() . '.blocks.link', ['link' => $link])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'officers' && $data['items']->isNotEmpty())
            <section class="py-0" style="width: 100%;">
                <div class="container">
                    <div class="section-header text-center">
                        <div class="heading-text">
                            @if (! empty($data['title']))
                                <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                            @endif
                            @if (! empty($data['subtitle']))
                                <h5 class="text-center">{{ $data['subtitle'] }}</h5>
                            @endif
                        </div>
                    </div>

                    <div class="mx-auto d-flex mt-3 @if (isset($data['data']['columns']) && $data['data']['columns'] == 1) flex-column w-100 @else flex-wrap justify-content-center @endif">
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
            <section class="py-0 contact_section" style="width: 100%;">
                <div class="container rent-venue-application">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    <div class="contact-form">
                        <form action="{{ route('mails.contact-form') }}" class="contact-form py-0 px-lg-5" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-black">Send Email To</label>
                                    <fieldset>
                                        <select name="email_to" required>
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
                                    </fieldset>
                                </div>

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <fieldset>
                                        <input type="text" name="from_name" placeholder="{{ __('From Sender Name') }}" value="{{ old('from_name') }}" required />
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <input type="email" name="from_email" placeholder="{{ __('From Sender Email') }}" value="{{ old('from_email') }}" required />
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="{{ __('Subject') }}" required />
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <textarea name="text" rows="5" class="mb-0" style="resize: none" placeholder="{{ __('Write your notes or questions here...') }}"></textarea>
                                    </fieldset>
                                </div>

                                <div class="col-md-12 my-0 py-0">
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

                                <div class="col-md-12 pt-4">
                                    <button type="submit" class="main-dark-button">Submit Request</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        @endif

        @if ($data['entity'] == 'join_form')
            <section class="py-0 contact_section" style="width: 100%;">
                <div class="container rent-venue-application mt-0">

                    @if (! empty($data['items']))
                        <div class="heading-text">
                            <h3 class="mb-4 font-weight-medium text-center">New Membership</h3>
                        </div>

                        @if (settings('users_setup.system.use_online_join'))
                            <div class="contact-form mb-4">
                                <form action="{{ route('join-form') }}" class="contact-form py-0" method="post">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-black">Select Membership Plan</label>
                                            <fieldset>
                                                <select name="plan" required style="width: 100%;">
                                                    @foreach($data['items'] as $plan)
                                                        @continue(!$plan->allow_online_join)
                                                        <option value="{{ $plan->id }}" @if ($plan->id == old('plan')) selected @endif>
                                                            {{ $plan->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="text-black">Payment Type</label>
                                            <fieldset>
                                                <select name="payment_type" required style="width: 100%;">
                                                    @foreach(payment_methods() as $key => $type)
                                                        @continue(!$type['enabled'])
                                                        <option value="{{ $key }}" @if ($key == old('plan')) selected @endif>
                                                            {{ $type['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="text-black">{{ __('First name') }}</label>
                                            <fieldset>
                                                <input type="text" name="first_name" value="{{ old('first_name') }}" style="width: 100%;" required />
                                            </fieldset>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="text-black">{{ __('Last name') }}</label>
                                            <fieldset>
                                                <input type="text" name="last_name" value="{{ old('last_name') }}" style="width: 100%;" required />
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="text-black">{{ __('Login') }}</label>
                                            <fieldset>
                                                <input type="text" name="login" value="{{ old('login') }}" style="width: 100%;" required />
                                            </fieldset>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="text-black">{{ __('Email') }}</label>
                                            <fieldset>
                                                <input type="email" name="email" value="{{ old('email') }}" style="width: 100%;" required />
                                            </fieldset>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="text-black">{{ __('Password') }}</label>
                                            <fieldset>
                                                <input type="password" name="password" style="width: 100%;" required />
                                            </fieldset>
                                        </div>

                                        <div class="col-md-12 my-0 mb-4 py-0">
                                            @if ($errors->any() || (session()->has('status') && session('status') == 'error'))
                                                <div class="error-message py-0" style="display: block">
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

                                                @if (session()->has('url'))
                                                    <div class="sent-message" style="display: block">
                                                        <a href="{{ session('url') }}" class="main-dark-button">Pay Now</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="main-dark-button">Submit Request</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <h4 class="mb-2 font-weight-medium text-center">Membership Plans Offered:</h4>
                        <figure class="wp-block-table">
                            <table>
                                <tr>
                                    <td style="width: 30%;">Plan Name</td>
                                    <td style="width: 20%;">For</td>
                                    <td style="width: 10%;">Maximum Associated Members</td>
                                    <td style="width: 10%;">Annual Fee</td>
                                    <td style="width: 30%;">Description</td>
                                </tr>

                                @foreach($data['items'] as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ \App\Enums\UserType::from($plan->type)->toString() }}</td>
                                        <td>{{ $plan->max_members }}</td>
                                        <td>${{ number_format($plan->annual_fee, 2, '.', '') }}</td>
                                        <td>{{ $plan->description }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </figure>
                    @else
                        <h3 class="mb-2 font-weight-medium text-center">No added plans</h3>
                    @endif
                </div>
            </section>
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
                        <div class="row posts-list tickets-page">
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
            <section class="py-0" style="width: 100%;">
                <div class="container blog">
                    <div class="heading-text">
                        @if (! empty($data['title']))
                            <h3 class="mb-2 font-weight-medium text-center">{{ $data['title'] }}</h3>
                        @endif
                    </div>

                    <div class="row posts-list tickets-page">
                        @foreach($data['items'] as $file)
                            @includeIf('themes.' . current_theme() . '.blocks.file', ['file' => $file])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif
@endif
