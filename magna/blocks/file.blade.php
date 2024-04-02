<div class="col-md-12">
    <div class="info-box position-relative px-4 py-4">
        @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
            <div style="background: #68A4C4;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
        @endif

        <a href="{{ ! empty($file->getFirstMediaUrl('downloads')) ? $file->getFirstMediaUrl('downloads') : ($file->urls[0] ?? '#') }}" download="" target="_blank">
            <h3 style="text-align: initial">{{ $file->title ?? $file->name }}</h3>
        </a>

        @if (! empty($file->description))
            <div style="text-align: initial">
                {!! $file->description !!}
            </div>
        @endif

        @if (settings('files_setup.display_last_updated_date', false))
            <div class="sub-title mt-3" style="text-align: initial">
                Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
            </div>
        @endif
    </div>
</div>
