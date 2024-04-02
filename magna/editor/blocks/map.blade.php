@php($id = 'map-' . uniqid())
<div style="width: 100%;height: 100%;">
    <iframe id="{{ $id }}" style="border: 0;width: 100%" src="https://www.google.com/maps/embed/v1/place?key={{ settings('services.google.maps.api_key', '') }}&q={{ $data['parameter'] ?? '' }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <script>
        (function () {
            const frame = document.getElementById('{{ $id }}');

            if (frame) {
                const { width, height } = frame.getBoundingClientRect();
                frame.style.height = (+width * 0.75) + 'px';
            }
        })();
    </script>
</div>
