<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
 
$quick_link_menu = wp_nav_menu( array('menu' => 'Quick Links Menu','theme_location' =>'quick_links', 'echo' => false ));

$footer_menu = wp_nav_menu( array('menu' => 'Footer Menu','theme_location' =>'secondary', 'echo' => false ));

global $lecontecenter_theme_options;
$brochure_pdf_url= $lecontecenter_theme_options['brochure_pdf_url'];
?>
 <!--Footer Mobile-->
<div class="btm-social-panel" style="background: #fef8e5;">
    <div class="row container connct-section bottom-social">
        <h3> Connect With the LeConte Center at Pigeon Forge </h3>
        <div class="widgetBody col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="row" style="margin-right: 0px; margin-left: 0px">
                <div class="col-lg-12">
                    <div class="connct-section-view"> <a href="<?php echo $lecontecenter_theme_options['facebook'];?>" target="_blank"><i class="fa fa-facebook-square fa-4x"></i></a> &nbsp;&nbsp;&nbsp; <a href="<?php echo $lecontecenter_theme_options['twitter'];?> " target="_blank"><i class="fa fa-twitter-square fa-4x"></i></a> &nbsp;&nbsp;&nbsp; <a href="<?php echo $lecontecenter_theme_options['linkedin'];?> " target="_blank"><i class="fa fa-linkedin-square fa-4x"></i></a> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer id="footer" class="container mobile">
  <div class="row removeMargins">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accordions removePadding">
      <div id="accordion1" class="accordion-ver">
        <ul>
          <li>
            <h1>Quick Links</h1>
            <div>              
              <?php  echo str_replace('id="menu-quick-links-menu"', '', $quick_link_menu);?>              
            </div>
          </li>
          <li>
            <h1>Sign up for e-mail</h1>
            <div>
              <?php dynamic_sidebar('footer_section')?>
            </div>
          </li>
          <li>
            <h1><?php echo $lecontecenter_theme_options['brochure_title'];?></h1>
            <div> 
                <a href="<?php echo $lecontecenter_theme_options['button_url']; ?>"><img src="<?php echo $lecontecenter_theme_options['brochure_image_url']; ?>" alt="" /></a> 
                <span><a href="<?php echo $lecontecenter_theme_options['button_url']; ?>" class="btnCTA">Order Now</a></span> 
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row" style="margin-right: 0px; margin-left: 0px; background:#fef8e5;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footerNavigation">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 fnavinner">
        <nav class="footerNav">
          <?php  echo str_replace('id="menu-footer-menu"', '', $footer_menu);?>
        </nav>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footerR">
        <div class="unit copyright">
          <p><?php echo $lecontecenter_theme_options['all_rights_reserved'];?></p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--//Footer Mobile--> 

<!--Footer-->
<footer id="footer--dt" class="container desktop fatFooter">
  <div class="row footer_spacing removeMargins">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 quickLinks">
      <h3 class="colheader">Quick Links</h3>
        <ul>
          <li>
          <?php  echo str_replace('id="menu-quick-links-menu"', '', $quick_link_menu);?>
          </li>
          <li>
          <div class="row" style="margin: 1rem 0 0"> <a href="<?php echo $lecontecenter_theme_options['facebook'];?>" target="_blank"><i class="fa fa-facebook-square fa-lg"></i></a> &nbsp; <a href="<?php echo $lecontecenter_theme_options['twitter'];?>" target="_blank"><i class="fa fa-twitter-square fa-lg"></i></a> &nbsp; <a href="<?php echo $lecontecenter_theme_options['linkedin'];?>" target="_blank"><i class="fa fa-linkedin-square fa-lg"></i></a> </div>
        </li>
      </ul>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 family">
        <?php dynamic_sidebar('footer_section')?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 plannerGuide">
      <h3 class="colheader"><?php echo $lecontecenter_theme_options['brochure_title'];?></h3>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> <a href="<?php echo $lecontecenter_theme_options['button_url']; ?>"><img src="<?php echo $lecontecenter_theme_options['brochure_image_url']; ?>" alt="" /> </a> </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
          <div class="ordernow-wrap"><a href="<?php echo $lecontecenter_theme_options['button_url']; ?>" class="inputButton btnCTA"><?php echo $lecontecenter_theme_options['button_title'];?></a></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row footer_spacing removeMargins">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footerNavigation removePadding">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fnavinner">
        <nav class="footerNav">
          <?php  echo str_replace('id="menu-footer-menu"', '', $footer_menu);?>
        </nav>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 footerR">
        <div class="unit copyright">
          <p><?php echo $lecontecenter_theme_options['all_rights_reserved'];?></p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--//Footer--> 
</div>
</div>
<!-- BEGIN: Web fonts -->
<script type="text/javascript">
    try {
        Typekit.load();
    } catch (e) {}
    </script>
<!-- END: Web fonts -->

<!--[if IE]>
    <script type="text/javascript" src="/js/html5.js?v=20140702"></script>
<![endif]-->


<?php wp_footer(); ?>
</body>
</html>
