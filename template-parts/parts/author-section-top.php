<?php 
    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author();
    $author_link = get_author_posts_url( $author_id );
    $author_avatar = get_avatar( $author_id);
    $helper = \Bettingpro\Includes\Helper::getInstance();
    $author_description = get_the_author_meta('description', $author_id);
    $reviewer_name = get_field("reviewer")['display_name'] ?? '';
    $reviewer_desc = get_field("reviewer")['user_description'] ?? '';
    $reviwer_id = get_field("reviewer")["ID"] ?? '';
    $reviewer_link =  get_author_posts_url($reviwer_id);
    $utc_offset = get_option('gmt_offset');
    $timezone = " UTC" . ($utc_offset >= 0 ? '+' . $utc_offset : $utc_offset);
    $read_time = get_field("read_time") ?? '';
    $published_date = get_the_date("F j, Y | H:i") . $timezone;
    $modified_date = $helper->getModifiedDate(date_format: "F j, Y | H:i") . $timezone;
    $published_text = __('Published on:', 'bettingpro');
    $modified_text = __('Last Updated:', 'bettingpro');
?>
<address class="single-tips__author-box wrapper">
    <div class="single-tips__author-box__wrapper">
        <div class="post_author">
            <div class="post_author_first">
                <div class="single-tips__author-box__wrapper__image">
                    <figure class="single-tips__author-box__wrapper__image__postimage">
                    <?= $author_avatar ?>
                    </figure>
                    <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#verified"></use></svg>
                </div>
                <span class="single-tips__author-box__wrapper__users">
                    <p class="single-tips__author-box__wrapper__users__label"><?php _e('Published By', 'bettingpro'); ?>:</p>
                    <div class="single-tips__author-box__wrapper__users__author-name" rel="author">
                        <span><?php echo $author_name ?></span>
                        <div class="empty">
                            <div class="polygon"></div>
                            <div class="author-description">
                                <p><?=  $author_description ?></p>
                                <a href="<?= $author_link ?>"><?php _e('Read More', 'bettingpro'); ?></a>
                            </div>
                        </div>
                    </div>
                </span>
            </div>
            <?php if($reviewer_name) : ?>
            <span class="single-tips__author-box__wrapper__users reviewer">
                <p class="single-tips__author-box__wrapper__users__label"><?php _e('Review By', 'bettingpro'); ?>:</p>
                <div class="single-tips__author-box__wrapper__users__author-name reviewer-name" rel="author">
                    <span><?php echo $reviewer_name ?></span>
                    <div class="empty">
                        <div class="polygon"></div>
                        <div class="author-description">
                            <p><?= $reviewer_desc ?></p>
                            <a href="<?= $reviewer_link ?>"><?php _e('Read More', 'bettingpro'); ?></a>
                        </div>
                    </div>
                </div>
            </span>
            <?php endif; ?>
        </div>
        <div class="post_date">
        <div class="post_date__modified">
            <div class="post_date__modified__wrapper">
                <p><?= ($published_date !== $modified_date) ? $modified_text : $published_text; ?></p>
            </div>
            <time class="postdate-mod" 
                datetime="<?= ($published_date !== $modified_date) ? $helper->getModifiedDate(date_format: "Y-m-d\TH:i:sP") : get_the_date("Y-m-d\TH:i:sP"); ?>">
                <?= ($published_date !== $modified_date) ? $modified_date : $published_date; ?>
            </time>
        </div>
            <?php if($read_time) : ?>
            <div class="post_date__modified">
                <div class="post_date__modified__wrapper">
                    <p><?php _e('Read Time:','bettingpro'); ?></p>
                </div>
                <p class="read-time">
                    <?= _e('Approx.','bettingpro') . " " . $read_time ?> <?php _e('minutes','bettingpro'); ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
        <div class="publisher_desc">
            <div class="polygon"></div>
            <div class="author-description">
                <p><?=  $author_description ?></p>
                <a href="<?= $author_link ?>"><?php _e('Read More', 'bettingpro'); ?></a>
            </div>
        </div>
        <?php if (!empty($reviwer_id)) : ?>
        <div class="reviewer-desc">
            <div class="polygon"></div>
            <div class="author-description">
                <p><?= $reviewer_desc ?></p>
                <a href="<?= $reviewer_link ?>"><?php _e('Read More', 'bettingpro'); ?></a>
            </div>
        </div>
        <?php endif; ?>

    </div>
</address>