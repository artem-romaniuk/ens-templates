@if (! empty($items))
    <ul class="list-unstyled text-light footer-link-list">
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $items])
    </ul>
@endif
