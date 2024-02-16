<?php get_header(); ?>
<div class="container">
    <div class="not-found">
        <div class="not-found__text">
            <h3>Oops!</h3>
            <b><?php _e('We can’t find the page you’re looking for.', 'bettingpro'); ?></b>
            <p><?php _e('Please go back to the homepage by clicking the link below.', 'bettingpro'); ?></p>
            <a href="<?= get_home_url() ?>"><?php _e( 'Back to homepage', 'bettingpro'); ?></a>
        </div>
        <div class="not-found__error">
            <div class="not-found__error__image" 
                style="background-image: url(<?= get_template_directory_uri() ?>/assets/images/error_bg.png);">
                <span><?php _e( 'error 404', 'bettingpro'); ?></span>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>