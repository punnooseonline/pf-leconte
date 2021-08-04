<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:About
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header();  
?>
<section  class="container hero mobile">
    <div class="row heroPrimary removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding">
            <img src="<?php echo get_template_directory_uri(); ?>/images/laConte-about--dt_hero1.jpg" alt=""/>
            <h2 class="heroTitle">About the LeCONTE Event Center at Pigeon Forge</h2>
        </div>
    </div>
    <div class="row heroSecondary removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding">
            <img src="<?php echo get_template_directory_uri(); ?>/images/laConte-about--dt_hero2.jpg" alt="" />
        </div>
    </div>
</section>
<section  class="container hero desktop">
    <div class="row heroPrimary removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding">
            <img src="<?php echo get_template_directory_uri(); ?>/images/about_HeroImage.jpg" alt="" />
            <h2 class="heroTitle">About the LeCONTE Event Center at Pigeon Forge</h2>
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
                    <div  class="g-plusone " data-annotation="inline" data-size="medium" data-width="80"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools">
            <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt=""/></a>
        </div>
    </div>
</section>
<section class="container pageContent">
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
    <div class='row' style="margin-right: 0px; margin-left: 0px;">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes widget--content-view secondaryTile clearfix  title-brown-text">
            <a id="amenities"></a>
            <?php 
            #Amenities start
                $args = array(
                'post_type' => 'page',
                'pagename'=> 'amenities',
                'post_status' => 'publish'
                );
                $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                                $the_query->the_post();?>
                            <h2 class="content-title"><?php the_title();?></h2>
                            <?php 
                            $amenities_id=get_the_ID();
                            $amenities_image = get_post_meta($amenities_id ,'page_single_image',true);
                            $get_amenities_image = wp_prepare_attachment_for_js($amenities_image);
                            $get_image_type = get_post_meta($amenities_id ,'page_image_type',true);
                            
                            if($get_image_type=="normal"){
                            ?>    
                            <img src="<?php echo $get_amenities_image['url']; ?>" alt="" />
                            <?php } 
                            ?>
                            <div class="secondaryTileCopy">
                            <?php    
                            the_content();?>
                            </div>
                <?php   }
                        wp_reset_postdata();
                    } 
                #Amenities End
                ?>                   
        </div>
    </div>
    <div class='row removeMargins'>
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 callForTour widget--content-block clearfix">
            <p>Call: <a class="mobileNum" href="tel:+8654297432"><?php echo $lecontecenter_theme_options['site_phone_no'];?></a> or <a class="mailTo" href="mailto:info@lecontecenter.com">Email Us</a> <span class="subParagraph"><?php echo $lecontecenter_theme_options['site_email'];?></span></p>
        </div>
    </div>
    <div class='row removeMargins'>
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix  title-brown-text removePadding">
            <a id="green-credentials"></a>
             <?php 
            #Green-Credentials start
                $args = array(
                'post_type' => 'page',
                'pagename'=> 'green-credentials',
                'post_status' => 'publish'
                );
                $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                                $the_query->the_post();?>
                            <h2 class="content-title"><?php the_title();?></h2>
                            <?php 
                            $green_credentials_id=get_the_ID();
                            $green_credentials_image = get_post_meta($green_credentials_id ,'page_single_image',true);
                            $get_green_credentials_image = wp_prepare_attachment_for_js($green_credentials_image);
                            $get_image_type = get_post_meta($green_credentials_id ,'page_image_type',true);
                            
                            if($get_image_type=="normal"){
                            ?>    
                            <img src="<?php echo $get_green_credentials_image['url']; ?>" alt=""/>
                            <?php } 
                            ?>
                            <div class="secondaryTileCopy">
                            <?php    
                            the_content();?>
                            </div>
                        <?php   
                        }
                        wp_reset_postdata();
                    } 
                #Green-Credentials End
                    ?>       
        </div>
    </div>
    <div class='row removeMargins'>
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix title-brown-text removePadding">
            <a id="meet-the-team"></a>
            <h2 class="content-title">Meet the Team</h2>
            <p><?php 
            $meet_the_team_id=get_the_ID();
            $team_page_single_image = get_post_meta($meet_the_team_id, 'meet_the_team_cover_image', true);           
            $wp_get_attachment_single_image = wp_prepare_attachment_for_js($team_page_single_image) ;         
            ?>
            <img src="<?php echo $wp_get_attachment_single_image['url'];?>" alt="" /> 
            </p>
            <div class="secondaryTileCopy">
                <div class="team">
                	<div class="row">
                	<?php 
		            $args = array(
						'post_type' => 'team',
						'post_status' => 'publish',
                        'posts_per_page' => 20,  
					);
		            $the_query = new WP_Query( $args );
		        	if ( $the_query->have_posts() ) {
		        		while ( $the_query->have_posts() ) {
		        			$the_query->the_post();
		        			$team_id = get_the_ID();
		        			$designation = get_post_meta($team_id, 'team_designation', true);
		        			$phone = get_post_meta($team_id, 'team_phone', true);
		        			$email = get_post_meta($team_id, 'team_email', true);
		        			?>
		        			<div class="teamMember col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                            <figure>
	                                <div class="memberPic"><?php echo preg_replace( '/(width|height)=\"\d*\"\s/', "", get_the_post_thumbnail( $team_id, 'full' ));  ?></div>
	                                <figcaption class="memberInfo">
	                                    <h2><?php the_title();?></h2>
	                                    <h3><?php echo $designation;?></h3>
	                                   	<div><?php the_content();?></div>
	                                   	<?php 
	                                   	if(!empty($phone)){
	                                   	?>
	                                    <div class="memberPhone">
	                                        <span class="phoneIcon newphoneIcon">Phone: <a class="mobileNum" href="tel:<?php echo $phone;?>"><?php echo $phone;?></a></span>
	                                    </div>
	                                    <?php 
	                                	}
	                                	 
	                                   	if(!empty($email)){
	                                   	?>
	                                    <div class="memberEmail">
	                                        <span class="emailIcon">Email: <a class="mailTo" href="mailto:<?php echo $email;?>"><?php the_title();?></a></span>
	                                    </div>
	                                    <?php 
	                                	}
	                                	?>
	                                </figcaption>
	                            </figure>
	                        </div>
                        <?php
		            		
		            	}
		            	wp_reset_postdata();
		            }
		            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>