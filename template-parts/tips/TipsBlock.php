<?php
$template = get_field('tips')['tips_template'] ?? '';
$tips_template_dir = 'tips-templates';
switch ($template) {
    case "more_news":
        require($tips_template_dir . '/more-news.php');    
        break;
    case "latest_news":
        require($tips_template_dir . '/latest-news.php');    
        break;
    case "category_features":
        require($tips_template_dir . '/category-features.php');    
        break;    
    default:
        require($tips_template_dir . '/top-tips.php');
}
?>