<div class="col-12 col-md-12 mb-12 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="entry-title">
                {{ $fact->title ?? $fact->name }}
            </h5>

            <div class="description">{!! $fact->text !!}</div>
        </div>
    </div>
</div>
