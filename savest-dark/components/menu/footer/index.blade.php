@if (! empty($items))
    <div class="row">
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $items])
    </div>
@endif
