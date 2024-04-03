<div class="col-lg-12 mb-2 ticket-item">
    <div class="down-content" style="min-width: 100%">
        <div class="body">
            <h5 class="post-title entry-title">
                {{ $fact->title ?? $fact->name }}
            </h5>

            <div class="description">{!! $fact->text !!}</div>
        </div>
    </div>
</div>
