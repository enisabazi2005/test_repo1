<?php $widget_fields = get_sub_field('author'); ?>
<div class="author-widget">
    <h4 class="author-widget-title"><?= $widget_fields['title'] ? $widget_fields['title'] : ''?></h4>
    <?php 
    if ($widget_fields['authors']) :
        foreach ( $widget_fields['authors'] as $user ) :
            ?> 
            <a href="<?= get_author_posts_url($user) ?>">
                <div class="author-widget__section">
                    <div class="author-widget__section__image">
                        <?= get_avatar($user, $size = 60, $default = '', $alt = 'avatar', $args = [ 'class' => 'author-widget__section__image__avatar' ]); ?>
                    </div>
                    <div class="author-widget__section__text">
                        <p class="author-widget__section__text__display-name"><?= get_userdata($user)->display_name ?></p>
                        <p><?= substr(get_the_author_meta('user_description', $user), 0, 100) ?><?= strlen(get_the_author_meta('user_description', $user)) > 100 ? '...' : '' ?></p>
                    </div>
                </div>
            </a>
        <?php
        endforeach;
    endif;
    ?>
</div>
