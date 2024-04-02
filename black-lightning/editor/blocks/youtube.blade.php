@php($id = 'video-' . uniqid())
<div style="width: 100%;height: 100%;">
    <iframe id="{{ $id }}" style="width: 100%" src="https://www.youtube.com/embed/{{ $data['code'] ?? '' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

    <script>
        (function () {
            const frame = document.getElementById('{{ $id }}');

            if (frame) {
                const { width, height } = frame.getBoundingClientRect();
                frame.style.height = (+width * 0.55) + 'px';
            }
        })();
    </script>
</div>
