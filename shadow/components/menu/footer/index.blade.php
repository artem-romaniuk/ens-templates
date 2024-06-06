@if (! empty($items))
    <ul class="footer-menu">
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $items])
    </ul>
@endif
