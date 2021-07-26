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
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools"> <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt="" /></a> </div>
    </div>
</section>
    
<section class="container pageContent">    
<?php 
$categories = get_terms(array(
    'taxonomy' => 'gallery_category',
    'orderby' => 'id',
    'order' => 'DESC'
));
foreach ( $categories as $category ){
    echo '<div class="row removeMargins gallery-row">
            <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix title-brown-text removePadding">
                <h2 class="content-title">'.$category->name.'</h2>';
                echo '<div class="secondaryTileCopy">
                        <div class="lbGalleryGroup">';
                       //Setup the query to retrieve the posts that exist under each term
                        $posts = get_posts(array(
                          'post_type' => 'gallery',
                          'taxonomy' => $category->taxonomy,
                          'term'  => $category->slug,
                          'post_status' => 'publish',
                          'posts_per_page' => '-1'
                          ));

                        foreach($posts as $post){
                            setup_postdata($post);
                            $gallery_id = get_the_ID();
                            $img_url = wp_get_attachment_url( get_post_thumbnail_id(),'full' );
                            echo '<div class="lbGalleryImage col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnail">
                                <a data-lightbox="lightbox['.$category->slug.']" href="'.$img_url.'">'.get_the_post_thumbnail( $gallery_id, 'thumbnail' ).'</a>
                            </div>';
                        }
                        wp_reset_postdata();
                        echo '
                        </div>
                    </div>
            </div>
        </div>';
        }
        ?>          
</section>

<?php get_footer();