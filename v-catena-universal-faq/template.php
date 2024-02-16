<?php

    $q_bg                = get_field( 'vcu_faq_q_bg_colour', 'option' ) ?: '#fff';
    $q_bg_hover          = get_field( 'vcu_faq_q_bg_hover_colour', 'option' ) ?: '#e60101';
    $q_text_colour       = get_field( 'vcu_faq_q_text_colour', 'option' ) ?: '#000';
    $q_text_hover_colour = get_field( 'vcu_faq_q_text_hover_colour', 'option' ) ?: '#fff';
    $ans_bg              = get_field( 'vcu_faq_ans_bg_colour', 'option' ) ?: 'transparent';
    $ans_text_colour     = get_field( 'vcu_faq_ans_text_colour', 'option' ) ?: '#000';
    $arrow_colour        = get_field( 'vcu_faq_arrow_colour', 'option' ) ?: '#000';
    $arrow_hover         = get_field( 'vcu_faq_arrow_hover_colour', 'option' ) ?: '#fff';

    echo ! empty( $atts['title'] ) ? '<h3>' . esc_html( $atts['title'] ) . '</h3>' : '';
    echo ! empty( $atts['sub_title'] ) ? '<p>' . esc_html( $atts['sub_title'] ) . '</p>' : '';

?>
<ul class="vcu_faq-accordion-wrapper">
	<?php foreach ( $faq_section_items as $faq_section_item ): ?>
		<li class="vcu_faq-accordion-item">
			<div class="js--vcu_faq-accordion-title vcu_faq-accordion-title">
				<h3 class="vcu_faq-accordion-title-text">
                    <?php echo esc_html( $faq_section_item->post_title ); ?>
                </h3>
				<svg class="arrow" width="7" height="6" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
							d="M4.39668 4.93467C4.19654 5.19549 3.80346 5.19549 3.60332 4.93467L0.434041 0.804381C0.181673 0.475488 0.416157 0 0.830717 0L7.16928 0C7.58384 0 7.81833 0.475488 7.56596 0.804381L4.39668 4.93467Z"
							fill="#E60101">
					</path>
				</svg>
			</div>
			<div class="vcu_faq-accordion-panel">
				<div class="vcu_faq-accordion-content">
					<?php echo wp_kses_post( strip_shortcodes( $faq_section_item->post_content ) ); ?>
                </div>
			</div>
			<noscript>
				<div class="vcu_faq-accordion-panel" style="max-height:1000vh">
					<div class="vcu_faq-accordion-content">
						<?php echo wp_kses_post( strip_shortcodes( $faq_section_item->post_content ) ); ?>
                    </div>
				</div>
			</noscript>
			<style type="text/css">
                /**
                * Style overides based on user definition
                */
                .vcu_faq-accordion-title {
                    background-color: <?php echo esc_attr( $q_bg ); ?>;
                    color: <?php echo esc_attr( $q_text_colour ); ?>;
                }

                .vcu_faq-accordion-title.isActive {
                    background-color: <?php echo esc_attr( $q_bg_hover ); ?>;
                    color: <?php echo esc_attr( $q_text_hover_colour ); ?>;
                }

                .vcu_faq-accordion-title .arrow path {
                    fill: <?php echo esc_attr( $arrow_colour ); ?>;
                }

                @media (hover: hover) {
                    .vcu_faq-accordion-title:hover {
                        background-color: <?php echo esc_attr( $q_bg_hover ); ?>;
                        color: <?php echo esc_attr( $q_text_hover_colour ); ?>;
                    }

                    .vcu_faq-accordion-title:hover .arrow path {
                        fill: <?php echo esc_attr( $arrow_hover ); ?>;
                    }
                }

                .vcu_faq-accordion-title.isActive .arrow path {
                    fill: <?php echo esc_attr( $arrow_hover ); ?>;
                }

                .vcu_faq-accordion-content {
                    background-color: <?php echo esc_attr( $ans_bg ); ?>;
                    color: <?php echo esc_attr( $ans_text_colour ); ?>;
                }
			</style>
		</li>
    <?php endforeach; ?>
</ul>