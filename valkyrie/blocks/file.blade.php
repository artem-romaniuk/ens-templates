<div class="col-lg-12 ticket-item mb-3">
    <div class="card down-content position-relative" style="min-width: 100%">
        <div class="card-body">
            @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                <div style="background: #59ab6e;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
            @endif

            <div class="detail-box mt-1">
                <h5 class="entry-title">
                    <a style="text-decoration: underline; color: #000;" href="{{ ! empty($file->getFirstMediaUrl('downloads')) ? $file->getFirstMediaUrl('downloads') : ($file->urls[0] ?? '#') }}" target="_blank">{{ $file->title ?? $file->name }}</a>
                </h5>

                <div class="sub-title mb-2">
                    @if (! empty($file->description))
                        {!! $file->description !!}
                    @endif
                </div>

                @if (settings('files_setup.display_last_updated_date', false))
                    <div class="read-more mt-auto align-self-end" style="font-size: 0.8em">
                        Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
