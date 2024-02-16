<?php
    $module = get_sub_field('block_custom_links');
?>
<?php if ($module['links']): ?>
    <div class="module module_top-tips">
        <div class="title-block"><span class="title-block_text"><?php echo $module['title']; ?></span></div>
        <div class="module_main">
            <ul class="tips_list">
                <?php foreach ($module['links'] as $key => $link): ?>
                    <li class="tips_panel test">
                        <a href="<?php echo $link['link']; ?>" class="tips_panel-inner">
                            <div class="tips_panel-titlebox">
                                <div class="tips_panel-title"><?php echo $link['title']; ?></div>
                            </div>
                            <div class="sidebar_nav-arrow"></div>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
<?php endif ?>