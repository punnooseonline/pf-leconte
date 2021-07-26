<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */
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
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url();?>/favicon.ico">
  	<?php wp_head(); ?>
  	<style>
	.outer {
	    overflow: hidden;
	    *position: relative;
	}

	.inner {
	    float: left;
	    position: relative;
	    left: 50%;
	}
	img {
	    display: block;
	    position: relative;
	    left: -50%;
	}
	</style>
</head>

<body <?php body_class(); ?>>
<?php
if ( have_posts() ){
	// Start the loop.
	while ( have_posts() ){
		the_post();
		$coupon_id = get_the_ID();
		$coupon_address_1 = get_post_meta($coupon_id, 'coupon_address_1', true);
		$coupon_address_2 = get_post_meta($coupon_id, 'coupon_address_2', true);
		$coupon_city = get_post_meta($coupon_id, 'coupon_city', true);
		$coupon_state = get_post_meta($coupon_id, 'coupon_state', true);
		$coupon_zip = get_post_meta($coupon_id, 'coupon_zip', true);
		$coupon_discount = get_post_meta($coupon_id, 'coupon_discount', true);
		$coupon_description = get_post_meta($coupon_id, 'coupon_description', true);
		$coupon_url = get_post_meta($coupon_id, 'coupon_url', true);
		$coupon_code = get_post_meta($coupon_id, 'coupon_code', true);
		$coupon_start_date = get_post_meta($coupon_id, 'coupon_start_date', true);
		$coupon_finish_date = get_post_meta($coupon_id, 'coupon_finish_date', true);
	?>
	<div class="row" style="margin: 0px;">
	    <div class="col-md-4 col-sm-12 col-xs-12" style="border-style: dashed; border-width: 4px; border-color: lightslategrey; font-family: Lato, sans-serif; background-color: blanchedalmond; padding: 10px;">
	        <div>
	            <div class="outer">
	                <div class="inner"><?php echo get_the_post_thumbnail( $coupon_id, 'thumb' );  ?></div>
	            </div>
	            <div class="" style="text-align: center;">
	                <h1><span><?php echo $coupon_discount;?></span></h1>
	                <h3><span>At <?php the_title();?></span></h3>
	                <p><?php echo $coupon_description;?></p>
	            </div>
	            <div class="" style="text-align: center;">
	                <span><strong>Coupon Code:</strong> <?php echo $coupon_code;?></span>
	                <br/>
	            </div>
	            <br/>
	            <div class="" style="text-align: center;">
	                <span><strong>Expiration Date:</strong> 
	                <?php 
                    if(!empty($coupon_finish_date)){
                        $coupon_exp_date = new DateTime($coupon_finish_date);
                        echo $coupon_exp_date->format('F j, Y');
                    }
                    else{
                    	echo "None";
                    }
                    ?>
                    </span>
	                <br/>
	                <br/>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-8 col-sm-12 col-xs-12">
	    </div>
	</div>
	<?php 
	// End of the loop.
	}
}

wp_footer(); ?>
</body>
</html>