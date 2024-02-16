<?php 
    $query->the_post();
    $custom_date_tips = get_field('tips_fields', get_the_ID())['custom_date_tips'] ?? '';
    if ($current === 1 || $current === 2) :
?>
<div class="latest-news__holder__article other_article">
    <div class="latest-news__holder__article__image">
        <?=  the_post_thumbnail('medium') ?? '' ?>
    </div>
    <div class="latest-news__holder__article__text">
         <?php if (isset($taxname[0]->name)) : ?>
            <span class="latest-news__holder__article__text__tag">
                <?= $taxname[0]->name ?? '' ?>
            </span>
        <?php endif; ?>
        <a href="<?= the_permalink() ?? ''  ?> ">
            <p class="latest-news__holder__article__text__title">
                <?= substr(strip_tags(get_the_title()), 0, 53) ?? '' ?></p>
        </a>
        <div class="latest-news__holder__article__text__info">
            <div class="date_wrapper">
                <img class="stadiumIcon" src="<?= get_template_directory_uri() . '/assets/images/stadium-icon.svg' ?>" alt="search-icon" />
                <time datetime="<?= $custom_date_tips ?>"><?= $custom_date_tips ?></time>
            </div>
            <p onclick="mask_a_tag('<?= the_permalink(); ?>')">
                <a href="<?= the_permalink() ?>"
                    alt="<?= get_the_title() ?>"><?php _e('Read More', 'bettingpro'); ?></a>
            </p>
            
        </div>
    </div>
</div>
<?php 
  endif;
?>