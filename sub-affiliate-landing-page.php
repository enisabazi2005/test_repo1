<?php
    /*
        Template Name:  Sub-Affiliate Landing Page
        Template Post Type: page
    */
?>
<?php 
    wp_head();
    $logo = get_field('logo')['url'] ?? '';
    $desktop_bg = get_field('background')['desktop_background'] ?? '';
    $mobile_bg = get_field('background')['mobile_background'] ?? '';
    $cta_bg = get_field('cta')['cta_color'] ?? '';
    $cta_text = get_field('cta')['cta_text'] ?? '';
    $cta_link = get_field('cta')['cta_link'] ?? '';
    $above_cta_text = get_field('above_cta_text') ?? '';
    $bottom_disclaimer = get_field('bottom_disclaimer') ?? '';
    $page_link = get_field('page_link') ?? '';
?>
    <?php if($page_link !== ''): ?>
        <a class="sub_affiliate_page" href="<?= $page_link ?>">
    <?php else: ?>
        <div class="sub_affiliate_page">
    <?php endif; ?>
            <div class="page_background">
                <div class="page_content">
                    <img src="<?= $logo ?>" alt="">
                    <h2><?= $above_cta_text ?></h2>
                    <div class="cta_button">
                        <?php if($page_link !== ''): ?>
                        <button class="cta_link" style="background-color: <?php echo $cta_bg?>;">
                            <?= $cta_text ?>
                        </button>
                        <?php else: ?>
                        <a href="<?php echo $cta_link ?>" class="cta_link" style="background-color: <?php echo $cta_bg?>;">
                            <?= $cta_text ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <p><?= $bottom_disclaimer ?></p>
                </div>
            </div>
    <?php if($page_link !== ''): ?>
        </div>
    <?php else: ?>
        </div>
    <?php endif; ?>

<style>
    .page_background {
      background-image:  url('<?php echo $desktop_bg['url'] ?>');
    }
  @media (max-width: 767px) {
    .page_background {
      background-image:  url('<?php echo $mobile_bg['url'] ?? $desktop_bg['url'] ?>');
    }
  }
</style>
