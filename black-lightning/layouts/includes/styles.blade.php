<style>
.wp-block-button__link {
    background: #cb914f;
    border-radius: 0!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid #cb914f!important;
        color: #cb914f!important;
}

.wp-block-button__link:hover {
    background: #cb914f;
    color: #fff!important;
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
</style>

<!-- Color styles -->
<style>
@if (! empty($template_colors['button']['background']))
.btn.btn-primary {
    background-color: {{ $template_colors['button']['background'] }} !important;
    border-color: {{ $template_colors['button']['background'] }} !important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid {{ $template_colors['button']['background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['text']))
.btn.btn-primary {
    color: {{ $template_colors['button']['text'] }} !important;
}
.is-style-outline .wp-block-button__link {
        color: {{ $template_colors['button']['text'] }}!important;
}
@endif

@if (! empty($template_colors['button']['hover_background']))
.btn.btn-primary:before, .btn.btn-primary:hover,
.page-item.active .page-link, .page-link:hover {
    background-color: {{ $template_colors['button']['hover_background'] }} !important;
    border-color: {{ $template_colors['button']['hover_background'] }} !important;
}
.is-style-outline .wp-block-button__link:hover {
       border: 2px solid {{ $template_colors['button']['hover_background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['hover_text']))
.btn.btn-primary:hover,
.page-item.active .page-link, .page-link:hover {
    color: {{ $template_colors['button']['hover_text'] }} !important;
}
.is-style-outline .wp-block-button__link:hover {
       color: {{ $template_colors['button']['hover_text'] }}!important;
}
@endif

@if (! empty($template_colors['page_background']['base']))
body {
    background: {{ $template_colors['page_background']['base'] }};
}
@endif

@if (! empty($template_colors['footer_background']['base']))
footer, .footer-bottom {
    background-color: {{ $template_colors['footer_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['text']))
footer, .footer-widget-desc, .footer-widget-title, .footer-widget-nav>li>a,
.footer-copyright, .footer-link {
    color: {{ $template_colors['footer_background']['text'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['hover_link']))
.footer-widget-nav>li>a:hover, .footer-link:hover {
    color: {{ $template_colors['footer_background']['hover_link'] }} !important;
}
@endif

@if (! empty($template_colors['titles']['base']))
h1, h2, h3, h4, h5,
h1 a, h2 a, h3 a, h4 a, h5 a {
    color: {{ $template_colors['titles']['base'] }} !important;
}
a:hover {
    color: {{ $template_colors['titles']['base'] }};
}
@endif

@if (! empty($template_colors['links']['color']))
a {
    color: {{ $template_colors['links']['color'] }}!important;
}
@endif

@if (! empty($template_colors['menu']['base']))
.main-nav > li > a {
    color: {{ $template_colors['menu']['base'] }};
}
@endif
@if (! empty($template_colors['menu']['hover']))
.main-nav > li > a:hover, .main-nav > li.has-submenu:hover > a {
    color: {{ $template_colors['menu']['hover'] }};
}
@endif
@if (! empty($template_colors['menu']['selected']))
.main-nav > li > a.active {
    color: {{ $template_colors['menu']['selected'] }};
}
@endif

@if (! empty($template_colors['block_background']['base']))
.event-item,
.section-bg-color-shape,
.wp-block-group {
    background: {{ $template_colors['block_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['events']['background']))
.event-block {
    background: {{ $template_colors['events']['background'] }}!important;
}
@endif

@if (! empty($template_colors['additional_elements']['base']))
.feature-item:hover .icon .bg,
.event-item .content .details .title a:hover {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.feature-item:after, 
.scroll-to-top, 
.swiper-pagination-bullet-active, 
.sidebar-search-widget form button, 
.sidebar-category-list li a.active,
.sidebar-category-list li a:hover {
    background-color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.sidebar-search-widget form button:hover,
.sidebar-category-list li a.active:hover {
    background-color: #000 !important;
}
@endif

.event-location {
    display: block;
    max-width: 98%;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}

.event-short-description, .post-short-description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.hero-slide-sub-title {
    max-width: 545px!important;
}

.wp-block-column {
padding: 0 10px;
}
.wp-block-ens-custom-image:hover img {
  transform: scale(1.05);
  -webkit-transform: scale(1.05);
  -moz-transform: scale(1.05);
  -ms-transform: scale(1.05);
  -o-transform: scale(1.05);
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
