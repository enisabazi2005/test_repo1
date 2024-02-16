<?php
$queried_object  = get_queried_object();
$banner_type     = get_field('banner_type', $queried_object);

global $preload_top_banner;

$country_code= getCountryCode();

?>
<?php if ($banner_type == 'custom'):
    $banners_ids = get_field('ad_banner', $queried_object);
    $banner_id   = '';
    $show_by_location = false;

    if ( ! empty($banners_ids)) {
        $locat_tax_name   = 'geo_location';
        foreach ($banners_ids as $id) {
            $locations_obj   =  wp_get_post_terms($id, 'geo_location');
            foreach ($locations_obj as $term) {
                if ($term->slug === strtolower($country_code)) {
                    $show_by_location = true;
                }
            }

            $show_for_all    = get_field('show_banners_for', $id);
            if ($show_for_all || $show_by_location) {
                $banner_id = $id;
                break;
            }
        }
    }
    if ($banner_id ): ?>
        <?php $banner_data = get_field('banner_data', $banner_id, $queried_object); ?>
        <div class="wrapper">
            <div class="banner_comparison" style="background: <?php echo $banner_data['background_color']; ?>;">
                <div class="banner_comparison_row">
                    <div class="banner_comparison--text">
                        <i style="color:<?php echo $banner_data['event_text_color'] ?>"><?php echo $banner_data['event_text'] ?></i>
                        <b>
                            <?php foreach ($banner_data['main_text'] as $key => $row): ?>
                                <span style="color: <?php echo $row['color'] ?>;"><?php echo $row['text'] ?></span><br>
                            <?php endforeach ?>
                        </b>
                        <div class="banner_comparison--btn-wrapper">
                            <a style="color:#fff;border-color: <?php echo $banner_data['border_color'] ?>"
                            href="<?php echo $banner_data['button_link'] ?>"
                                <?php echo 'claim button' ?>
                            ><?php echo $banner_data['button_text'] ?></a>
                            <p><?php echo $banner_data['terms_text'] ?></p>
                        </div>
                    </div>
                    <?php if ($banner_data['image']):
                        $preload_top_banner =  $banner_data['image'];

                        ?>
                        <div class="banner_comparison--image">
                            <span class="banner_comparison--image__gradient"
                                style="background: linear-gradient(-90deg, rgba(0, 0, 0, 0), <?php echo $banner_data['background_color']; ?>);"></span>
                            <?php echo wp_get_attachment_image( $banner_data['image'], 'full'); ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endif;
endif;
