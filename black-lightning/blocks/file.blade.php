<div class="col-12 mb-6">
    <div class="event-item flex-md-nowrap flex-sm-wrap">
        <div class="content p-5" style="position: relative">
            <div class="details" style="width: 100%">
                @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                    <div style="background: #cb914f;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
                @endif

                <h4 class="title">
                    <a class="default-link" href="{{ ! empty($file->getFirstMediaUrl('downloads')) ? $file->getFirstMediaUrl('downloads') : ($file->urls[0] ?? '#') }}" download="" target="_blank">
                        {{ $file->title ?? $file->name }}
                    </a>
                </h4>

                <div>
                    {!! $file->description !!}
                </div>

                @if (settings('files_setup.display_last_updated_date', false))
                    <div class="sub-title mt-3">
                        Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
