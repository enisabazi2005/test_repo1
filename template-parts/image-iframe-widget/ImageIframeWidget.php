<?php
$type = get_field('image_iframe_widget')['type']['value'] ?? '';
$widget_template_dir = 'widget-types';
switch ($type) {
    case "iframe":
        require($widget_template_dir . '/iframe-widget.php');    
        break;   
    default:
        require($widget_template_dir . '/image-widget.php');
}
?>
