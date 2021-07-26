<?php

/**
 * Template Name: Location
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header(); 
$location_attendees_id = get_the_ID(); 
?>
<link href="<?php echo get_template_directory_uri().'/css/location.css'; ?>" rel="stylesheet">
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
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" />
            <?php } 
            ?>
              <h2 class="heroTitle">Location and Maps</h2>
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
	<div class="locationContent">
		<div class="row removeMargins">
			<div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 secondaryTile clearfix removePadding">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 locationBox">
					<a href="https://www.google.com/maps/dir//LeConte+Center+at+Pigeon+Forge,+2986+Teaster+Ln,+Pigeon+Forge,+TN+37863/@35.7975463,-83.6321121,12z/" target="_blank"><img src="/wp-content/uploads/2018/04/location_map_directions_to.jpg" /></a>
					<a class="greenCTA" href="https://www.google.com/maps/dir//LeConte+Center+at+Pigeon+Forge,+2986+Teaster+Ln,+Pigeon+Forge,+TN+37863/@35.7975463,-83.6321121,12z/" target="_blank">Map Directions to LeConte Center</a>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 locationBox">
					<a href="https://www.google.com/maps/dir/LeConte+Center+at+Pigeon+Forge,+2986+Teaster+Ln,+Pigeon+Forge,+TN+37863//@35.7975615,-83.5970912,13z/" target="_blank"><img src="/wp-content/uploads/2018/04/location_map_directions_from.jpg" /></a>
					<a class="greenCTA" href="https://www.google.com/maps/dir/LeConte+Center+at+Pigeon+Forge,+2986+Teaster+Ln,+Pigeon+Forge,+TN+37863//@35.7975615,-83.5970912,13z/" target="_blank">Map Directions from LeConte Center</a>
				</div>
			</div>
		</div>
		<div class="row removeMargins">
			<div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 secondaryTile clearfix removePadding PFTileHead">
				For more information on housing, restaurants and other Pigeon Forge info select links below
			</div>
		</div>
        <div class="row removeMargins PFTiles">
            <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 secondaryTile clearfix removePadding">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 locationBox">
                    <a href="https://www.mypigeonforge.com/lodging" target="_blank"><img src="/wp-content/uploads/2018/04/location_where_to_stay.jpg" /></a>
                    <a class="greenCTA" href="https://www.mypigeonforge.com/lodging" target="_blank">Where to Stay</a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 locationBox">
                    <a href="https://www.mypigeonforge.com/where-to-eat" target="_blank"><img src="/wp-content/uploads/2018/04/location_where_to_eat.jpg" /></a>
                    <a class="greenCTA" href="https://www.mypigeonforge.com/where-to-eat" target="_blank">Where to Eat</a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 locationBox">
                    <a href="https://www.mypigeonforge.com/things-to-do" target="_blank"><img src="/wp-content/uploads/2018/04/location_things_to_do.jpg" /></a>
                    <a class="greenCTA" href="https://www.mypigeonforge.com/things-to-do" target="_blank">Things to Do</a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 locationBox">
                    <a href="https://www.mypigeonforge.com/" target="_blank"><img src="/wp-content/uploads/2018/04/location_mypf.jpg" /></a>
                    <a class="greenCTA" href="https://www.mypigeonforge.com/" target="_blank">MyPigeonForge</a>
                </div>
            </div>
        </div>
        <div class="row removeMargins">
            <div class="widgetBody col-xs-12 visible-xs hidden-sm secondaryTile clearfix removePadding PFMapHead">
				Tap Map to Zoom
			</div>
            <a href="/wp-content/uploads/2018/06/location_map_v2.jpg" target="_blank"><img src="/wp-content/uploads/2018/06/location_map_v2.jpg" /></a>
        </div>
	</div>
</section>

<?php
get_footer();