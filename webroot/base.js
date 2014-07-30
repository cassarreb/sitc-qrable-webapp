(function ($) {
	
	'use strict';

	function submit(event) {
		$.post('qr_proc.php', {
			'qr': $('[name="qr"]').val(),
			'submit': 1
		}, response);
		event.preventDefault();
	}

	function response(data) {

	}

	$('#qr_form').submit(submit);

})(jQuery);