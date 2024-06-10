<style>
.wp-block-button__link {
    background: #6C55F9;
    border-radius: 0!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid #6C55F9;
        color: #6C55F9!important;
}

.wp-block-button__link:hover {
    background: #645F88;
}

@if (! empty($template_settings['body']['font_family']['url']))
    @import url("{{ $template_settings['body']['font_family']['url'] }}");
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
.button a, button, .btn,
.page-link {
    background: {{ $template_colors['button']['background'] }}!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid {{ $template_colors['button']['background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['text']))
.button a, button, .btn,
.page-link {
    color: {{ $template_colors['button']['text'] }}!important;
}
.is-style-outline .wp-block-button__link {
        color: {{ $template_colors['button']['text'] }}!important;
}
@endif

@if (! empty($template_colors['button']['hover_background']))
.button a:hover, button:hover, .btn:hover,
.page-item.active .page-link, .page-link:hover {
    background: {{ $template_colors['button']['hover_background'] }}!important;
    border-color: {{ $template_colors['button']['hover_background'] }}!important;
}
.is-style-outline .wp-block-button__link:hover {
       border: 2px solid {{ $template_colors['button']['hover_background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['hover_text']))
.button a:hover, button:hover, .btn:hover,
.page-item.active .page-link, .page-link:hover {
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
.page-footer h3, .page-footer h4, .page-footer h5,
.page-footer p,
.footer-menu a, .footer-link {
    color: {{ $template_colors['footer_background']['text'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['hover_link']))
.footer-link:hover {
    color: {{ $template_colors['footer_background']['hover_link'] }} !important;
}
@endif

@if (! empty($template_colors['menu']['base']))
.nav-link {
    color: {{ $template_colors['menu']['base'] }}!important;
}
@endif
@if (! empty($template_colors['menu']['hover']))
.nav-link:hover {
    color: {{ $template_colors['menu']['hover'] }}!important;
}
@endif
@if (! empty($template_colors['menu']['selected']))
.nav-item.active .nav-link {
    color: {{ $template_colors['menu']['selected'] }}!important;
}
@endif

@if (! empty($template_colors['block_background']['base']))
.row-block {
    background: {{ $template_colors['block_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['events']['background']))
.event-block {
    background: {{ $template_colors['events']['background'] }}!important;
}
@endif

@if (! empty($template_colors['additional_elements']['base']))
.breadcrumb-item a {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.divider, .quote, .back-to-top:hover {
    background-color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.post-title a:hover, .link, .link:hover, .widget-title {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.categories li a.active, .categories li a:hover {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
    text-shadow: 0 2px 4px {{ $template_colors['additional_elements']['base'] }}80 !important;
}
.wp-block-column h1::after,
.wp-block-column h2::after,
.wp-block-column h3::after,
.wp-block-column h4::after,
.wp-block-column h5::after,
.wp-block-column h6::after {
    background-color: {{ $template_colors['additional_elements']['base'] }} !important;
}
@endif

@if (! empty($template_colors['titles']['base']))
h1, h2, h3, h4, h5, .widget-title, .post-title a {
    color: {{ $template_colors['titles']['base'] }}!important;
}
@endif

.wp-block-columns {
    box-shadow: 3px 3px 4px 2px rgba(0, 0, 0, 0.45);
    padding: 10px 0;
}

.wp-block-column h1::after,
.wp-block-column h2::after,
.wp-block-column h3::after,
.wp-block-column h4::after,
.wp-block-column h5::after,
.wp-block-column h6::after {
    content: "";
    display: block;
    margin-top: 0.2em;
    margin-bottom: 0.5em;
    width: 32px;
    height: 3px;
    border-radius: 40px;
}

.wp-block-column h1.has-text-align-center::after,
.wp-block-column h2.has-text-align-center::after,
.wp-block-column h3.has-text-align-center::after,
.wp-block-column h4.has-text-align-center::after,
.wp-block-column h5.has-text-align-center::after,
.wp-block-column h6.has-text-align-center::after {
    margin: 0.2em auto 0.5em auto;
}

.wp-block-column h1.has-text-align-right,
.wp-block-column h2.has-text-align-right,
.wp-block-column h3.has-text-align-right,
.wp-block-column h4.has-text-align-right,
.wp-block-column h5.has-text-align-right,
.wp-block-column h6.has-text-align-right {
    position: relative;
    margin-bottom: calc(0.5rem + 0.5em);
}

.wp-block-column h1.has-text-align-right::after,
.wp-block-column h2.has-text-align-right::after,
.wp-block-column h3.has-text-align-right::after,
.wp-block-column h4.has-text-align-right::after,
.wp-block-column h5.has-text-align-right::after,
.wp-block-column h6.has-text-align-right::after {
    position: absolute;
    bottom: -0.8em;
    right: 0;
}

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

.card-blog .post-short-description {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.5;
    /*max-height: calc(1.5em * 3);*/
}

@media (max-width: 1280px) {
    .navbar {
        overflow-y: auto;
        max-height: 100%;
    }
}
</style>
