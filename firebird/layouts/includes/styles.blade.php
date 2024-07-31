<style>
.custom-button {
    padding: 6px 12px;
}
.wp-block-button__link {
    background: #f07b26;
    border-radius: 0!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid #f07b26;
        color: #f07b26!important;
}

.wp-block-button__link:hover {
    background: #bc570d;
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
@if (! empty($template_colors['titles']['base']))
h1, h2, h3, h4, h5,
h1 a, h2 a, h3 a, h4 a, h5 a {
    color: {{ $template_colors['titles']['base'] }}!important;
}
@endif

a.button {
    padding: 5px;
    width: fit-content;
}

@if (! empty($template_colors['button']['background']))
.wp-block-button__link, .button a, button, .btn1, a.button {
    background: {{ $template_colors['button']['background'] }}!important;
}
.is-style-outline .wp-block-button__link {
        border: 2px solid {{ $template_colors['button']['background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['text']))
.wp-block-button__link, .button a, button, .btn1, a.button {
    color: {{ $template_colors['button']['text'] }}!important;
}
.is-style-outline .wp-block-button__link {
        color: {{ $template_colors['button']['text'] }}!important;
}
@endif

@if (! empty($template_colors['button']['hover_background']))
.wp-block-button__link:hover, .button a:hover, button:hover, .btn1:hover, a.button:hover {
    background: {{ $template_colors['button']['hover_background'] }}!important;
}
.blog .blog-pagination li.active a, .blog .blog-pagination li:hover a {
    background-color: {{ $template_colors['button']['hover_background'] }}!important;
    border-color: {{ $template_colors['button']['hover_background'] }}!important;
}
.is-style-outline .wp-block-button__link:hover {
       border: 2px solid {{ $template_colors['button']['hover_background'] }}!important;
        background: #fff!important;
}
@endif

@if (! empty($template_colors['button']['hover_text']))
.wp-block-button__link:hover, .button a:hover, button:hover, .btn1:hover, a.button:hover,
.blog .blog-pagination li.active a:hover, .blog .blog-pagination li:hover a {
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
.footer, .footer_section {
    background-color: {{ $template_colors['footer_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['text']))
.footer, .footer-link, .footer_section p {
    color: {{ $template_colors['footer_background']['text'] }}!important;
}
@endif

@if (! empty($template_colors['footer_background']['hover_link']))
.footer-link:hover {
    color: {{ $template_colors['footer_background']['hover_link'] }} !important;
}
.info_section .contact_nav a:hover {
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
.nav-link.active {
    color: {{ $template_colors['menu']['selected'] }}!important;
}
@endif

@if (! empty($template_colors['block_background']['base']))
.row-block {
    background: {{ $template_colors['block_background']['base'] }}!important;
}
@endif

@if (! empty($template_colors['additional_elements']['visible']))
.about_section .img-box::before, .about_section .img-box::after {
  content: "";
  position: absolute;
  top: 50%;
  width: 45px;
  height: 70%;
  background-color: #f07b26;
  z-index: 3;
}

.about_section .img-box::before {
  left: 0;
  z-index: 3;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.about_section .img-box::after {
  right: 0;
  z-index: 1;
  -webkit-transform: translate(50%, -50%);
          transform: translate(50%, -50%);
}
@endif

@if (! empty($template_colors['additional_elements']['base']))
.about_section .img-box::before, .about_section .img-box::after {
    background-color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.slider_section .carousel-indicators li.active {
    background-color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.header_section .header_top .contact_nav a i {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.client_section .box .client_info i {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
}
.service_section .box .detail-box a.active,
.detail-box li a:hover,
.entry-title a:hover,
.blog .blog-pagination li a {
    color: {{ $template_colors['additional_elements']['base'] }} !important;
}
@endif

.wp-block-column {
padding: 0 10px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
line-height: inherit!important;
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
