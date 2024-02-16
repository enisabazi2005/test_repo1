<?php
$text_block = get_sub_field('text_block');
if (!empty($text_block)) :
    ?>
        <div class="module text-block">
            <?php
            echo $text_block;
            ?>
        </div>
    <?php
endif;