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
<?php
if ( have_posts() ){
	// Start the loop.
	while ( have_posts() ){
		the_post();
		$event_id = get_the_ID();

        $post_event = get_post( $event_id ); 
		$event_start_date = get_post_meta($event_id, 'event_start_date',true);
		$event_end_date = get_post_meta($event_id, 'event_end_date',true);
        $event_status = get_post_meta($event_id, 'event_status', true);
        $event_url = get_post_meta($event_id, 'event_url',true);

        $event_title = get_the_title();

	?>
	<section class="container pageContent">
        <div class="row removeMargins">
            <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes" style="padding: 30px; font-size: 13px; min-height: 400px;">
                <div class="thumbnail" style="background-color: transparent; border: 0px; max-height: 50px; max-width: 50px; float:left; position: relative; top: 15px; margin-bottom: 0px;"> <img src="<?php echo get_template_directory_uri(); ?>/images/LeConteLogo-175x175.png" alt="" /> 
                </div>
                <h1 class="floatleft" style="padding-bottom: 15px;"><?php echo $event_title;?></h1>
                <div class="clear"></div>
                <?php 
                if(!empty($event_url)){?>
                <a class="btnCTA" href="<?php echo $event_url;?>" target="_blank" >To Website</a><br/>
                <br/>
                <br/>
                <div class="clear"></div>
                <?php }?>
                <?php if (!empty($event_status)) { ?>
                    <div class="sectiontitle red-text"><?php echo $event_status . (strtolower($event_status) == "rescheduled" ? " to:" : ""); ?></div>
                <?php } ?>
                <div class="sectiontitle">
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
                <div class="clear"></div>
                <div>
                    <div>
                        <hr />
                        <div id="diveventdescription" class="floatleft">
                            <h2 class="eventDetailsHeader">Event Description</h2>
                            <?php the_content();?>
                        </div>
                        <div class="clear"></div>
                        <hr />
                        <div class="floatleft">
                            <h2 class="eventDetailsHeader">Event Contact Information</h2>
                            <p> 
                            <?php 
                            $event_contact_name = get_post_meta($event_id, 'event_contact_name',true);
                            $event_contact_phone = get_post_meta($event_id, 'event_contact_phone',true);
                            if (!empty($event_contact_name)) {
                                echo  "<strong>Name:</strong> ".$event_contact_name."<br />";
                            }
                            if (!empty($event_contact_phone)) {
                                echo  "<strong>Phone:</strong> ".$event_contact_phone."<br /><br />";
                            }
                            ?>
                            </p> 
                        </div>
                        <div class="clear"></div>
                        <?php 
                        $event_session = get_post_meta($event_id, 'event_session',true);
                        if($event_session>0){
                        ?>
                        <hr />
                        <div id="diveventsessions" class="margintop">
                            <h2 class="eventDetailsHeader floatleft">Event Schedule</h2>
                            <div id="divsortsessions" class="floatright">
                                Sort Sessions By
                                <select>
                                    <option selected="selected" value="-1">- Select -</option>
                                    <option value="0">By Date</option>
                                    <option value="1">Start Time</option>
                                    <option value="2">End Time</option>
                                    <option value="3">Conference Room</option>
                                    <option value="4">Instructor Name</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                            <div>
                                <div class="event-shedule_des" style="background-color: #FFFDF6; padding: 5px;">
                                <?php 
                                #Event Session Start
                                
                                for($i=0; $i<$event_session;$i++){
                                    $session_title= get_post_meta($event_id,"event_session_".$i."_session_title",true);

                                  
       
                                    $session_date= get_post_meta($event_id,"event_session_".$i."_session_date",true);

                                    if(!empty($session_date)){
                                        $session_start_date = new DateTime($session_date);
                                        $session_start_date_txt = $session_start_date->format('F j, Y');
                                        $session_start_date_cal = $session_start_date->format('j F Y h:i:s A');
                                    }
                                    else{
                                        $session_start_date_txt = "None";
                                        $session_start_date_txt = ""; 
                                    }
                                    $session_start_time= get_post_meta($event_id,"event_session_".$i."_session_start_time",true);
                                    $session_end_time= get_post_meta($event_id,"event_session_".$i."_session_end_time",true);
                                    $session_room= get_post_meta($event_id,"event_session_".$i."_session_room",true);
                                    $session_description= get_post_meta($event_id,"event_session_".$i."_session_description",true);
                                    $location= get_post_meta($event_id,"event_session_".$i."_location",true);
                                    $instructor_name= get_post_meta($event_id,"event_session_".$i."_instructor_name",true);

                                ?>
                                    <h4><?php echo $session_title;?></h4>
                                    <strong>Title:</strong> <?php echo $session_title;?><br/>
                                    <strong>Date:</strong> <?php echo $session_start_date_txt;?><br/>
                                    <strong>Start Time:</strong> <?php echo $session_start_time;?><br/>
                                    <strong>End Time:</strong> <?php echo $session_end_time;?><br/>
                                    <strong>Room:</strong> <?php echo $session_room;?><br/>
                                    <strong>Location</strong> <?php echo $location;?><br/>
                                    <strong>Instructor Name</strong> <?php echo $instructor_name;?><br/>
                                    <p>
                                    <?php echo $session_description;?>
                                    </p><br/><hr>
                                <?php 
                                } 
                                #Event Session Start
                                ?>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                     </div>
                    <div id="diveventmaterials" class="margintop">
                          <h2 class="eventDetailsHeader">Event Materials</h2>
                          <div class="clear"></div>
                          <hr class="eventMaterialsHR"/>
                    </div>
                    <p><strong>Questions about the LeConte Center? Call 865-429-7432 or <a href="mailto:info@lecontecenter.com">Email Us</a> for more info or to schedule an on site tour.</strong></p>
                </div>
            </div>
      </div>
</section>
    <section class="container pageContent">
          <div class="row removeMargins"> </div>
    </section>
	<?php 
	// End of the loop.
	}
}
?>
<section class="container pageContent">
          <div class="row removeMargins">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 amenityTypes">
              <div class="row removeMargins">
            <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--leconte-map secondaryTile clearfix title-brown-text removePadding"> <a id="location"></a>
                  <h2 class="content-title">Location</h2>
                  <a class="directions-link btnCTA" onclick="directionsByDevice()">Map Directions to LeConte Center</a>
                  <div id="map_canvas" class="leConteCenter"></div>
                  <div class="secondaryTileCopy">
                    <div class="map-loading"> <img src="<?php echo get_template_directory_uri(); ?>/images/loading2.gif" width="16" alt="loading" /> Loading... </div>
                  </div>
                  
                </div>
          </div>
            </div>
      </div>
        </section>
<?php 
get_footer();