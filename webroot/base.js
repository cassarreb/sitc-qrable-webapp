(function ($) {
	
	'use strict';

	function submit() {
		$.post('qr_proc.php', {
			'qr': $('[name="qr"]').val(),
			'submit': 1
		}, response);
		return false;
	}

	function response(data) {
		if (data === '1') {
			var score = localStorage.getItem('score');
			if (score) {
				localStorage.setItem('score', score + 1);
			} else {
				localStorage.setItem('score', 1);
			}
		}
	}

	$('#qr_form').submit(submit);

})(jQuery);