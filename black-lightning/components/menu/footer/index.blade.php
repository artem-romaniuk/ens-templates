@if (! empty($items))
    <ul class="footer-widget-nav">
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $items])
    </ul>
@endif
