<?php 
$postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
<div class="social-wrapper">
    <section class="social-sharing hide">
            <div class="social-sharing__box">
                <div class="share-button">
                    <div class="social-sharing img-wrapper">
                        <img class="first" src="<?= get_template_directory_uri() ?>/assets/images/share-new.svg" alt="Share">
                        <p class="show-text"><?= __('Share', 'bettingpro') ?></p>
                        <img class="last" style="" src="<?= get_template_directory_uri() ?>/assets/images/more.svg">
                        <p class="hide-text"><?= __('Share Article', 'bettingpro') ?></p>
                        <img class="check" style="width:0; display:none;" src="<?= get_template_directory_uri() ?>/assets/images/check.svg">
                    </div>
                </div>
                <div class="share-button-parent-wrapper">
                    <div class="share-button-wrapper">
                        <div>
                            <a target="_blank" href="https://x.com/share?url=<?php echo $postUrl; ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta( 'twitter' ); ?>" title="Tweet this">
                                <img class="twttiter-icon" src="<?= get_template_directory_uri() ?>/assets/images/twitter.svg" alt="Share on Twitter">
                            </a>
                            <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo $postUrl; ?>" title="Share on Facebook">
                                <img src="<?= get_template_directory_uri() ?>/assets/images/facebook.svg" alt="Share on Facebook">
                            </a>
                            <a target="_blank" href="https://api.whatsapp.com/send?text=<?= the_title() . $postUrl; ?>">
                                <img src="<?= get_template_directory_uri() ?>/assets/images/whatsapp.svg" alt="Share on WhatsApp">
                            </a>
                            <a target="_blank" href="https://telegram.me/share?url=<?= $postUrl ?>&text=<?php the_title(); ?>">
                                <img src="<?= get_template_directory_uri() ?>/assets/images/telegram.svg" alt="Share on Telegram">
                            </a>
                            <a href="javascript:void 0" class="copy-link">
                                <img src="<?= get_template_directory_uri() ?>/assets/images/content_copy.svg" alt="Copy">
                                <!-- <span class="tooltip">Copied!</span> -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>