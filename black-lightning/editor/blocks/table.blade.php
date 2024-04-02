@if (! empty($data['content']))
    <div class="table-responsive">
        <table class="table">
            @foreach($data['content'] ?? [] as $row)
                @if ($loop->first)
                    <thead @if (! empty($data['withHeadings'])) style="font-weight: bold" @endif>
                        <tr>
                            @foreach($row ?? [] as $cell)
                                <td style="width: {{ 100 / count($row) }}%">{!! $cell !!}</td>
                            @endforeach
                        </tr>
                    </thead>
                @else
                    <tbody>
                        <tr>
                            @foreach($row ?? [] as $cell)
                                <td style="width: {{ 100 / count($row) }}%">{!! $cell !!}</td>
                            @endforeach
                        </tr>
                    </tbody>
                @endif
            @endforeach
        </table>
    </div>
@endif