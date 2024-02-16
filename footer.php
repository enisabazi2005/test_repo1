</main>
<?php
if (class_exists('VCatenaStickyBanner') && method_exists('VCatenaStickyBanner', 'show_banner')) {
    VCatenaStickyBanner::show_banner();
}
?>
<footer class="footer">
    <section class="container">
        <section class="footer-social">
            <?php
            if (get_field('first_title', 'options')) {
                ?>
                <p><?php echo get_field('first_title', 'options'); ?></p>
                <?php
            }
            ?>

            <?php
            $socials = get_field('social_block', 'options');
            if ($socials) {
                ?>
                <ul class="footer-social__list">
                    <?php
                    foreach ($socials as $social) {
                        if ($social['link'] && $social['icon_class']) {
                            ?>
                            <li class="footer-social__item">
                                <a class="footer-social__link" target="_blank" rel="noopener noreferrer index-follow me"
                                   href="<?php echo $social['link']; ?>">
                                    <svg>
                                        <use
                                                xlink:href="<?php echo get_template_directory_uri(); ?>/assets/build/img/sprite.svg#<?php echo $social['icon_class']; ?>"></use>
                                    </svg>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </section>
        <?php
        $information_block = get_field('information_block', 'options');
        if ($information_block) {
            ?>
            <section class="footer_row gambling">
                <a href="<?php echo $information_block['link_gambling']['url']; ?>" target="_blank"
                   rel="noopener noreferrer nofollow"><?php echo $information_block['title']; ?></a>
            </section>
            <section class="footer_row footer_row--small">
                <p class="footer-description"><?php echo $information_block['description']; ?></p>
            </section>
            <?php
        }
        ?>
        <ul class="footer_row-list">
            <?php
            $images = get_field('block_with_logo', 'options');
            if ($images) {
                foreach ($images as $image) {
                    ?>
                    <li class="footer_row-items">
                        <a href="<?php echo $image['link']; ?>" class="footer_row-link" target="_blank"
                           rel="noopener noreferrer <?= (is_front_page()) ? "index-follow" : "nofollow"; ?>">
                            <?php echo wp_get_attachment_image($image['image_logo']['ID'] ?? '', 'footer_logo'); ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>

    </section>
    <?php
    $policy = get_field('privacy_policy', 'options');
    if ($policy) {
        ?>
        <p class="footer__copyright">
            <a href="<?php echo $policy['link_policy']; ?>"><?php echo $policy['title_policy']; ?></a>
            <span><?php echo $policy['description_policy']; ?></span>
        </p>
        <?php
    }
    ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>