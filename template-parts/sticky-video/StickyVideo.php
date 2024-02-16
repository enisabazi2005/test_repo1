<?php
$fields = get_field('sticky_video');
$upload_video = $fields['upload_video']['url'] ?? '';
$video_link = $fields['video_link'] ?? '';
?>

<div class="allContainer">
    <div class="videoContainer">
        <?php if (!empty($upload_video)): ?>
            <video class="stickyVideo" autoplay muted controls disablePictureInPicture controlsList="nodownload">
                <source src="<?= $upload_video ?>" type="video/mp4" >
            </video>
        <?php endif; ?>

        <?php if (!empty($video_link)): ?>
            <iframe class="stickyVideo" src="<?= $video_link ?>?autoplay=1&mute=1" title="BettingPro Video" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; web-share" allowfullscreen></iframe>
        <?php endif; ?>
    </div>  
</div>