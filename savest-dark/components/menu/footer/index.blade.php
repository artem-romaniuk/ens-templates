@if (! empty($items))
    <div class="row">
        <ul class="footer-widget-nav">
            @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $items])
        </ul>
    </div>
@endif
