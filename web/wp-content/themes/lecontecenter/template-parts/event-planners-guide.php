<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:Event Planners Guide
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
get_header(); 
?>

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
                    <div class="g-plusone " data-annotation="inline" data-size="medium" data-width="80"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools">
            <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt="" /></a>
        </div>
   </div>
</section>

<section class="container pageContent">
    <div class="row" style="margin-right: 0px; margin-left: 0px;">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes widget--content-view secondaryTile clearfix  title-brown-text">
            <?php if ( have_posts() ){ 
                the_post();?>
            <h2 class="content-title"><?php the_title(); ?></h2>
            <div class="secondaryTileCopy">
                <?php the_content(); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="container pageContent">
    <div class="row" style="margin-right: 0px; margin-left: 0px;">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes widget--content-view secondaryTile clearfix design_content title-brown-text">
            <form method="post" action="http://www.pages02.net/mypigeonforge/enews/LeConte/LeConte_EventPlanner" pageid="4719337" siteid="67620" parentpageid="4719336">
                <fieldset>
                    <legend>Event Planner Guide Request Form</legend>
                    <div class="form-item">
                        <label for="FirstName">First Name *</label>
                        <input type="text" name="FirstName" id="Text1" size="40" required="">
                    </div>
                    <div class="form-item">
                        <label for="LastName">Last Name *</label>
                        <input type="text" name="LastName" id="Text2" size="40" required="">
                    </div>
                    <div class="form-item">
                        <label for="Email">Email *</label>
                        <input type="text" name="Email" id="Text3" size="40" required="">
                    </div>
                    <div class="form-item">
                        <label for="Postalcode">Zip / Postal Code *</label>
                        <input type="text" name="Postalcode" id="Text4" size="40" required="">
                    </div>
                    <div class="form-item">
                        <label for="Phone">Phone</label>
                        <input type="text" name="Phone" id="Text5" size="40">
                    </div>
                </fieldset>
                <fieldset class="checkboxes">
                    <legend>Subscriptions</legend>
                    <p><strong>Would you like to subscribe to Pigeon Forge's official monthly eNewsletter?</strong></p>
                    <div class="form-item">
                        <label><input type="checkbox" name="SUBSCRIPTION_GROUP" value="3281232" onchange="jQuery('.enewsGroups').slideToggle()"> Yes, I'd love to!</label>
                    </div>

                    <div class="enewsGroups" style="display: none;">
                        <p><strong>Would you like more information on a specific interest?</strong></p>
                        <div class="form-item">
                            <label><input type="checkbox" name="COLUMN52" value="Family Fun"> Family Fun</label>
                        </div>
                        <div class="form-item">
                            <label><input type="checkbox" name="COLUMN52" value="Reunion Planning"> Reunion Planning</label>
                        </div>
                        <div class="form-item">
                            <label><input type="checkbox" name="COLUMN52" value="Couples Travel"> Couples Travel</label>
                        </div>
                        <div class="form-item">
                            <label><input type="checkbox" name="COLUMN52" value="Event Planning"> Event Planning</label>
                        </div>
                        <div class="form-item">
                            <label><input type="checkbox" name="COLUMN52" value="Weddings &amp; Honeymoons"> Weddings &amp; Honeymoons</label>
                        </div>
                        <div class="form-item">
                            <label><input type="checkbox" name="COLUMN52" value="Meeting Planning"> Meeting Planning</label>
                        </div>
                        <div class="form-item">
                            <label><input type="checkbox" name="COLUMN52" value="Group Tours"> Group Tours</label>
                        </div>
                    </div>

                </fieldset>
                <fieldset>
                    <input type="submit" value="Proceed to Guide" class="btnCTA">
                </fieldset>
            </form>            
        </div>
    </div>
</section>
<?php
get_footer();