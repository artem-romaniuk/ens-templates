<div class="col-lg-12 py-4 wow fadeInUp">
    <div class="card-blog" style="min-width: 100%">
        <div class="body">
            <h5 class="post-title entry-title">
                {{ $fact->title ?? $fact->name }}
            </h5>

            <div class="description">{!! $fact->text !!}</div>
        </div>
    </div>
</div>
