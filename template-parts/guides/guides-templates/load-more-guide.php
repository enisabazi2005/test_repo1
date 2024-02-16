<div class="module">
    <a href="<?= get_permalink() ?>" class="module__link">
        <div class="module__link__image">
            <?= the_post_thumbnail('medium'); ?>
        </div>
        <div class="module__link__text">
            <span><?= the_title() ?></span>
        </div>
    </a>
</div>