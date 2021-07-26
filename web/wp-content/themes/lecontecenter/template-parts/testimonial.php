<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:Testimonial
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header(); 
$testimonials_page_id = get_the_ID(); 
$banner_image = get_post_meta($testimonials_page_id ,'page_single_image',true);
$get_banner_image = wp_prepare_attachment_for_js($banner_image);
$get_image_type = get_post_meta($testimonials_page_id ,'page_image_type',true);
?>
<section  class="container hero mobile">
    <div class="row heroPrimary removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding">
           <?php 
            if($get_image_type=="normal"){
            ?>    
            <img src="<?php echo $get_banner_image['url']; ?>" alt="" />
            <?php } 
            ?>
            <h2 class="heroTitle"><?php the_title();?></h2>
        </div>
    </div>
    <div class="row heroSecondary removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding">
            <?php 
            if($get_image_type=="normal"){
            ?>    
            <img src="<?php echo $get_banner_image['url']; ?>" alt="" />
            <?php } 
            ?>
           
        </div>
    </div>
</section>
<section  class="container hero desktop">
    <div class="row heroPrimary removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding">
            <?php 
            if($get_image_type=="normal"){
            ?>    
            <img src="<?php echo $get_banner_image['url']; ?>" alt="" />
            <?php } 
            ?>
            <h2 class="heroTitle"><?php the_title();?></h2>
        </div>
    </div>
</section>
<section id="LCfeatures" class="container aboutLC">
    <div class="row moreInfo" style="margin-right: 0px; margin-left: 0px;">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 social_title">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('
                <p id="breadcrumbs">','</p>
                ');
                }
            ?>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
            <div class="social-share">
                <div class="social-button-wrapper social-facebook">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
                </div>
                <div class="social-button-wrapper social-twitter">
                    <a href="https://twitter.com/share"  class="twitter-share-button" data-count="horizontal">Tweet</a>
                </div>
                <div class="social-button-wrapper social-googleplusone">
                    <div class="g-plusone " data-annotation="inline" data-size="medium" data-width="80"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools">
            <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt="" /></a>
        </div>
    </div>
</section>
<section class="container pageContent testimonial testimonial_edit">
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 history widget--content-block clearfix">
        <?php 
    	if ( have_posts() ) {
    		while ( have_posts() ) {
    			the_post();
        		the_content();
        	}
        }
        ?>
        </div>
    </div>
    <div class="testimonial-section">
      <?php 
    #Testimonial Section Start
        $args = array(
        'post_type' => 'testimonials',
        'posts_per_page'=> -1,
        'post_status' => 'publish'
        );
        $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();?>
        <div class="test-box">
            <div class="test-img"><?php the_post_thumbnail();?></div>
            <div class="content_for_mobile">
                <span></span>
                <h3><?php the_title();?></h3>
                <div><?php the_content();?></div>
            </div>
            <div class="testspacer"></div>
         	
        </div> 
        <?php 
         		}
                 wp_reset_postdata();
         	}
        #Testimonial Section end
         ?>
    </div>
    <div class="green-testimonial">Call : <a href="tel:8654297435"><?php echo $lecontecenter_theme_options['site_phone_no'];?></a> or <a href="mailto:">Email Us</a> <?php echo $lecontecenter_theme_options['site_email'];?></div>
</section>
<?php
get_footer();