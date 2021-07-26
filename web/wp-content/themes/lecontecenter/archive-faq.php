<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */

get_header(); ?>
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
                <div class="social-button-wrapper social-twitter"> <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a> </div>
                <div class="social-button-wrapper social-googleplusone">
                    <div  class="g-plusone " data-annotation="inline" data-size="medium" data-width="80"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools"> <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt="" /></a> </div>
    </div>
</section>
    
<section class="container pageContent">
    <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix title-brown-text removePadding">
    <h2 class="content-title">Frequently Asked Questions</h2>
    <?php 
    if ( have_posts() ){
        // Start the Loop.
        $i = 0;
        while ( have_posts() ){
            the_post();
            ?>
            <div class="faq-row">
              <h3><?php the_title();?></h3>
              <div class="faq-content"><?php the_content();?></div>
            </div>
        <?php 
            $i++;
            if($i==6){
            ?>
            <div class="row" style="margin-right: 0px; margin-left: 0px;">
                <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 callForTour Widget widget--content-block clearfix">
                    <p>Call: <a class="mobileNum" href="tel:+8654297432">865-429-7432</a> or <a class="mailTo" href="mailto:info@lecontecenter.com">Email Us</a> <span class="subParagraph">for more info or to schedule an onsite tour.</span></p>
                </div>
            </div>
            <?php      
            }
        }
        // Previous/next page navigation.
        // the_posts_pagination( array(
        //     'prev_text'          => __( 'Previous page', 'lecontecenter' ),
        //     'next_text'          => __( 'Next page', 'lecontecenter' ),
        //     'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'lecontecenter' ) . ' </span>',
        // ) );
    }
    else{
        get_template_part( 'template-parts/content', 'none' );
    }
    ?>                 
</section>

<?php get_footer();