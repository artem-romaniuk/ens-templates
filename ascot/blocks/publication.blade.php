<div class="col-12 col-md-12 mb-12 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px">
                <h5 class="entry-title" style="margin: 0">
                    {{ $publication->title ?? $publication->name }}

                    <span style="font-size: 0.7em">@if (! empty($publication->volume)), Volume {{ $publication->volume }} @endif
                        @if (! empty($publication->issue)), Issue {{ $publication->issue }} @endif</span>
                </h5>

                <div style="font-size: 0.6em;">{{ $publication->category?->name ?? '' }}</div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    @if ($publication->getFirstMediaUrl('publications'))
                        <a style="text-decoration: underline; color: #000; font-size: 0.7em" href="{{ $publication->getFirstMediaUrl('publications') }}" target="_blank">View</a>
                    @elseif(isset($publication->urls[0]))
                        <a style="text-decoration: underline; color: #000; font-size: 0.7em" href="{{ $publication->urls[0] }}" target="_blank">View</a>
                    @endif
                </div>
                <div style="font-size: 0.6em;">{{ $publication->created_at?->format('m/d/Y') }}</div>
            </div>
        </div>
    </div>
</div>
