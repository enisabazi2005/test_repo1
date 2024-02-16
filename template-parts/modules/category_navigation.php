<?php
$module = get_sub_field('block_category_nav');

$taxonomy = 'cat_tips';

$parent_slug = '';

if (isset($parent_terms)) {
    $parent = end($parent_terms);
    $parent_id = $parent->term_id;
    $parent_slug = $parent->slug;
} else {
    $post_id = get_the_ID();
    $terms = wp_get_post_terms($post_id, $taxonomy);
    $parent_term = reset($terms);
    $parent_id = $parent_term ? $parent_term->term_id : 0;
    $parent_slug = $parent_term ? $parent_term->slug : '';
}

if ($parent_id) {
    $module['subcategories'] = get_term_children($parent_id, $taxonomy);
}

if (isset($module['subcategories'])):
?>
    <div class="module module_top-tips">
        <div class="title-block"><span class="title-block_text"><?php echo $module['title']; ?></span></div>
        <div class="module_main">
            <ul class="tips_list">
                <?php foreach ($module['subcategories'] as $key => $subcategory): ?>
                    <?php
                    $term = get_term_by('id', $subcategory, $taxonomy);
                    $url = $parent_slug ? '/' . $parent_slug . '/' . $term->slug . '/' : '/' . $term->slug . '/';
                    $hideFromAside = get_field('hide_the_category_from_aside_listing', $term->taxonomy . '_' . $term->term_id);
                    if(!$hideFromAside):
                    ?>
                    <li class="tips_panel test">
                        <a href="<?php echo home_url($url); ?>" class="tips_panel-inner">
                            <div class="tips_panel-titlebox">
                                <div class="tips_panel-title">
                                    <?php echo $term->name; ?>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php 
                        endif;
                    endforeach 
                ?>
            </ul>
        </div>
    </div>
<?php endif ?>
