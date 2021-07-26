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
                    <div class="g-plusone " data-annotation="inline" data-size="medium" data-width="80"></div>
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
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 10px;">
            <div class="row removeMargins">
            	<?php 
            	if ( have_posts() ){
					// Start the Loop.
					while ( have_posts() ){
						the_post();
						$coupon_id = get_the_ID();
						$coupon_address_1 = get_post_meta($coupon_id, 'coupon_address_1', true);
						$coupon_address_2 = get_post_meta($coupon_id, 'coupon_address_2', true);
						$coupon_city = get_post_meta($coupon_id, 'coupon_city', true);
						$coupon_state = get_post_meta($coupon_id, 'coupon_state', true);
						$coupon_zip = get_post_meta($coupon_id, 'coupon_zip', true);
						$coupon_discount = get_post_meta($coupon_id, 'coupon_discount', true);
						$coupon_description = get_post_meta($coupon_id, 'coupon_description', true);
						$coupon_url = get_post_meta($coupon_id, 'coupon_url', true);
						$coupon_code = get_post_meta($coupon_id, 'coupon_code', true);
						$coupon_start_date = get_post_meta($coupon_id, 'coupon_start_date', true);
						$coupon_finish_date = get_post_meta($coupon_id, 'coupon_finish_date', true);
						?>
						<div class="coupon-section col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="coupon-content">
                                <div class="row removeMargins">
                                        <h3><?php the_title();?></h3>
                                    <div class="coupon-logo"> 
                                    <?php echo preg_replace( '/(width|height)=\"\d*\"\s/', "", get_the_post_thumbnail( $coupon_id, 'full' ));  ?> 
                                    </div>
                                        <p class="discount-type"><?php echo $coupon_discount;?></p>
                                   <div class="content-area">
                                        <p><?php echo $coupon_description;?></p>
                                        <?php if($coupon_code != ''){ ?>
                                        <p class="coupon_code_styles"><strong>Coupon Code:</strong><?php echo $coupon_code;?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="coupn_bottom_code">
                                         <p class="expiration"><strong>Expiration Date:</strong> 
                                            <?php 
                                            if(!empty($coupon_finish_date)){
    	                                        $coupon_exp_date = new DateTime($coupon_finish_date);
    	                                        echo $coupon_exp_date->format('F j, Y');
    	                                    }
    	                                    else{
    	                                    	echo "None";
    	                                    }
    	                                    ?></p>
                                        <div class="btn-wrap-coupon"><a class="btnCTA" href="<?php the_permalink();?>" target="_blank">Claim Deal</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php
					// End the loop.
					}

					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => __( 'Previous page', 'lecontecenter' ),
						'next_text'          => __( 'Next page', 'lecontecenter' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'lecontecenter' ) . ' </span>',
					) );
				}
				// If no content, include the "No posts found" template.
				else{
					get_template_part( 'template-parts/content', 'none' );

				}
				?>                
            </div>
        </div>
    </div>
</section>	
<?php get_footer();