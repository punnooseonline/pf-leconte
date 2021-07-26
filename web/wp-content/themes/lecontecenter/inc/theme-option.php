<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" />

<?php

if(isset($_POST['submit']) && $_POST['submit'] == 'Save Changes' )
{
     
	if ( ! function_exists( 'wp_handle_upload' ) ) 
	{
	    require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}
	
	$theme_options = array(
		'facebook' => $_POST['facebook'], 
		'twitter' => $_POST['twitter'], 
		'linkedin' => $_POST['linkedin'], 
		'all_rights_reserved' => $_POST['all_rights_reserved'], 
		'brochure_title'=>$_POST['brochure_title'],
		'button_title'=>$_POST['button_title'],
		'site_phone_no'=>$_POST['site_phone_no'],
		'site_email'=>$_POST['site_email'], 
		'button_url'=>$_POST['button_url'], 
		'brochure_pdf_url' => $_POST['brochure_pdf_url'], 
		'brochure_image_url' => $_POST['brochure_image_url'], 

	);
	
	if (is_uploaded_file($_FILES['brochure_pdf']['tmp_name'])) { 
		$uploadedfile = $_FILES['brochure_pdf'];
		if($uploadedfile['type']!='application/pdf'){
			echo "Only Pdf Are Allowed";
		}
		else{
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		
			if( $movefile && !isset( $movefile['error'] ))
			{		    
			    $theme_options['brochure_pdf_url'] = $movefile['url'];
			} 	
		}
	}

	if (is_uploaded_file($_FILES['brochure_image']['tmp_name'])) {
		
		$brochure_image = $_FILES['brochure_image'];
		$brochure_overrides = array( 'test_form' => false );
		$movebrochurefile = wp_handle_upload( $brochure_image, $brochure_overrides, date("Y/m") );
		//pr($movebrochurefile);
		if ( $movebrochurefile && !isset( $movebrochurefile['error'] ) ) 
		{
		     $theme_options['brochure_image_url']=$movebrochurefile['url'];
		}
	}

	$update = update_option( 'lecontecenter_theme_options', $theme_options, 'no' );
	if($update){
		echo "Save changes sucessfully";
	}
}
 
$lecontecenter_theme_options = get_option('lecontecenter_theme_options',true);
$all_rights_reserved="";
$facebook="";
$twitter="";
$linkedin="";
$brochure_title="";
$brochure_image_url="";
$brochure_pdf_url="";
$button_title="";
$button_url="";
$site_phone_no="";
$site_email="";


if(!empty($lecontecenter_theme_options)){
	$all_rights_reserved = $lecontecenter_theme_options['all_rights_reserved'];
	$facebook = $lecontecenter_theme_options['facebook'];
	$twitter = $lecontecenter_theme_options['twitter'];
	$linkedin = $lecontecenter_theme_options['linkedin'];
	$brochure_title = $lecontecenter_theme_options['brochure_title'];
	$brochure_image_url = $lecontecenter_theme_options['brochure_image_url'];
	$brochure_pdf_url = $lecontecenter_theme_options['brochure_pdf_url'];
	$button_title = $lecontecenter_theme_options['button_title'];
	$button_url = $lecontecenter_theme_options['button_url'];
	$site_phone_no = $lecontecenter_theme_options['site_phone_no'];
	$site_email = $lecontecenter_theme_options['site_email'];
}
//pr($lecontecenter_theme_options);
?>

<form name='theme_option_frm' action="" method='post' enctype='multipart/form-data'>
	<h2>Theme Option</h2>
	<table class="form-table">
		<tr>
			<th><label for="brochure_title">Brochure Title</label></th>
			<td> <input type='text' name='brochure_title' value="<?php echo $brochure_title;?>" required></td>
		</tr>
		<tr>
			<th><label for="brochure_image">Brochure Image</label></th>
			<td>
				<?php 
				if(!empty($brochure_image_url)){
				?>
				<img src="<?php echo $brochure_image_url ;?>" height="80" width="80"/><br> 
				<?php 
				}
				?>
				<input type='file' name='brochure_image'>
				<input type='hidden' name='brochure_image_url' value="<?php echo $brochure_image_url;?>">
			</td>
		</tr>
		<tr>
			<th><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:25px"></i>
			<label for="brochure_file_pdf">Brochure File pdf</label></th>
			<td>
			<?php 
			if(!empty($brochure_pdf_url)){
				echo '<a href="'.$brochure_pdf_url.'" target="_balnk"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:40px"></i></a><br>';
			}
			?>
			<input type='hidden' name='brochure_pdf_url' value="<?php echo $brochure_pdf_url;?>">
			<input type='file' name='brochure_pdf'><br>Only Pdf Are Allowed</td>
		</tr>
		<tr>
			<th><label for="button_title">Button Title</label></th>
			<td> <input type='text' name='button_title' value="<?php echo $button_title;?>" required></td>
		</tr>
		<tr>
			<th><label for="button_url">Button URL</label></th>
			<td> <input type='text' name='button_url' value="<?php echo $button_url;?>" required></td>
		</tr>
		<tr>
			<th><i class="fa fa-facebook-official" aria-hidden="true" style="font-size:25px"></i>
			<label for="facebook_url">Facebook url</label></th>
			<td> <input type='text' name='facebook' value="<?php echo $facebook;?>" required></td>
		</tr>
		<tr>
			<th><i class="fa fa-twitter-square" aria-hidden="true" style="font-size:25px"></i>
			<label for="twitter_url">Twitter url</label></th>
			<td> <input type='text' name='twitter' value="<?php echo $twitter;?>" required></td>
		</tr>
		<tr>
			<th><i class="fa fa-linkedin" aria-hidden="true" style="font-size:25px"></i>
			<label for="linkedin_url">linkedin url</label></th>
			<td> <input type='text' name='linkedin' value="<?php echo $linkedin;?>" required></td>
		</tr>
		<tr>
			<th><label for="copy_rights_text">Copy Rights Text</label></th>
			<td> <input type='text' name='all_rights_reserved' value="<?php echo $all_rights_reserved;?>" required></td>
		</tr>
		<tr>
			<th><label for="site_phone_no">Site Phone No</label></th>
			<td> <input type='text' name='site_phone_no' value="<?php echo $site_phone_no;?>" required></td>
		</tr>
		<tr>
			<th><label for="site_email">Site Email</label></th>
			<td> <input type='text' name='site_email' value="<?php echo $site_email;?>" required></td>
		</tr>
	</table>
	<p class="submit"><input type='submit' name='submit' value='Save Changes' id="sbmt" class="button button-primary"></p>
</form>