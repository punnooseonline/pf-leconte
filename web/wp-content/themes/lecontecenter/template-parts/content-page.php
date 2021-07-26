<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
?>
<section class="container pageContent">
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-block clearfix removePadding">


		<?php lecontecenter_post_thumbnail(); ?>

	
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lecontecenter' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'lecontecenter' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>		
		</div>
    </div>
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 callForTour widget--content-block clearfix">
              <p>Call: <a class="mobileNum" href="tel:+8654297432">865-429-7432</a> or <a class="mailTo" href="mailto:info@lecontecenter.com">Email Us</a> <span class="subParagraph">for more info or to schedule an onsite tour.</span></p>
        </div>
    </div>
</section>