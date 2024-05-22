@if (!preg_match('/iPhone|iPad|iPod|Macintosh|Mac OS X/', $_SERVER['HTTP_USER_AGENT']))
    @php return; @endphp
@endif

<style>
    html {
        zoom: 110%;
    }
</style>
