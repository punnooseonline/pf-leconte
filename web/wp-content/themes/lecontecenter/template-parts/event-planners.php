<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:Event Planners
 *
 * @package WordPress
 * @subpackage lecontecenter 
 * @since lecontecenter 1.0
 */
get_header();  
$event_planner_id = get_the_ID(); 
?>
<section id="heroMain" class="container hero">
    <div class="row removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding"> 

            <?php 
            $banner_image = get_post_meta($event_planner_id ,'page_single_image',true);
            $get_banner_image = wp_prepare_attachment_for_js($banner_image);
            $get_image_type = get_post_meta($event_planner_id ,'page_image_type',true);
            //pr($get_image_type);
            if($get_image_type=="normal"){
            ?>    
            <img src="<?php echo $get_banner_image['url']; ?>" alt="" />
            <?php } 
            ?>
            <h2 class="heroTitle">Event Planners</h2>
        </div>
    </div>
    <div class="featureLinks" style="position: relative;">
        <div class="row mobile removeMargins topRowLinks top_event_planners">

            <?php 
        #Banner Page Url Start
            $total_banner_field = get_post_meta($event_planner_id,'banner_field',true);
            for($i=0; $i<$total_banner_field; $i++ ){
                $banner_title= get_post_meta($event_planner_id,"banner_field_".$i."_title",true);
                $banner_link=  get_post_meta($event_planner_id,"banner_field_".$i."_link",true);
                $banner_class=  get_post_meta($event_planner_id,"banner_field_".$i."_icon",true);
            ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 <?php echo $banner_class; ?> "> <a class="quicklink form" href="<?php echo $banner_link; ?>">
                    <p class="doubleLine"><?php echo $banner_title; ?></p>
                </a> </div>
            <?php 
            }#Banner Page Url End
            ?>
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
                <div class="social-button-wrapper social-twitter"> <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a> </div>
                <div class="social-button-wrapper social-googleplusone">
                    <div class="g-plusone " data-annotation="inline" data-size="medium" data-width="80"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools"> <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt="" /></a> </div>
    </div>
</section>
<section class="container pageContent">
    <div class='row' style="margin-right: 0px; margin-left: 0px;">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes widget--content-view secondaryTile clearfix  title-brown-text"> <a id="amenities"></a>
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
                            the_content();
                        }
                          wp_reset_postdata();
                    }
                #Amenities End
                ?>                             
          </div>
        </div>
    </div>
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 callForTour widget--content-block clearfix removePadding">
            <p>Call: <a class="mobileNum" href="tel:+8654297432"><?php echo $lecontecenter_theme_options['site_phone_no'];?></a> or <a class="mailTo" href="mailto:info@lecontecenter.com">Email Us</a> <span class="subParagraph"><?php echo $lecontecenter_theme_options['site_email'];?></span></p>
        </div>
    </div>
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix title-brown-text removePadding">
            <h2 class="content-title">Service Providers</h2>
            <img src='<?php echo get_template_directory_uri(); ?>/images/laConte-about--dt_amenity.jpg?n=3144' alt="" />
            <div class="secondaryTileCopy">
                <div class="serviceProviders seperator">
                    <ul>
                        <li>
                          <h2>CCLD Networks Telecommunications &amp; Network Services</h2>
                          <p><a href="/wp-content/uploads/2016/09/g.pdf" title="CCLD Networks Order Form">Order form</a></p>
                        </li>
                        <li>
                          <h2>Griffin Electric Company</h2>
                          <p><a href="/wp-content/uploads/2016/09/Griffin-Electric-Order-Form-LeConte-Center.pdf" title="Griffin Electrical Services Order Form">Order form</a></p>
                        </li>
                        <li>
                          <h2>Streamline Productions</h2>
                          <p><a href="/wp-content/uploads/2016/09/SVS_LeConte_Price_List.pdf" title="Stellar Visions and Sound Pricing">Order form</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix title-brown-text removePadding">
            
            <?php 
        #Hotel,Lodging & Housing Bureau Start
            $args = array(
            'post_type' => 'page',
            'pagename'=> 'hotel-lodging-housing-bureau',
            'post_status' => 'publish'
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();?>
                    <h2 class="content-title"> <?php the_title();?> </h2>
                    <?php 
                    
                    $hotel_lodging_id=get_the_ID();
                    $hotel_lodging_image = get_post_meta($hotel_lodging_id ,'page_single_image',true);
                    $get_hotel_lodging_image = wp_prepare_attachment_for_js($hotel_lodging_image);
                    $get_image_type = get_post_meta($hotel_lodging_id ,'page_image_type',true);
                    
                    if($get_image_type=="normal"){
                    ?>    
                    <img src="<?php echo $get_hotel_lodging_image['url']; ?>" alt="" />
                    <?php } 
                            
                    the_content();
                }
                wp_reset_postdata();
            }
            #Hotel,Lodging & Housing Bureau End
            ?>   
        </div>
    </div>
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--leconte-map secondaryTile clearfix title-brown-text removePadding"> <a id="location"></a>
            <h2 class="content-title">Location</h2>
            <a class="directions-link btnCTA" onclick="directionsByDevice()">Map Directions to LeConte Center</a>
            <div id="map_canvas" class="leConteCenter"></div>
            <!-- Green section -->
            <div class="green-section">
             <center><p>Discover the Pigeon Forge Website: &nbsp;<a class="mypf-link btnCTA" href="http://www.mypigeonforge.com/" target="_blank">Visit MyPigeonForge.com</a></p></center>
            </div>
            <!-- Green section -->
            <div class="secondaryTileCopy">
                <div class="map-loading"> <img src="<?php echo get_template_directory_uri(); ?>/images/loading2.gif" width="16" alt="loading" /> Loading... </div>
            </div>
            
        </div>
    </div>
    <div class='row removeMargins'>
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix title-brown-text removePadding">
            <h2 class="content-title">Meet the Team</h2>
            <?php $team_page_single_image = get_post_meta($event_planner_id, 'meet_the_team_cover_image', true);           
            $wp_get_attachment_single_image = wp_prepare_attachment_for_js($team_page_single_image) ;         
            ?>
            <p><img src="<?php echo $wp_get_attachment_single_image['url'];?>" alt=""></p>
            <div class="secondaryTileCopy">
                <div class="team">
                    <div class="row">
                        <?php 
                    #Team  Section Start
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
                        #Team Section End
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