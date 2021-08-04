<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:Site Map
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header(); 
?>
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
                    <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
                </div>
                <div class="social-button-wrapper social-googleplusone">
                    <div  class="g-plusone " data-annotation="inline" data-size="medium" data-width="80"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools">
            <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt="" /></a>
        </div>
    </div>
</section>
<section class="container pageContent">
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix  title-brown-text removePadding">
            <h2 class="content-title">Sitemap</h2>
            <div class="secondaryTileCopy">
                <?php echo wp_nav_menu( array('menu' => 'Site Map Menu','theme_location' =>'site_map', 'echo' => false ));?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();