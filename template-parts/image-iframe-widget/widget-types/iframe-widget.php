<?php 
    $bookmaker_id = get_field('image_iframe_widget')['bookmaker_select'][0] ?? '';
    $bookmaker_go_link = get_country_depended_bookmaker_link($bookmaker_id) ?? '';
    $filled_go_link = get_field('image_iframe_widget')['go_link'];
    $go_link =  !empty($filled_go_link) ? $filled_go_link : $bookmaker_go_link;
    $iframe_src = get_field('image_iframe_widget')['iframe_src'] ?? '';
    $gtm_data = get_field('image_iframe_widget')['data_attributes'];
    $gtm_string = get_gtm_string_banner($gtm_data);
    $desktop_height = !empty(get_field('image_iframe_widget')['desktop_height']) ? get_field('image_iframe_widget')['desktop_height'] : "500";
    $mobile_height = !empty(get_field('image_iframe_widget')['mobile_height']) ? get_field('image_iframe_widget')['mobile_height'] : "300";
?>
<div class="iframe-container">
    <iframe id="iframeWidget"
        title="Iframe Widget"
        class="iframe-widget"
        src="<?= $iframe_src ?>">
    </iframe>
    <a href="<?= $go_link ?>" target="_blank" class="iframe-widget-link" <?= $gtm_string ?>></a>
</div>
<style scoped>
.iframe-widget {
    height: <?= $desktop_height ?>px;
}
@media (max-width: 768px) {
    .iframe-widget {
        height: <?= $mobile_height ?>px;
    }
}
</style>