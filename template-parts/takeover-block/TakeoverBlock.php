<?php
  $country_code= getCountryCode();
  $takeover = get_field("takeover_group");
  $todays_date = date('d/m/Y g:i a ', time());
  $countries = explode(",", strtoupper($takeover["country_code"]));

  if (
      ($takeover["show_banner"] === "true" || in_array($country_code, $countries))
      && ($takeover["start_date"] < $todays_date && $takeover["end_date"] > $todays_date)
    ):
?>
  <div class="takeover">
    <a href="<?= $takeover["go_link"] ?>">
      <?= wp_get_attachment_image($takeover["top_banner_desktop"], "full",
          "", ["class" => "top-banner-desktop"]); ?>
      <?= wp_get_attachment_image($takeover["top_banner_mobile"], "medium_large",
          "", ["class" => "top-banner-mobile"]); ?>
    </a>
  </div>
  <?php if (! is_admin() ) : ?>
    <a href="<?= $takeover["go_link"] ?>">
      <?= wp_get_attachment_image($takeover["left_banner"], "full",
          "", ["class" => "left-banner"]); ?>
    </a>
    <a href="<?= $takeover["go_link"] ?>">
      <?= wp_get_attachment_image($takeover["right_banner"], "full",
          "", ["class" => "right-banner"]); ?>
    </a>
  <?php endif; ?>
<?php endif; ?>
