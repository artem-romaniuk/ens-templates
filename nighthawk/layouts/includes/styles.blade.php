<style>
.wp-block-button__link {
    background: var(--color-primary);
    border-radius: 0!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid var(--color-primary);
        color: var(--color-primary)!important;
}

.wp-block-button__link:hover {
    background: rgba(86, 184, 230, 0.8);
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
button[type=submit], .scroll-top, .button a, .wp-block-button__link {
    background: {{ $template_colors['button']['background'] }}!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid {{ $template_colors['button']['background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['text']))
button[type=submit], .scroll-top, .button a, .wp-block-button__link {
    color: {{ $template_colors['button']['text'] }}!important;
}
.is-style-outline .wp-block-button__link {
        color: {{ $template_colors['button']['text'] }}!important;
}
@endif

@if (! empty($template_colors['button']['hover_background']))
button[type=submit]:hover, .scroll-top:hover, .button a:hover, .wp-block-button__link:hover {
    background: {{ $template_colors['button']['hover_background'] }}!important;
}
.is-style-outline .wp-block-button__link:hover {
       border: 2px solid {{ $template_colors['button']['hover_background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['hover_text']))
button[type=submit]:hover, .scroll-top:hover, .button a:hover, .wp-block-button__link:hover {
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
.footer .footer-content, .footer-legal {
    background-color: {{ $template_colors['footer_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['text']))
.footer .footer-content .footer-info .logo span,
.footer .footer-content .footer-info p,
.footer .footer-content h4,
.footer .footer-content .footer-links ul i,
.footer .footer-content .footer-links ul a,
.footer .footer-legal .copyright,
.footer-link {
    color: {{ $template_colors['footer_background']['text'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['hover_link']))
.footer-link:hover,
.footer .footer-content .footer-links ul a:hover {
    color: {{ $template_colors['footer_background']['hover_link'] }} !important;
}
@endif

@if (! empty($template_colors['titles']['base']))
h1, h2, h3, h4, h5,
h1 a, h2 a, h3 a, h4 a, h5 a {
    color: {{ $template_colors['titles']['base'] }}!important;
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
:root {
  --swiper-navigation-color: {{ $template_colors['additional_elements']['base'] }}!important;
  --swiper-pagination-color: {{ $template_colors['additional_elements']['base'] }}!important;
  --color-primary: {{ $template_colors['additional_elements']['base'] }}!important;
}
.editor-blockquote:after,
.contact .php-email-form button[type=submit] {
    background-color: {{ $template_colors['additional_elements']['base'] }}!important;
}
.scroll-top:hover,
.contact .php-email-form button[type=submit]:hover {
    background: {{ $template_colors['additional_elements']['base'] }}CC !important;
}
.social-links a:hover {
    background-color: {{ $template_colors['additional_elements']['base'] }} !important;
    opacity: 0.8;
}
.blog .sidebar .categories ul a.active,
.blog .posts-list .read-more a,
.blog .sidebar .categories ul a:hover {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.title a:hover,
a.return-to-page:hover {
    color: {{ $template_colors['additional_elements']['base'] }}CC !important;
}
.sub-title a:hover {
    color: {{ $template_colors['additional_elements']['base'] }}CC !important;
    text-decoration: underline;
}
@endif

.wp-block-column {
padding: 0 10px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
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
