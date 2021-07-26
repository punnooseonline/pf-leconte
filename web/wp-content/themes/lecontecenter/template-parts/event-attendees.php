<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:Event Attendees
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header(); 
$event_attendees_id = get_the_ID(); 
?>
<section id="heroMain" class="container hero">
    <div class="row removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding"> 
            <?php 
            $banner_image = get_post_meta($event_attendees_id ,'page_single_image',true);
            $get_banner_image = wp_prepare_attachment_for_js($banner_image);
            $get_image_type = get_post_meta($event_attendees_id ,'page_image_type',true);
            //pr($get_image_type);
            if($get_image_type=="normal"){
            ?>    
            <img src="<?php echo $get_banner_image['url']; ?>" alt="" />
            <?php } 
            ?>
              <h2 class="heroTitle">Event Attendees</h2>
        </div>
    </div>
    <div class="featureLinks" style="position: relative;">
        <div class="row mobile removeMargins" style="">
            <?php 
        #Banner Page Url Start
            $total_banner_field = get_post_meta($event_attendees_id,'banner_field',true);
            for($i=0; $i<$total_banner_field; $i++ ){
                $banner_title= get_post_meta($event_attendees_id,"banner_field_".$i."_title",true);
                $banner_link=  get_post_meta($event_attendees_id,"banner_field_".$i."_link",true);
                $banner_class=  get_post_meta($event_attendees_id,"banner_field_".$i."_icon",true);
            ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 <?php echo $banner_class; ?>"> <a class="quicklink house" href="<?php echo $banner_link; ?>" title="Floor Plans">
                    <p><?php echo $banner_title; ?></p>
                </a> </div>
            <?php
            }
            #Banner Page Url End
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
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes">
            <div id="pageAnchor" class="row removeMargins">

                <?php 
                wp_reset_query();
                #Showing all Event List Start 
                $args = array(
                    'post_type'      => 'event',
                    'posts_per_page' => 9,  
                    'post_status'    => 'publish',
                    'meta_key'       => 'event_start_date',
                    'orderby'        => 'meta_value',
                    'order'          => 'asc',
                    'paged'          => get_query_var('paged'), 
                    'meta_query'     => array(
                        array(
                        'key'     => 'event_end_date',
                        'value'   => date("Ymd"),
                        'compare' => '>='
                        ),
                    ),
                );

                $the_query = new WP_Query( $args );
                ?>

                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12 pagination"> <div class="current"> <?php if(function_exists('wp_pagenavi')){echo wp_pagenavi( array( 'query' => $the_query ) );}?> </div> </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pagination buttonHolder"> <span class="step-links"> 
                </span></div>
            </div>
            <div class="row removeMargins eventRowHolder">
                <?php
               
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        $event_id = get_the_ID();
                        $today = date("Ymd");
                        $event_start_date = get_post_meta($event_id , 'event_start_date', true);
                        $event_end_date = get_post_meta($event_id , 'event_end_date', true);
                        $event_status = get_post_meta($event_id, 'event_status', true);
                        //$event_url = get_post_meta($event_id, 'event_url',true);
                    //if ($event_start_date > $today) {
                ?>
                <div class="event-section col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="event-title">
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="event-dates">
                        <?php if (!empty($event_status)) { ?>
                            <div class="red-text"><strong><?php echo $event_status . (strtolower($event_status) == "rescheduled" ? " to:" : ""); ?></strong></div>
                        <?php } ?>
                        <?php 
                        if (strpos(strtolower($event_status), 'event to be held in') === false) { // output date when status does not start with 'Event to be held in' 
                            if (strtolower($event_status) == "cancelled" || strtolower($event_status) == "postponed") {
                                echo "<strike>";
                            }
                            if (!empty($event_start_date) && !empty($event_end_date) ) {
                                echo leconte_output_start_end_date($event_start_date, $event_end_date);
                            } 
                            else if(!empty($event_start_date)){
                                $event_start_date = new DateTime($event_start_date);
                                echo $event_start_date->format('F jS, Y');
                            }
                            if (strtolower($event_status) == "cancelled" || strtolower($event_status) == "postponed") {
                                echo "</strike>";
                            }
                        }
                        ?>
                    <br />
                    </div>
                    <div class="thumbnail eventImageHolder" style="background-color: transparent; max-height: 150px; max-width: 175px; border: 0px; margin-bottom: 0px;"> <?php the_post_thumbnail('medium'); ?> </div>
                    <div class="event-learn-more"> <a class="btnCTA" href="<?php the_permalink(); ?>">More Info</a> </div>
                </div>
                <?php
                       // }
                    }
                }
                #Showing all Event List End 
                ?>
            </div>
        </div>
    </div>
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
                        wp_reset_postdata();?>
                            </div>
            <?php  }
                #Amenities End
            ?>       
        </div>
    </div>
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-block clearfix" style="text-align: center;">
            <div class="cta-travel-planner" style="width: 50%; margin: 0 auto; padding-bottom:20px;"> <a href="https://www.mypigeonforge.com/planning/Travel-Guide/"> <img src="<?php echo get_template_directory_uri(); ?>/images/travelguide.png" height="213" alt="Travel Planner" title="Travel Planner" /> </a>
                    <p>Come experience the best <br/>
                    family vacation <br/>
                     destination.</p>
            <br/>
                    <a href="https://www.mypigeonforge.com/planning/Travel-Guide/" title="Click here to order yours!" class="green">Click here to order yours!</a> 
            </div>
        </div>
    </div>
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--leconte-map secondaryTile clearfix title-brown-text removePadding"> <a id="location"></a>
            <h2 class="content-title">Location</h2>
            <a class="directions-link btnCTA" onclick="directionsByDevice()">Map Directions to LeConte Center</a>
            <div id="map_canvas" class="leConteCenter"></div>
            <!-- Green section -->
            <div class="green-section">
             <center><p>Discover the Pigeon Forge Website: &nbsp;<a class="mypf-link btnCTA" href="https://www.mypigeonforge.com/" target="_blank">Visit MyPigeonForge.com</a></p></center>
            </div>
            <!-- Green section -->
            <div class="secondaryTileCopy">
                <div class="map-loading"> <img src="<?php echo get_template_directory_uri(); ?>/images/loading2.gif" width="16" alt="loading" /> Loading... </div>
            </div>
            
        </div>
    </div>
</section>
<?php
get_footer();