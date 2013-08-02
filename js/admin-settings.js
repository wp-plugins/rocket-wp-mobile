jQuery(function ($) {

$(document).ready(function() {

	$('#reset').click(function(e) {

		e.preventDefault();

		if ( confirm( wpmpjs.confirm_reset ) ) {

			var url = wpmpjs.ajax_url + '?action=wpmp_reset_settings&nonce='+ wpmpjs.reset_nonce;
			
			$.post( url, function(data) {

				alert(wpmpjs.successfull_reset);

				window.location = window.location.href;
				
			});

		}

	});

});

//end
});