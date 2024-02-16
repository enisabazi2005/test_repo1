<?php
$text_box = get_sub_field('text_box');
if( !empty( $text_box ) ){
    ?>
    <section class="home-text-box">
        <div class="modules-holder site-info">
            <article class="module">
                <?php
                echo $text_box;
                ?>
            </article>
        </div>
    </section>
    <?php
}