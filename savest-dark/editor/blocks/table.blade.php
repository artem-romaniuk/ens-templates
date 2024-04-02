@if (! empty($data['content']))
    <div class="progress-table-wrap">
        <div class="progress-table">
            @foreach($data['content'] ?? [] as $row)
                @if ($loop->first)
                    <div class="table-head" @if (! empty($data['withHeadings'])) style="font-weight: bold" @endif>
                        @foreach($row ?? [] as $cell)
                            <div style="flex-grow: 1; width: {{ 100 / count($row) }}%;padding: 0 5px;">{!! $cell !!}</div>
                        @endforeach
                    </div>
                @else
                    <div class="table-row">
                        @foreach($row ?? [] as $cell)
                            <div style="flex-grow: 1; width: {{ 100 / count($row) }}%;padding: 0 5px;">{!! $cell !!}</div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
