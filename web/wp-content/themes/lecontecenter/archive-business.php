<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
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
<!--<link href="<?php //echo get_template_directory_uri().'/css/bootstrap.css'; ?>" rel="stylesheet">-->
<link href="<?php echo get_template_directory_uri().'/css/business.css'; ?>" rel="stylesheet">
<div class="container bg">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1 class="tophead">Check out these great businesses while in Pigeon Forge</h1>
        </div>
    </div>
    <?php 
    #Showing all Event List Start 
        $current_date = date("Ymd");
        $args = array(
        'post_type' => 'business',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'orderby'=> 'rand',
        'order'=>'ASC',
        'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1), 
        );

        $the_query = new WP_Query( $args );
        $total_pages = $the_query->max_num_pages;
        if ($total_pages > 1){
        ?>
<?php } ?>
    <div class="row">
        <div class="col-sm-1"></div>
    <?php
               
    if ( $the_query->have_posts() ) {
        $count = 1;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $business_id = get_the_ID();
            $featured_img_url = get_the_post_thumbnail_url($business_id); 
            $trackName = preg_replace("/[^a-z ]/i", '', strtolower(get_the_title()));
    ?>
			<div class="col-sm-5">
				<div class="imgbknd home-img">
					<div class="whitebknd">
						<span class="imghead"><?php the_title(); ?></span>
						<a href="<?php the_permalink(); ?>" onclick="dataLayer.push({ 'event': 'campaignTracker', 'eventCategory': 'media - geofencing', 'eventAction': 'media - geofencing - click to detail page - <?php echo $trackName; ?>' });">
							<div class="viewbtn">VIEW DETAILS <i class="glyphicon glyphicon-play"></i></div>
						</a>
					</div>
					<a href="<?php the_permalink(); ?>" onclick="dataLayer.push({ 'event': 'campaignTracker', 'eventCategory': 'media - geofencing', 'eventAction': 'media - geofencing - click to detail page - <?php echo $trackName; ?>' });"><span><img class="img-responsive" src="<?php echo $featured_img_url;?>"></span></a>
				</div>
			</div>
        <?php if($count%2==0){ ?>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
        <?php }$count++ ?>
    <?php
        }wp_reset_postdata();
    }
    #Showing all Event List End 
    ?>
        <div class="col-sm-1"></div>
    </div>
    <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes">
        <div id="pageAnchor" class="row removeMargins">        
            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12 pagination"> 
                <div class="current"> <?php if(function_exists('wp_pagenavi')){echo wp_pagenavi( array( 'query' => $the_query ) );}?> </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pagination buttonHolder"> <span class="step-links"> </span></div>
        </div>
    </div>    
</div>
<?php get_footer(); 
