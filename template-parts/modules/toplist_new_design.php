<?php
$toplist_heading = get_sub_field('toplist_heading');
$toplist = get_sub_field('toplist');

?>
<?php if ( $toplist ): ?>
<div class="bookmakers">
<?php if( $toplist_heading ):
        ?>
        <div class="title-block"><h2 class="title-block_text"><?php echo $toplist_heading; ?></h2></div>
        <?php
    endif; ?>
    <div class="bookmaker_rows">
        <?php echo $toplist; ?>
    </div>
</div>
<?php endif; ?>