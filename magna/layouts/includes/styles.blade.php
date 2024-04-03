<style>
.wp-block-button__link {
    background: #68A4C4;
    border-radius: 0!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid #68A4C4;
        color: #68A4C4!important;
}

.wp-block-button__link:hover {
    background: #85b6cf;
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
.wp-block-button__link, .button a, .read-more a, .contact .php-email-form button {
    background: {{ $template_colors['button']['background'] }}!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid {{ $template_colors['button']['background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['text']))
.wp-block-button__link, .button a, .read-more a, .contact .php-email-form button {
    color: {{ $template_colors['button']['text'] }}!important;
}
.is-style-outline .wp-block-button__link {
        color: {{ $template_colors['button']['text'] }}!important;
}
@endif

@if (! empty($template_colors['button']['hover_background']))
.wp-block-button__link:hover, .button a:hover, .read-more a:hover, .contact .php-email-form button:hover,
.blog .blog-pagination li.active a, .blog .blog-pagination li:hover {
    background: {{ $template_colors['button']['hover_background'] }}!important;
}
.is-style-outline .wp-block-button__link:hover {
       border: 2px solid {{ $template_colors['button']['hover_background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['hover_text']))
.wp-block-button__link:hover, .button a:hover, .read-more a:hover, .contact .php-email-form button:hover,
.blog .blog-pagination li.active a, .blog .blog-pagination li:hover {
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
#footer, #footer .footer-top {
    background-color: {{ $template_colors['footer_background']['base'] }}!important;
}
#footer .footer-top {
    border-top: 1px solid {{ $template_colors['footer_background']['base'] }}!important;
    border-bottom: 1px solid {{ $template_colors['footer_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['text']))
#footer .footer-top .footer-info h3, 
#footer .footer-top .footer-info p, 
#footer .footer-top h4, 
#footer .footer-top .footer-links ul i, 
#footer .footer-top .footer-links ul a,
.copyright,
.footer-link {
    color: {{ $template_colors['footer_background']['text'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['hover_link']))
.footer-link:hover,
#footer .footer-top .footer-links ul a:hover {
    color: {{ $template_colors['footer_background']['hover_link'] }} !important;
}
@endif

@if (! empty($template_colors['menu']['base']))
.navbar a {
    color: {{ $template_colors['menu']['base'] }}!important;
}
@endif
@if (! empty($template_colors['menu']['hover']))
.navbar a:hover {
    color: {{ $template_colors['menu']['hover'] }}!important;
}
@endif
@if (! empty($template_colors['menu']['selected']))
.navbar a.active {
    color: {{ $template_colors['menu']['selected'] }}!important;
}
@endif

@if (! empty($template_colors['block_background']['base']))
.row-block {
    background: {{ $template_colors['block_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['additional_elements']['base']))
.back-to-top,
.section-title h2::after,
.social-links a:hover,
.blog .sidebar .search-form form button {
    background: {{ $template_colors['additional_elements']['base'] }}!important;
}

.blog .sidebar .categories ul a:hover,
.blog .sidebar .categories ul a.active,
.breadcrumbs a,
a h1:hover, a h2:hover, a h3:hover, a h4:hover, a h5:hover,
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover,
.blog .entry .entry-title a:hover,
.link {
    color: {{ $template_colors['additional_elements']['base'] }}!important;
}


.link:hover {
    text-decoration: underline;
}

.breadcrumbs a:hover, .blog .entry .entry-meta {
    color: {{ $template_colors['additional_elements']['base'] }}80!important;
}

.blog .sidebar .search-form form button:hover,
.back-to-top:hover {
    background: {{ $template_colors['additional_elements']['base'] }}80 !important;
}
@endif

@if (! empty($template_colors['titles']['base']))
h1, h2, h3, h4, h5,
h1 a, h2 a, h3 a, h4 a, h5 a {
    color: {{ $template_colors['titles']['base'] }}!important;
}
@endif

.wp-block-column {
padding: 0 10px;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    line-height: inherit;
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
</style>
