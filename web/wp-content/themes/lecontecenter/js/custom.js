jQuery(document).ready(function() {
	var maxHeight = -1;

	if ((jQuery('#diveventmaterials').find('a').length) < 1) {
		jQuery('#diveventmaterials').remove();
	}

	jQuery(".eventImageHolder").each(function(index) {
		if ((jQuery(this).find('img').length) < 1) {
			jQuery(this).html('<img src="images/LeConteLogo 175x175.png" style="max-height: 125px;"/>');
		}
	});

	jQuery('.teamMember').each(function() {
		maxHeight = maxHeight > jQuery(this).height() ? maxHeight : jQuery(this).height();
	});

	jQuery('.teamMember').each(function() {
		jQuery(this).height(maxHeight);
	});

	jQuery("#id_email").change(function() {
		var email = jQuery(this).val();
		email = email.replace("@", "");
		email = email.replace(".", "");
		jQuery("#id_username").val(email);
	})

	jQuery(function() {
		jQuery(".datepicker").datepicker();
	});
	jQuery(".phone_part").change(function() {
		var phone1 = jQuery("#Phone1").val();
		var phone2 = jQuery("#Phone2").val();
		var phone3 = jQuery("#Phone3").val();
		jQuery("#phone_number").val(phone1 + phone2 + phone3);
	});
	jQuery(".fax_part").change(function() {
		var fax1 = jQuery("#Fax1").val();
		var fax2 = jQuery("#Fax2").val();
		var fax3 = jQuery("#Fax3").val();
		jQuery("#fax_number").val(fax1 + fax2 + fax3);
	});
	//***** Site Search *****//
	jQuery(".unit.siteSearch input[type='text']").keypress(function(e) {
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13') {
			// Enter pressed. Redirect to search page
			window.location = "http://www.mypigeonforge.com/search/?q=" + jQuery(this).val();
			return false;
		}
	});
	//***** MM-Menu Settings *****//

	//***** FLEXSLIDER *****//
	jQuery('.slideWrapper').flexslider({
		animation: "slide"
	});

	//***** ACCORDION *****//
	//***** Forked version from http://css-tricks.com/snippets/jquery/simple-jquery-accordion/ *****//
	var allPanels = jQuery('.accordion-ver > ul > li');
	var allPanelsContent = jQuery('.accordion-ver > ul > li > div').hide();
	jQuery('.accordion-ver > ul > li > h1').click(function() {
		allPanels.removeClass("active");
		allPanelsContent.slideUp();
		jQuery(this).parent().addClass("active");
		jQuery(this).next().slideDown();
		return false;
	});

	//**** FOOTABLE *****//
	jQuery('.footable').footable({
		breakpoints: {
			phone: 520,
			tablet: 885
		}
	});

	jQuery(".btnCTA").click(function() {
		//if(jQuery(".btnCTA").parent().find('form').attr("pageid") == "4719337") {
			var firstname = jQuery("#Text1").val();
			var lastname  = jQuery("#Text2").val();
			var email     = jQuery("#Text3").val();
			var zip       = jQuery("#Text4").val();
			var phone     = jQuery("#Text5").val();
			var COLUMN52 = [];
			jQuery('input[name="COLUMN52[]"]').each(function(ind,obj){ 
			 if(jQuery(obj).is(':checked') ) COLUMN52.push(jQuery(obj).val());
			});

			if(jQuery("input[name='SUBSCRIPTION_GROUP']").is(":checked")) {
				//alert('input check');
				jQuery.ajax({
			      url: 'http://www.pages02.net/mypigeonforge/enews/LeConte/LeConte_Footer',
			      data: {
			      	 FirstName: firstname,
			      	 LastName: lastname,
			         Email: email,
			         Postalcode : zip,
			         Phone: phone,
			         LeConte_Footer_Form : 'Yes',
			         formSourceName : 'StandardForm',
			         sp_exp : 'yes',
			         COLUMN52 : COLUMN52

			      },
			      method: 'POST',
			      contentType: "application/json",
			      dataType: "jsonp",
			      crossOrigin: true,
			      complete: function(resp){
			      	console.log(resp);
			      }
			   });
			}
			
		//}
	})
});

/* Ajax loading wheel*/
function onBeginRequest(sender, args) {
	jQuery("#leconte_ajax_loader").css('display', 'block');
}

function onEndRequest(sender, args) {
	jQuery("#leconte_ajax_loader").css('display', 'none');
}


//
(function(doc, script) {
	var js,
		fjs = doc.getElementsByTagName(script)[0],
		frag = doc.createDocumentFragment(),
		add = function(url, id) {
			if (doc.getElementById(id)) {
				return;
			}
			js = doc.createElement(script);
			js.src = url;
			id && (js.id = id);
			frag.appendChild(js);
		};

	// Facebook SDK
	add('//connect.facebook.net/en_US/all.js#appId=103683649726113&xfbml=1', 'facebook-jssdk');
	// Twitter SDK
	add('//platform.twitter.com/widgets.js');
	// Pinterest SDK
	add('//assets.pinterest.com/js/pinit.js');

	fjs.parentNode.insertBefore(frag, fjs);
}(document, 'script'));
