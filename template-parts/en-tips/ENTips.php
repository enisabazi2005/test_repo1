<?php
$template = get_field('en_tips')['en_templates'] ?? '';
$tips_template_dir = 'en-tips-templates';
switch ($template) {
    case "more_news":
        require ($tips_template_dir . '/more-news.php');    
        break;
    case "latest_news":
        require ($tips_template_dir . '/latest-news.php');    
        break;
    case "category_features":
        require ($tips_template_dir . '/category-features.php');    
        break;    
    default:
        require ($tips_template_dir . '/top-tips.php');
}
?>