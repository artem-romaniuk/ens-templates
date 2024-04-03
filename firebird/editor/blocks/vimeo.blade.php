@php($id = 'video-' . uniqid())
<div style="width: 100%;height: 100%;">
    <iframe id="{{ $id }}" style="width: 100%" src="https://player.vimeo.com/video/{{ $data['code'] ?? '' }}" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>

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
