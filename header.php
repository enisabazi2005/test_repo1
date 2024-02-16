<!DOCTYPE html>

<?php
    global $post;
    if(empty(get_field('support_custom_language_attribute', $post?->ID))): ?>
        <html <?php language_attributes(); ?>>
    <?php
    else: ?>
        <html lang="<?php echo get_field('support_custom_language_attribute', $post?->ID) ?>" >
    <?php
    endif;
    ?>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
        <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" as="style" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" onload="this.onload=null;this.rel='stylesheet'" />
        <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"></noscript>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=optional" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=optional" media="print" onload="this.media='all'" />
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=optional" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=optional" media="print" onload="this.media='all'" />
        <!-- <link rel="preload" href="RobotoCondensed-ExtraLight.woff2" as="font" type="font/woff2" crossorigin> -->
        <?php wp_head(); ?>
    </head>
<body <?php body_class('overlay'); ?>>

<?php
    if (get_field('enabledisable_entry_gate', 'option') == 'enable') {
        include 'entrypop.php' ;
    }
?>

<?php

    $scrollbar_mobile = get_field('scrollbar_mobile_type');
    $scrollbar_color = get_field('scrollbar_color_type');


    if($scrollbar_mobile === 'true') {
        $scrollbar = true;
    } else {
        $scrollbar = false;
    }

?>

<div class="scrollbar_custom <?php echo $scrollbar ? 'scrollbar_active' : ''; ?>" style="width: 0%; background: <?php echo $scrollbar_color; ?>;"></div>

<header class="header header__wrap flex_container <?php echo $scrollbar ? 'header_fixed' : ''; ?>">
    <nav class="container header_content">
        <figure class="logo">
            <?php the_custom_logo(); ?>
        </figure>
        <section class="nav_container">
            <ul class="header_nav">
                <li class="header_button">
                    <button class="js_nav-toggle header_button-icon">
                        <span></span>
                        <i><?php _e('Menu', 'bettingpro'); ?></i>
                    </button>
                </li>
                <li class="header_nav-list">
                    <ul class="header_nav-list nav-list-items menu js-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'top_menu',
                            'menu_id'        => 'top_nav',
                            'menu_class'     => 'menu nav-menu js-menu',
                            'container'      => false,
                            'depth'          => 2,
                            'items_wrap'     => '%3$s',
                            'walker'         => new Walker_Main_Menu()
                        )
                    );
                    echo strip_tags(
                        wp_nav_menu(
                            array(
                                'container'      => false,
                                'theme_location' => 'main_menu',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'menu nav-menu js-menu',
                                'depth'          => 3,
                                'container'      => false,
                                'walker'         => new Walker_Main_Menu(),
                                'items_wrap'     => '%3$s',
                                'depth'          => 3,
                                'link_class'   => 'main_menu-desktop'
                            )
                        ),'<li class="main_menu-desktop"><a>' );
                    ?>
                    </ul>
                </li>
            </ul>

            <div class="searchWrapper">
                <img  class="searchIcon" src="<?= get_template_directory_uri() . '/assets/images/search-icon.svg' ?>" alt="search-icon" />
                <form role="search" method="get" class="searchBar" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="searchInputWrapper">
                        <input 
                            type="search" 
                            id="search-input" 
                            class="search-field" 
                            placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'bettingpro'); ?>" 
                            value="<?php echo get_search_query(); ?>" 
                            name="s" 
                            required
                        >
                        <button type="submit" class="search-submit"><img src="<?= get_template_directory_uri() . '/assets/images/search-icon.svg' ?>" alt="search-icon" class="searchIconInner"/></button>
                    </div>
                </form>
            </div>

            <?php
            if (has_nav_menu( 'language_switcher' )) {
                $current_lang =  str_replace( '/', '', get_blog_details()->path );

                if (empty($current_lang)) {
                    $current_lang = 'en';
                } else {
                    match (true) {
                        str_contains($current_lang, 'chile') => $current_lang = 'CL',
                        str_contains($current_lang, 'mexico') => $current_lang = 'MX',
                        str_contains($current_lang, 'peru') => $current_lang = 'PE',
                        str_contains($current_lang, 'colombia') => $current_lang = 'CO',
                        default => $current_lang,
                    };
                }
                $args = [
                    'theme_location'  => 'language_switcher',
                    'container'       => false,
                    'items_wrap'      => '<section class="language-switcher">
                                            <span class="language-opener">
                                                ' . $current_lang . '                                            
                                            </span>
                                            <ul id="%1$s" class="%2$s language-menu">%3$s</ul>
                                          </section>',
                ];
                wp_nav_menu( $args );
            }
            ?>
                <?php 

                    // $current_site_details = get_blog_details( get_current_blog_id() );
                    $country = $current_site_details->path;
                
                    if($country == '/usa/'):
                        $state = '';
                        if ( isset($_SERVER["HTTP_X_CM_GEOIP_STATE"])) {
                            $state = $_SERVER["HTTP_X_CM_GEOIP_STATE"];
                        }
                        if (isset($_COOKIE['bpstate'])) { 
                            $state = $_COOKIE["bpstate"];
                        }

                        $state = strtoupper($state);
                ?>
                <div class="states">
                    <?php

                    $states = array(
                        'AL' => 'Alabama',
                        'AK' => 'Alaska',
                        'AZ' => 'Arizona',
                        'AR' => 'Arkansas',
                        'CA' => 'California',
                        'CO' => 'Colorado',
                        'CT' => 'Connecticut',
                        'DE' => 'Delaware',
                        'FL' => 'Florida',
                        'GA' => 'Georgia',
                        'HI' => 'Hawaii',
                        'ID' => 'Idaho',
                        'IL' => 'Illinois',
                        'IN' => 'Indiana',
                        'IA' => 'Iowa',
                        'KS' => 'Kansas',
                        'KY' => 'Kentucky',
                        'LA' => 'Louisiana',
                        'ME' => 'Maine',
                        'MD' => 'Maryland',
                        'MA' => 'Massachusetts',
                        'MI' => 'Michigan',
                        'MN' => 'Minnesota',
                        'MS' => 'Mississippi',
                        'MO' => 'Missouri',
                        'MT' => 'Montana',
                        'NE' => 'Nebraska',
                        'NV' => 'Nevada',
                        'NH' => 'New Hampshire',
                        'NJ' => 'New Jersey',
                        'NM' => 'New Mexico',
                        'NY' => 'New York',
                        'NC' => 'North Carolina',
                        'ND' => 'North Dakota',
                        'OH' => 'Ohio',
                        'OK' => 'Oklahoma',
                        'OR' => 'Oregon',
                        'PA' => 'Pennsylvania',
                        'RI' => 'Rhode Island',
                        'SC' => 'South Carolina',
                        'SD' => 'South Dakota',
                        'TN' => 'Tennessee',
                        'TX' => 'Texas',
                        'UT' => 'Utah',
                        'VT' => 'Vermont',
                        'VA' => 'Virginia',
                        'WA' => 'Washington',
                        'WV' => 'West Virginia',
                        'WI' => 'Wisconsin',
                        'WY' => 'Wyoming'
                    );

                    ?>

                    <section class="language-switcher">
                        <div class="language-opener">
                        <?php if (empty($state)):?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 330" style="fill: white;width: 16px;transform: rotate(180deg);">
                                <path d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394
                                l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393
                                C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"></path>
                            </svg>
                        <?php else: ?>
                            <?php echo $state; ?>
                        <?php endif; ?>
                        </div>
                        <ul id="myDropdown" class="menu language-menu all-states">
                            <div style="display: flex;background-color: #f5f5f5;border: 1px solid #cacaca;overflow: auto;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                                <input type="text" placeholder="<?php _e( 'Search State...', 'bettingpro');?>" id="searchState" onkeyup="filterFunction()" style="padding: 11px 9px;background-color: #f5f5f5;border: none;width: 100%;">
                                <button type="submit" class="search-submit" style="background: #f5f5f5;border: none;"><img src="<?= get_template_directory_uri() . '/assets/images/search-icon.svg' ?>" alt="search-icon" class="searchIconInner"/></button>
                            </div>
                            <div style="width: 100%;position: relative;max-height: 300px;overflow: scroll;overflow-x: hidden;">
                                <?php
                                    foreach ($states as $code => $name) {
                                        $isSelected = ($state !== '' && $state === strtoupper($code)) ? 'class="current"' : '';
                                        echo "<li value=\"$code\" namestate=\"" . strtoupper($name) . "\" onclick=\"redirectToState(this.getAttribute('value'), this.getAttribute('namestate'));\" $isSelected>";
                                            echo '<a> ' . $name . '</a> ';
                                        echo "</li>";
                                    }
                                ?>
                            </div>
                        </ul>
                    </section>
                    <script>
                        function filterFunction() {
                            var input, filter, ul, li, a, i;
                            input = document.getElementById("searchState");
                            filter = input.value.toUpperCase();
                            div = document.getElementById("myDropdown");
                            a = div.getElementsByTagName("a");
                            for (i = 0; i < a.length; i++) {
                                txtValue = a[i].textContent || a[i].innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                a[i].style.display = "";
                                } else {
                                a[i].style.display = "none";
                                }
                            }
                        }
                        function redirectToState(stateCode, fullName) {
                            var expirationDate = new Date();
                            expirationDate.setFullYear(expirationDate.getFullYear() + 1);
                            document.cookie = 'bpname=' + fullName + '; expires=' + expirationDate.toUTCString() + '; path=/; secure; SameSite=Strict';
                            document.cookie = 'bpstate=' + stateCode + '; expires=' + expirationDate.toUTCString() + '; path=/; secure; SameSite=Strict';
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    </script>

                </div>
                <?php
                    endif;
                ?>

        </section>
    </nav>
    <nav class="category">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'main_menu',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'container menu nav-menu js-menu',
                'depth'          => 3,
                'container'      => false,
                'walker'         => new Walker_Main_Menu()
            )
        );
        ?>
    </nav>
</header>
<main data-sticky_parent class="<?php echo $scrollbar ? 'main_fixed' : ''; ?>">
    <div id="scrollTop" class="goTopBtn">
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 330 330" >
            <path d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394
            l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393
            C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"/>
        </svg>
    </div>
    <?php
        $queried_object      = get_queried_object();
        if (! is_404() && get_field( 'show_banner', $queried_object ) && !is_search()) {
            include( locate_template( '/template-parts/top-banner.php', false, false ) );
        }
    ?>