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
<section id="heroMain" class="container hero">
    <div class="row removeMargins">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 removePadding"> <img src="<?php echo get_template_directory_uri(); ?>/images/laConte-about--dt_credentials.jpg" alt="" />
            <h2 class="heroTitle">Calendar of Events List
			</h2>
        </div>
    </div>
</section>
<section class="container pageContent">
    <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes">
            <div id="pageAnchor" class="row removeMargins">

                <?php 
            #Showing all Event List Start 
                $args = array(
                'post_type' => 'event',
                'post_status' => 'publish',
                'posts_per_page' => 6,
                'paged' => get_query_var('paged'), 
                );

                $the_query = new WP_Query( $args );
                ?>

                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12 pagination"> <div class="current"> <?php if(function_exists('wp_pagenavi')){echo wp_pagenavi( array( 'query' => $the_query ) );}?> 
                </div> </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pagination buttonHolder"> <span class="step-links"> 
                </span></div>
            </div>
            <div class="row removeMargins eventRowHolder">
                <?php
               
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        $event_id = get_the_ID();
                        $event_start_date = get_post_meta($event_id , 'event_start_date', true);
                        $event_end_date = get_post_meta($event_id , 'event_end_date', true);
                        $event_status = get_post_meta($event_id, 'event_status', true);
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
                        ?>
                    </div>
                    <div class="thumbnail eventImageHolder" style="background-color: transparent; max-height: 150px; max-width: 175px; border: 0px; margin-bottom: 0px;"> <?php the_post_thumbnail(); ?> </div>
                    <div class="event-learn-more"> <a class="btnCTA" href="<?php the_permalink(); ?>">More Info</a> </div>
                </div>
                <?php
                    }
                }
                #Showing all Event List End 
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); 
