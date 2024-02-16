<?php
    /*
        Template Name: Author List
        Template Post Type: page
    */
?>
<?php
get_header();
$authors = get_field('authors_list');

if (!empty($authors)) {
    ?>
    <h1 class='container authors-list-title'>
        <?php _e('BettingPro authors:', 'bettingpro'); ?>
    </h1>
     <div class="container">
        <div class="authors-list">
    <?php
    foreach ($authors as $author) {
        $author_name = $author->data->display_name;
        $author_url = get_author_posts_url($author->data->ID);
        $author_avatar = get_avatar($author->data->ID); 
    ?>
        <div class="authors-list_author">
            <a class="authors-list_author_avatar" href="<?=  esc_url($author_url) ?>"> <?= $author_avatar ?></a>
            <a class="authors-list_author_name" href="<?=  esc_url($author_url) ?>"> <?= esc_html($author_name) ?></a>
        </div>       
    <?php
    }
} else {
    echo 'No authors found.';
}
    ?>
    </div>
 </div>
<?php get_footer();