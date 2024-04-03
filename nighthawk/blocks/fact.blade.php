<div class="col-lg-12">
    <article class="d-flex flex-column position-relative pb-2">
        <h2 class="title">
            {{ $fact->title ?? $fact->name }}
        </h2>

        <div class="content">
            {!! $fact->text !!}
        </div>
    </article>
</div>
