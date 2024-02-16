<?php
    $module = get_sub_field('block_banner');
?>
<?php if ($module['image']): ?>
    <div class="sidebar-banner">
        <a href="<?php echo $module['link'] ?>" class="sidebar-banner__inner">
            <img src="<?php echo $module['image']['url']; ?>" alt="<?php echo $module['image']['alt']; ?>" class="sidebar-banner__img">
        </a>
    </div>
<?php endif ?>