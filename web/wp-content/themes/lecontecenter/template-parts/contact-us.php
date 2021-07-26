<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name:Contact Us
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
        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs tools">
            <a class="print" href="javascript:window.print()"><img src="<?php echo get_template_directory_uri(); ?>/images/leconte-btn-print.png" alt=""/></a>
        </div>
    </div>
</section>
<section class="container pageContent">
    <div class="row">
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12 widget--content-view secondaryTile clearfix  title-brown-text">
            <a id="contact-us"></a>
            <h2 class="content-title">Contact Us</h2>
            <div class="secondaryTileCopy">
                <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
        <script type="text/javascript">
        function isValidEmail(email) {
            return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(email) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(email);
        }

        function submitContactForm() {

            var error = false;
            var name = $("#Name").val();
            var email = $("#Email").val();
            var subject = $("#Subject").val();
            var message = $("#Message").val();

            if (name.length == 0) {
                var error = true;
                $('#name_error').fadeIn(500);
            } else {
                $('#name_error').fadeOut(500);
            }
            if (email.length == 0 || email.indexOf('@') == '-1' || isValidEmail(email) == 'false') {
                var error = true;
                $('#email_error').fadeIn(500);
            } else {
                $('#email_error').fadeOut(500);
            }
            if (subject.length == 0) {
                var error = true;
                $('#subject_error').fadeIn(500);
            } else {
                $('#subject_error').fadeOut(500);
            }
            if (message.length == 0) {
                var error = true;
                $('#message_error').fadeIn(500);
            } else {
                $('#message_error').fadeOut(500);
            }


            var postData = {
                'email': email,
                'name': name,
                'subject': subject,
                'message': message,
                'csrfmiddlewaretoken': 'iIn9nYaSKJ8NWivgNE4B5aM6CeO3s3KE',
            }

            if (error == false) {
                $('#send_message').attr({
                    'disabled': 'true',
                    'value': 'Sending...'
                });
                $.post("/worker/contact/", postData,
                    function(data) {
                        if (data === '200') {
                            $(".contactUsForm").html("<h4>The message has been sent.</h4>");
                        } else {
                            $(".contactUsForm").html("<h4>The message was not delivered.</h4>");
                        }
                    });
            }
        }
        </script>

<?php
get_footer();
?>
