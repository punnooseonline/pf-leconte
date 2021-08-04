<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header();
?>
<?php
if ( have_posts() ){
	// Start the loop.
	while ( have_posts() ){
		the_post();
		@$business_id = get_the_ID();
        @$post_business = get_post( $event_id ); 
		$short_description = get_post_meta($business_id, 'short_description',true);
        $website_url = get_post_meta($business_id, 'website_url',true);
        $map_url = get_post_meta($business_id, 'map_url',true);
        $business_title = get_the_title();
        $trackName = preg_replace("/[^a-z ]/i", '', strtolower($business_title));
        $business_description = get_the_content();
        $featured_img_url = get_the_post_thumbnail_url($business_id);
        //banner image assignment
        $banner_image_id = get_post_meta($business_id, 'banner_image',true);
        $banner_image = ($banner_image_id!=''?wp_get_attachment_url($banner_image_id):'');

	?>
        <link href="<?php echo get_template_directory_uri().'/css/business.css'; ?>" rel="stylesheet">
        <div class="container">
            <span><img class="img-width topbnrmob" src="<?php echo ($banner_image!=''?$banner_image:get_template_directory_uri().'/images/topbaner.jpg'); ?>"></span>
        </div>
        <div class="container about-bg">
            <div class="col-sm-1"></div>
            <div class="col-sm-8">
                <span class="abthead"><?php echo $business_title; ?></span>
                <?php if($short_description!=''){ ?>
                <p class="abtp"><?php echo $short_description; ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="container bg">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-5">
                    <div class="abtwhtbg">
                        <?php echo $business_description; ?>
                        <div class="clearfix"></div>
                        <div class="abt-btns">
                            <br /><br /><!--<a href="#"><div class="viewbtn btnfull">SAVE THIS DEAL<i class="glyphicon glyphicon-play"></i></div></a>-->
                            <a target="_blank" href="<?php echo ($website_url!=''?$website_url:'#');?>" onclick="dataLayer.push({ 'event': 'campaignTracker', 'eventCategory': 'media - geofencing', 'eventAction': 'media - geofencing - click to visit website from detail - <?php echo $trackName; ?>' });"><div class="viewbtn btnfull">VISIT WEBSITE<i class="glyphicon glyphicon-play"></i></div></a>
                            <a target="_blank" href="<?php echo ($map_url!=''?$map_url:'#');?>" onclick="dataLayer.push({ 'event': 'campaignTracker', 'eventCategory': 'media - geofencing', 'eventAction': 'media - geofencing - click to view on map from detail - <?php echo $trackName; ?>' });"><div class="viewbtn btnfull">VIEW ON MAP<i class="glyphicon glyphicon-play"></i></div></a>
                        </div>
                    </div>
                </div>
                <?php if($featured_img_url!=''){ ?>
                <div class="col-sm-5">
                    <div class="imgbknd">
                        <span><img class="img-responsive abtimg" src="<?php echo $featured_img_url;?>"></span>
                    </div>
                </div>
                <?php } ?>
                <div class="col-sm-1"></div>
            </div>
	    </div>
	<?php 
	// End of the loop.
	}
}
?>
<?php 
get_footer();
?>