<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:Home
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header(); 
$home_page_id = get_the_ID(); 
?>
<section id="heroMain" class="container hero flexslider">
    <div class="row removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slideWrapper removePadding">
            <ul class="slides">
                <?php 
            #Slide Show start
                $page_slideshow = get_post_meta($home_page_id,'page_slideshow',true);
             
                for($i=0;$i<count($page_slideshow);$i++){
                    $wp_get_attachment_image = wp_prepare_attachment_for_js($page_slideshow[$i]);?>            
                    <li> <img src="<?php echo $wp_get_attachment_image['url']; ?>" alt="" />
                        <div class="title">
                            <p><?php echo $wp_get_attachment_image['title']; ?></p>
                        </div>
                        <div class="subtitle">
                            <p><?php echo $wp_get_attachment_image['description']; ?></p>
                        </div>
                    </li>
                <?php 
                }
                #slide show end
                ?>
            </ul>
        </div>
    </div>
    <div class="featureLinks">
        <div class="row mobile removeMargins">
        <?php 
    #Banner Field Link Start
        $total_banner_field=get_post_meta($home_page_id,'banner_field',true);
        for($i=0; $i<$total_banner_field; $i++ ){
            $banner_title= get_post_meta($home_page_id,"banner_field_".$i."_title",true);
            $banner_link=  get_post_meta($home_page_id,"banner_field_".$i."_link",true);
            $banner_class=  get_post_meta($home_page_id,"banner_field_".$i."_icon",true);
        ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 <?php echo $banner_class; ?>"> <a href="<?php echo $banner_link; ?>">
                <p class="doubleLine"><?php echo $banner_title; ?></p>
            </a> </div>
        <?php 
        } 
        #Banner Field Link End
        ?>
        </div>
        <div class="row moreInfo mobile removeMargins">
            <div class="unit col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding">
                 <p>Call: <a class="mobileNum" href="tel:+8654297432"><?php echo $lecontecenter_theme_options['site_phone_no'];?></a> or <a class="mailTo" href="mailto:info@lecontecenter.com">Email Us</a> <span class="subParagraph"><?php echo $lecontecenter_theme_options['site_email'];?></span></p>
            </div>
        </div>
    </div>
</section>
<section class="container pageContent">
    <div class="row removeMargins">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 events removePadding'>
            <div class="widgetBody widget--content-view secondaryTile clearfix title-brown-text"> <a class="btnCTA" href="<?php echo home_url('/event/list/'); ?>" style="float:right; position: relative; top:15px; right:20px; z-index: 90; height: 28px;">See All Events</a>
                <h2 class="content-title upcoming">Upcoming Events</h2>
                <div class="secondaryTileCopy">
                    <div class="row removeMargins">          
                    <?php 
                    #Upcomming Event Start
                    $current_date = date("Ymd");
                    $args = Array(
                      'post_type' => 'event',              
                      'posts_per_page' => 3,
                      'post_status' => 'publish',
                      'meta_key'=> 'event_start_date',
                      'orderby'=> 'meta_value_num',
                      'order'=>'ASC',
                      'meta_query' => array(
                        array(
                        'key'     => 'event_end_date',
                        'value'   => $current_date,
                        'compare' => '>='
                        ),
                      ),
                    );
                    
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) : 
                        while ( $the_query->have_posts() ) { $the_query->the_post(); 
                        $event_id = get_the_ID();
                        $event_status = get_post_meta($event_id, 'event_status', true);
                        $event_start_date = get_post_meta($event_id, 'event_start_date',true);
                        $event_end_date = get_post_meta($event_id, 'event_end_date',true);
                        $event_url = get_post_meta($event_id, 'event_url',true);
                    ?>
                            <div class="event-section col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="event-title">
                                    <h2> <span><?php the_title(); ?></span> </h2>
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
                                </div>
                                <div class="thumbnail eventImageHolder" style="background-color: transparent; max-height: 150px; max-width: 175px; border: 0px; margin-bottom: 0px;"> <?php the_post_thumbnail('medium');?></div>
                                <div class="event-learn-more"> <a class="btnCTA" target="_blank" href="<?php echo $event_url;?>">To Website</a> </div>
                            </div>
                            <?php           
                            } 
                        wp_reset_postdata();
                        else :?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; 
                        #Upcomming Event End
                        ?>
                            </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<section class="container pageContent">
    <div class="row removeMargins">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 hero2 removePadding'>
            <div class="widgetBody widget--content-view secondaryTile clearfix title-brown-text">
                <?php 
            #Main Content Start
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                }
                #Main Content End.....  
                ?>
                <div class="featureLinks">
                    <div class="row mobile removeMargins" style="position: relative; margin-top: 0px; padding-bottom: 10px;">
                        <?php
                    #Home Page Other URL Start
                        $sub_pages_total = get_post_meta($home_page_id,'sub_pages',true);
                        for($i=0;$i<$sub_pages_total;$i++){
                            
                            $sub_pages_link = get_post_meta($home_page_id,"sub_pages_".$i."_sub_page_url", true);
                            $sub_pages_title = get_post_meta($home_page_id,"sub_pages_".$i."_sub_pages_title", true);
                                echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 aboutLink"> <a href="'.$sub_pages_link.'">
                                <p style="text-align: left !important;">'.$sub_pages_title.'</p>
                                </a> </div>';                           
                        }
                        #Home Page Other URL END
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();