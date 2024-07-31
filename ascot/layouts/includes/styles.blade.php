<style>
.custom-button {
    padding: 4px 12px;
}

.wp-block-button__link {
    background: #343a3e;
    border-radius: 0!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid #343a3e;
        color: #343a3e!important;
}

.wp-block-button__link:hover {
    opacity: 0.9;
}


@if (! empty($template_settings['body']['font_family']['url']))
    @import url("{{ $template_settings['body']['font_family']['url'] }}");
@endif

@if (! empty($template_colors['events']['background']))
.event-block {
    background: {{ $template_colors['events']['background'] }}!important;
}
@endif

body {
@if (! empty($template_settings['body']['color']))
    color: {{ $template_settings['body']['color']  }}!important;
@endif

@if (! empty($template_settings['body']['line_height']['value']))
    line-height: {{ $template_settings['body']['line_height']['value'] . ($template_settings['body']['line_height']['unit'] ?? 'px') }}px!important;
@endif

@if (! empty($template_settings['body']['font_size']['value']))
    font-size: {{ $template_settings['body']['font_size']['value'] . ($template_settings['body']['font_size']['unit'] ?? 'px') }}!important;
@endif

@if (! empty($template_settings['body']['font_weight']))
    font-weight: {{ $template_settings['body']['font_weight'] }}!important;
@endif

@if (! empty($template_settings['body']['font_family']['value']))
    font-family: "{{ $template_settings['body']['font_family']['value'] }}", sans-serif!important;
@endif
}

.footer-main {
@if (! empty($template_settings['footer']['text_color']['value']) && ! empty($template_settings['footer']['text_color']['apply']))
    color: {{ $template_settings['footer']['text_color']['value'] }}!important;
@endif

@if (! empty($template_settings['footer']['background_color']['value']) && ! empty($template_settings['footer']['background_color']['apply']))
    background-color: {{ $template_settings['footer']['background_color']['value'] }}!important;
@endif

@if (! empty($template_settings['footer']['background_image']['value']) && ! empty($template_settings['footer']['background_image']['apply']))
    background-image: url("{{ $template_settings['footer']['background_image']['value'] }}")!important;
    background-size: cover!important;
@endif
}

@if (! empty($template_settings['footer']['text_color']['value']) && ! empty($template_settings['footer']['text_color']['apply']))
.footer-main, .footer-main div, .footer-main p {
    color: {{ $template_settings['footer']['text_color']['value'] }} !important;
}
@endif

@if (! empty($template_settings['footer']['label_color']['value']) && ! empty($template_settings['footer']['label_color']['apply']))
.footer-main h3, .footer-main h4 {
    color: {{ $template_settings['footer']['label_color']['value'] }} !important;
}
@endif

@if (! empty($template_settings['footer']['link_color']['state']) && ! empty($template_settings['footer']['link_color']['apply']))
.footer-widget-nav a {
    color: {{ $template_settings['footer']['link_color']['state'] }} !important;
}
@if (! empty($template_settings['footer']['link_color']['state']))
.footer-widget-nav a:hover {
    color: {{ $template_settings['footer']['link_color']['hover'] }} !important;
}
@endif
@endif

.hero-slide-sub-title {
    max-width: 545px!important;
}
</style>

<!-- Color styles -->
<style>
@if (! empty($template_colors['button']['background']))
.button, button, .main-white-button a, .main-dark-button a {
    background: {{ $template_colors['button']['background'] }}!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid {{ $template_colors['button']['background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['text']))
.button, button, .main-white-button a, .main-dark-button a {
    color: {{ $template_colors['button']['text'] }}!important;
}
.is-style-outline .wp-block-button__link {
        color: {{ $template_colors['button']['text'] }}!important;
}
@endif

@if (! empty($template_colors['button']['hover_background']))
.button:hover, button:hover, .main-white-button a:hover, .main-dark-button a:hover,
.shows-events-tabs .tabs-content .pagination ul li a:hover, .shows-events-tabs .tabs-content .pagination ul li.active a {
    background: {{ $template_colors['button']['hover_background'] }}!important;
}
.is-style-outline .wp-block-button__link:hover {
       border: 2px solid {{ $template_colors['button']['hover_background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['hover_text']))
.button:hover, button:hover, .main-white-button a:hover, .main-dark-button a:hover,
.shows-events-tabs .tabs-content .pagination ul li a:hover, .shows-events-tabs .tabs-content .pagination ul li.active a {
    color: {{ $template_colors['button']['hover_text'] }}!important;
}
.is-style-outline .wp-block-button__link:hover {
       color: {{ $template_colors['button']['hover_text'] }}!important;
}
@endif

@if (! empty($template_colors['page_background']['base']))
body {
    background: {{ $template_colors['page_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['base']))
footer {
    background-color: {{ $template_colors['footer_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['text']))
footer, footer .address span, footer p, footer h4, footer .links ul li a, .footer-link {
    color: {{ $template_colors['footer_background']['text'] }} !important;
}
@endif

@if (! empty($template_colors['footer_background']['hover_link']))
footer .links ul li a:hover, .footer-link:hover {
    color: {{ $template_colors['footer_background']['hover_link'] }} !important;
}
@endif

@if (! empty($template_colors['titles']['base']))
h1, h2, h3, h4, h5, .entry-title a {
    color: {{ $template_colors['titles']['base'] }}!important;
}
@endif

@if (! empty($template_colors['menu']['base']))
.navbar a {
    color: {{ $template_colors['menu']['base'] }}!important;
}
@endif
@if (! empty($template_colors['menu']['hover']))
.navbar a:hover, .navbar li:hover>a {
    color: {{ $template_colors['menu']['hover'] }}!important;
}
@endif
@if (! empty($template_colors['menu']['selected']))
.navbar .active, .navbar .active:focus  {
    color: {{ $template_colors['menu']['selected'] }}!important;
}
@endif

@if (! empty($template_colors['block_background']['base']))
.row-block {
    background: {{ $template_colors['block_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['additional_elements']['base']))
.entry-title a:hover, .link, .title a {
    color: {{ $template_colors['additional_elements']['base'] }}!important;
}
.title a:hover {
    color: {{ $template_colors['additional_elements']['base'] }}80!important;
}
.link:hover {
    text-decoration: underline !important;
}
@endif

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6, p {
line-height: normal;
}
.wp-block-column {
padding: 0 10px;
}
.page-content ul, ol {
padding: inherit;
margin-left: 1em;
}
.page-content ul li {
list-style: disc;
}
.page-content ol li, .page-content ol li {
list-style: decimal;
}
.page-content p {
    margin-bottom: 1em;
}
</style>
