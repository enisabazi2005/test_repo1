<?php 
    $bookmaker_id = get_field('image_iframe_widget')['bookmaker_select'][0] ?? '';
    $bookmaker_go_link = get_country_depended_bookmaker_link($bookmaker_id) ?? '';
    $filled_go_link = get_field('image_iframe_widget')['go_link'];
    $go_link =  !empty($filled_go_link) ? $filled_go_link : $bookmaker_go_link;
    $image_url = get_field('image_iframe_widget')['image']['url'] ?? '';
    $gtm_data = get_field('image_iframe_widget')['data_attributes'];
    $gtm_string = get_gtm_string_banner($gtm_data);
    $desktop_height = !empty(get_field('image_iframe_widget')['desktop_height']) ? get_field('image_iframe_widget')['desktop_height'] : "500";
    $mobile_height = !empty(get_field('image_iframe_widget')['mobile_height']) ? get_field('image_iframe_widget')['mobile_height'] : "300";    
?>
<a class="image-widget-container" href="<?= $go_link ?>" target="_blank" <?= $gtm_string ?>>
    <img src="<?= $image_url ?>" alt="image-widget" class="image-widget">
</a>
<style scoped>
.image-widget-container {
    height: <?= $desktop_height?>px;
}
@media (max-width: 768px) {
    .image-widget-container {
        height: <?= $mobile_height ?>px;
    }
}
</style>