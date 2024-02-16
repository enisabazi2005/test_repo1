<?php 

$post_id  = get_the_ID();
$taxonomy = 'cat_tips';

$terms              = wp_get_post_terms($post_id, $taxonomy);
$sidebar_id         = false;
$content_modules_id = false;

if ($terms) {
    $name_term = $terms[0]->name;
    $id_term   = $terms[0]->term_id;

    $ancestors       = get_ancestors($id_term, $taxonomy);
    $id_parent_terms = $ancestors ? array_merge(array($id_term), $ancestors) : array($id_term);

    $parent_terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'orderby'  => 'include',
        'include'  => $id_parent_terms
    ));


    foreach ($parent_terms as $key => $t) {
        if (have_rows('inner_aricles_sb_builder', $t)) {
            $sidebar_id = $t;
            break;
        }
    }

    foreach ($parent_terms as $key => $t) {
        if (have_rows('inner_aricles_builder', $t)) {
            $content_modules_id = $t;
            break;
        }
    }
}
if (have_rows('inner_aricles_sb_builder')) {
    while (have_rows('inner_aricles_sb_builder')) {
        the_row();
        $layout = get_row_layout();
        include(locate_template("/template-parts/modules/$layout.php", false, false));
    }
    } elseif ($sidebar_id) {
        while (have_rows('inner_aricles_sb_builder', $sidebar_id)) {
            the_row();
            $layout = get_row_layout();
            include(locate_template("/template-parts/modules/$layout.php", false, false));
        }
    }
    if (is_active_sidebar('sidebar-best-bookmakers')) :
        dynamic_sidebar('sidebar-best-bookmakers');
    endif;