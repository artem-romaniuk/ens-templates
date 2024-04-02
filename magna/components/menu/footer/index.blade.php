@if (! empty($items))
    @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $items])
@endif
