<div class="col-lg-12">
    <article class="d-flex flex-column position-relative pb-2">
        @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
            <div style="background: #68A4C4;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
        @endif

        <h2 class="title">
            <a href="{{ ! empty($file->getFirstMediaUrl('downloads')) ? $file->getFirstMediaUrl('downloads') : ($file->urls[0] ?? '#') }}" target="_blank">{{ $file->title ?? $file->name }}</a>
        </h2>

        <div class="content pb-2">
            @if (! empty($file->description))
                {!! $file->description !!}
            @endif
        </div>

        @if (settings('files_setup.display_last_updated_date', false))
            <div class="read-more mt-auto align-self-end" style="font-size: 0.8em">
                Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
            </div>
        @endif
    </article>
</div>
