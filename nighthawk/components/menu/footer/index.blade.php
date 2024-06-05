@if (! empty($items))
    <ul>
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $items])
    </ul>
@endif
