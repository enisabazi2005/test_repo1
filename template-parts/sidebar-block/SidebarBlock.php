<?php
$sidebar = get_field( 'sidebar' );
?>
<div class="tips-list-sidebar">
    <div class="title-block">
        <span class="title-block_text"><?= $sidebar['sidebar-title'] ?></span>
    </div>
    <div class="module_main">
        <ul class="tips_list">
        <?php 
            if(is_array($sidebar['list'])) :
                foreach ($sidebar['list'] as $row) : 
        ?>
                    <li class="tips_panel">
                        <?php if(is_array($row['title_link'])) : ?>
                            <a href="<?= $row['title_link']['url'] ?>" class="tips_panel-inner">
                                <div class="tips_panel-titlebox">
                                    <div class="tips_panel-title">
                                    <?= $row['title_link']['title'] ?>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </li>
        <?php
                endforeach;
            endif; 
        ?>
        </ul>
    </div>
</div>