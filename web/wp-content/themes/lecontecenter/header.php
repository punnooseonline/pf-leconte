<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */

 
global $lecontecenter_theme_options;
$lecontecenter_theme_options = get_option('lecontecenter_theme_options',true); 

$header_menu = wp_nav_menu( array('menu' => 'header_menu', 'container' => '', 'theme_location' =>'primary','echo' => false ));
?>


<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">  
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href='https://fonts.googleapis.com/css?family=Vollkorn:400,700,400italic,700italic' rel='stylesheet' type='text/css' />
  <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css' />

  <meta property="fb:admins" content="100000507295242" /> 
  <?php wp_head(); ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-PRD8F59');</script>
  <!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRD8F59"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<nav id="mobilePushyNav" class="pushy pushy-left">
  <?php echo str_replace('id="menu-header-menu"', '', $header_menu);?>
</nav>
<div id="container" class="pageWrapper">
  <div class="shadowBox">
    <header id="header" class="container mobile">
      <div class="row" style="margin-right: 0px; margin-left: 0px; padding-bottom: 15px;">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 logo text-center"><?php lecontecenter_the_custom_logo(); ?> </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 siteSearch" style="top: 15px; padding-top: 0px;">
          <p style="padding-bottom: 0px; padding-right: 0px !important;"><span class="phoneNum" style="display: inline-block; margin:10px 0px 0 0;">Call Us We're Here to Help: <a class="mobileNum" href="tel:<?php echo $lecontecenter_theme_options['site_phone_no'];?>"><?php echo $lecontecenter_theme_options['site_phone_no'];?></a></span></p>
          <p class="sosal-head"> <a href="<?php echo $lecontecenter_theme_options['facebook'];?>" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a> &nbsp; <a href="<?php echo $lecontecenter_theme_options['twitter'];?>" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a> &nbsp; <a href="<?php echo $lecontecenter_theme_options['linkedin'];?>" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a> </p>
        </div>
      </div>
    </header>
    <nav class="container mobile">
      <div class="row" style="margin-right: 0px; margin-left: 0px;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mainMenu">
          <p><a class="menu-btn">Menu</a></p>
          <!-- <nav id="primaryNav"></nav> --> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 secondaryMenu">
          <div class="secondaryMenu_login"> <a href="account/login/index.html">Login</a> </div>
        </div>
      </div>
    </nav>
    <div class="container desktopNav">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <nav id="siteNav">
            <?php echo str_replace('id="menu-header-menu"', '', $header_menu);?>
         
          </nav>
        </div>
      </div>
    </div>
    <?php if ( is_active_sidebar( 'sidebar-site-notice' ) ) { ?>
    <div class="site-notice">
        <div class="site-notice-content">
            <?php dynamic_sidebar('sidebar-site-notice')?>
        </div>
    </div>
    <?php } ?>
