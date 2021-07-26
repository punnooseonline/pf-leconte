<?php

/**
 * Template Name: ocation
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header(); 
$location_attendees_id = get_the_ID(); 
?>
<section id="heroMain" class="container hero">
    <div class="row removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding"> 
           <?php 
            $banner_image = get_post_meta($location_attendees_id ,'page_single_image',true);
            $get_banner_image = wp_prepare_attachment_for_js($banner_image);
     			$get_image_type = get_post_meta($location_attendees_id ,'page_image_type',true);
            //pr($get_image_type);
            if($get_image_type=="normal"){
            ?>    
            <img src="<?php echo $get_banner_image['url']; ?>" alt="" />
            <?php } 
            ?>
              <h2 class="heroTitle">Location and Directions</h2>
        </div>
    </div>
</section>
<section id="LCfeatures" class="container aboutLC">
    <div class="row moreInfo" style="margin-right: 0px; margin-left: 0px;">
        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 social_title">
              <p>Location</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
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
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools"> <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt="" /></a> </div>
    </div>
</section>
<section class="container pageContent">
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes">	
            <div id="pageAnchor" class="row removeMargins">
<?php 
            #Amenities start
                $args1 = array(
                'post_type' => 'page',
                'pagename'=> 'location',
                'post_status' => 'publish'
                );
                $the_query1 = new WP_Query( $args1 );
                    if ( $the_query1->have_posts() ) {
                        while ( $the_query1->have_posts() ) {
                                $the_query1->the_post();?>

                            <?php 

                          $locations_id=get_the_ID();
                            $locations_image = get_post_meta($locations_id ,'page_single_image',true);
                            $get_locations_image = wp_prepare_attachment_for_js($locations_image);
                            $get_image_type = get_post_meta($locations_id ,'page_image_type',true);
                            
                            if($get_image_type=="normal"){
                            ?>    
                           <!-- <img src="<?php echo $get_locations_image['url']; ?>" alt="" /> -->
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
                <?php 
                wp_reset_query();
                #Showing all Event List Start 
                $args = array(
                'post_type' => 'locationroute',
                'post_status' => 'publish',
                'meta_value'   => date( "Ymd" ), // change to how "event date" is stored
                'meta_compare' => '>=',
                'posts_per_page' => 9,  
                'paged' => get_query_var('paged'), 
                'orderby' => 'meta_value',
                'order' => 'asc'
                );

                $the_query = new WP_Query( $args );
                ?>

                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12 pagination"> <div class="current"> <?php if(function_exists('wp_pagenavi')){echo wp_pagenavi( array( 'query' => $the_query ) );}?> </div> </div>
            </div>
            <div class="secondaryTileCopy">
            <div class="row removeMargins borderBottom">
                <?php
        
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        $location_id = get_the_ID();
                          $location_description = get_the_content();
                         
                           $route_image =get_post_meta($location_id, 'route_image',true);
                             $featured_img_url = wp_get_attachment_url($route_image);
                             
               				 $map_url = get_post_meta($location_id, 'map_url',true);
                       // $today = date("Ymd");
                   //     $event_start_date = get_post_meta($location_id , 'event_start_date', true);
                    //    $event_end_date = get_post_meta($location_id , 'event_end_date', true);
                        //$event_url = get_post_meta($event_id, 'event_url',true);
                    //if ($event_start_date > $today) {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding">
                   
                   	<img class="directionsThumb" src="<?php echo $featured_img_url; ?>">	
							<span class="directionsHeader"><?php the_title(); ?></span>
                     <?php echo   $location_description; ?>
                     <div class="event-learn-more"> <a class="btnCTA" href="<?php echo  $map_url;  ?>">MAP IT</a> </div>
                </div>
                <?php
                       // }
                    }
                }
                #Showing all Event List End 
                ?>
                          
            </div>

       <hr> 
        </div>
       
    </div>
   
    <div class='row' style="margin-right: 0px; margin-left: 0px;">
    
    <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes widget--content-view secondaryTile clearfix  title-brown-text"> <a id="amenities"></a>
        
                            <h2 class="content-title">Notable Landmarks</h2>
                            
                            <div class="secondaryTileCopy">
						<div class="row removeMargins borderBottom">
						

<?php

 wp_reset_query();
                #Showing all Event List Start 
                $args_p = array(
                'post_type' => 'notablelandmarks',
                'post_status' => 'publish',
                'meta_value'   => date( "Ymd" ), // change to how "event date" is stored
                'meta_compare' => '>=',
                'posts_per_page' => 9,  
                'paged' => get_query_var('paged'), 
                'orderby' => 'meta_value',
                'order' => 'asc'
                );

                $the_query1 = new WP_Query( $args_p );
                  if ( $the_query1->have_posts() ) {
                    while ( $the_query1->have_posts() ) {
                        $the_query1->the_post();
                        $landmarks_id = get_the_ID();
                          $landmarks_description = get_the_content();
                         
                           $landmarks_image =get_post_meta($landmarks_id, 'notable_landmarks_image',true);
                             $featured_img_url2 = wp_get_attachment_url($landmarks_image);        
               				 $map_url = get_post_meta($landmarks_id, 'learn_more_url',true);
                ?>	
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding">
								<img class="directionsThumb" src="<?php echo   $featured_img_url2; ?>" alt="">
								<span class="directionsHeader"><?php echo the_title(); ?></span>
								<p class="directions"><?php echo $landmarks_description; ?></p>
								<a class="btnCTA mapIt" href="<?php echo  $map_url; ?>">Learn more</a>
							</div> <?php } ?>
<?php } ?>
						</div>

<hr>
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
             <center><p>Discover the Pigeon Forge Website: &nbsp;<a class="mypf-link btnCTA" href="http://www.mypigeonforge.com/" target="_blank">Visit MyPigeonForge.com</a></p></center>
            </div>
            <!-- Green section -->
            <div class="secondaryTileCopy">
                <div class="map-loading"> <img src="<?php echo get_template_directory_uri(); ?>/images/loading2.gif" width="16" alt="loading" /> Loading... </div>
                <h3>What's Nearby</h3>
                <nav class="seperator">
                    <div id="categories">
                        <ul>
                            <li class="maplinks"><a class="gmap-category where-to-stay json" data-cat-name="where-to-stay">Where to Stay</a></li>
                            <li class="maplinks"><a class="gmap-category where-to-eat json" data-cat-name="where-to-eat">Where to Eat</a></li>
                            <li class="maplinks"><a class="gmap-category what-to-do json" data-cat-name="attractions">Attractions</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            
        </div>
    </div>
</section>
<style type="text/css">
section.pageContent .amenityTypes h2.content-title {
    display: block;
    float: left;
    padding: 0rem 0rem 0rem 4rem;
    width: 100%;
        color: #8d7658;
    position: relative;
    font-size: 3rem;
}
section.pageContent .widgetBody h3 {
    color: #8d7658;
    font-size: 1.6rem;
    padding: 0px 4rem;
    width: 100%;
    display: block;
    float: left;
    margin-top:0px;
}
.directionsHeader {
    display: block;
    font-size: 16px;
    font-weight: bold;
    margin-top: 15px;
    margin-bottom: 15px;
}
.directions {
    margin-bottom: 20px;
}
.secondaryTileCopy li {
    color: #8d7658;
    font-size: 1.4rem;
    line-height: 1.5;
    list-style-type: decimal;
    margin-left: 15px;
}
hr {
    background-color: rgb(214, 214, 214);
    margin: 10px 0 10px 0;
}
.secondaryTileCopy {
    padding: 2rem 2rem 1rem 2rem;
    background: #fef8e5;
}
.secondaryTileCopy p {
    padding-left: 0;
}
.secondaryTileCopy p {
    color: #8d7658;
    line-height: 1.5;
    padding-bottom: 2rem;
    font-size: 1.3rem;
}
@media screen and (max-width:4000px) and (min-width:960px){
 .secondaryTileCopy:first-child, .secondaryTileCopy:first-child img {
  padding: 0;
  width: 960px !important;
  min-width: 960px !important;
 }
}
@media screen and (max-width:300px) and (min-width:959px){
 .secondaryTileCopy:first-child{
  padding: 0;
  width: 100% !important;
  min-width: 100% !important;
 }
 .secondaryTileCopy:first-child img {
  width: 100% !important;
  min-width: 100% !important;
 }
}
.amenityTypes.secondaryTile .secondaryTileCopy img {
    margin-top: 0;
}

.removeMargins .padding {
    margin-bottom: 60px;
}
ul, ol {
    margin: 0px 0 0 0px;
}
ul li {
list-style-type: none;
}


</style>
<?php
get_footer();
