
    $(document).ready(function () {
      $("#review_order").click(function(){
		  $("#review_form_error").hide();
		var billing_fname = document.getElementById('billingFirstName').value;
		var billing_lname = document.getElementById('billingLastName').value;		
		var billing_tel = document.getElementById('billingTel').value;		
		var billing_fax = document.getElementById('billingFax').value;		
		var billing_email = document.getElementById('billingemail').value;	
		var billing_address1 = document.getElementById('billingAddress1').value;	
		var billing_address2 = document.getElementById('billingAddress2').value;
		var billing_country = document.getElementById('country_bill').value;
		var billing_city = document.getElementById('billingCity').value;
		var billing_postal_code = document.getElementById('billingPostalCode').value;
		var billing_province = document.getElementById('billingProvince').value;
		var message = $("#billing_comment").val();   	
		
		var shipping_fname = document.getElementById('shippingFirstName').value;
		var shipping_lname = document.getElementById('shippingLastName').value;		
		var shipping_tel = document.getElementById('shippingTel').value;		
		var shipping_fax = document.getElementById('shippingFax').value;		
		var shipping_email = document.getElementById('shippingemail').value;	
		var shipping_address1 = document.getElementById('shippingAddress1').value;	
		var shipping_address2 = document.getElementById('shippingAddress2').value;
		var shipping_country = document.getElementById('country_ship').value;
		var shipping_city = document.getElementById('shippingCity').value;
		var shipping_postal_code = document.getElementById('shippingPostalCode').value;	
		var shipping_province = document.getElementById('shippingProvince').value;		
		var shipping_check = document.getElementById('shipping-info-check').checked;
		
		if (billing_fname.length == 0 || billing_lname.length== 0 || billing_tel.length== 0 || billing_email.length== 0 || billing_address1.length== 0 || billing_city.length== 0 || billing_postal_code.length== 0) {
			$("#review_form_error").fadeIn(600).html("<p style=\"font-size:14px;\"><font color=\"red\"><strong>请提供需要的账单信息(*)</strong></font></p>");
		}else {
			
			if (shipping_check == true) {
				$('#bfname').val(billing_fname);
				$('#blname').val(billing_lname);
				$('#btel').val(billing_tel);
				$('#bfax').val(billing_fax);
				$('#bemail').val(billing_email);
				$('#baddress1').val(billing_address1);
				$('#baddress2').val(billing_address2);
				$('#bcountry').val(billing_country);
				$('#bcity').val(billing_city);
				$('#bpostal').val(billing_postal_code);
				$('#bprovince').val(billing_province);
				$('#bcomment').val(message);
				$('#shipping_is_same').val(shipping_check);
				
				document.getElementById("review_confirm_form").submit();
								
			} else {
				if (shipping_fname.length == 0 || shipping_lname.length== 0 || shipping_tel.length== 0 || shipping_email.length== 0 || shipping_address1.length== 0 || shipping_city.length== 0 || shipping_postal_code.length== 0) {
					$("#review_form_error").fadeIn(600).html("<p style=\"font-size:14px;\"><font color=\"red\"><strong>请提供需要的邮递信息(*)</strong></font></p>");
				}else {
					$('#bfname').val(billing_fname);
					$('#blname').val(billing_lname);
					$('#btel').val(billing_tel);
					$('#bfax').val(billing_fax);
					$('#bemail').val(billing_email);
					$('#baddress1').val(billing_address1);
					$('#baddress2').val(billing_address2);
					$('#bcountry').val(billing_country);
					$('#bcity').val(billing_city);
					$('#bpostal').val(billing_postal_code);
					$('#bprovince').val(billing_province);
					
					$('#sfname').val(shipping_fname);
					$('#slname').val(shipping_lname);
					$('#stel').val(shipping_tel);
					$('#sfax').val(shipping_fax);
					$('#semail').val(shipping_email);
					$('#saddress1').val(shipping_address1);
					$('#saddress2').val(shipping_address2);
					$('#scountry').val(shipping_country);
					$('#scity').val(shipping_city);
					$('#spostal').val(shipping_postal_code);
					$('#sprovince').val(shipping_province);
					
					$('#bcomment').val(message);
					$('#shipping_is_same').val(shipping_check);
					document.getElementById("review_confirm_form").submit();
				}	
			}
	
		}


      });
    });