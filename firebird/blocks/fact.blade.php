<div class="col-lg-12 service_section mt-3">
    <div class="box mt-0 mb-2 service_container pt-4 pb-4" style="margin: 0">
        <div class="detail-box">
            <h5 class="entry-title">
                {{ $fact->title ?? $fact->name }}
            </h5>

            <div class="description">{!! $fact->text !!}</div>
        </div>
    </div>
</div>
