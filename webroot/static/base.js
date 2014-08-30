(function ($) {
	
	'use strict';


	//Easter eggs

	function checkForEasterEgg(funfact) {
		var standEasterEggs = [
			{
				pattern: /barell/,
				action: function doBarellRoll() {

				}
			}
		];

		standEasterEggs.some(function checkIfEasterEgg(easterEgg) {
			if (easterEgg.pattern.test(funfact)) {
				easterEgg.action();
				return true;
			}

			return false;
		});
	}


	//Game start

	function start() {
		$('#start_modal').modal('hide');
	}

	$('#start_modal').modal('show');
	$('#start').click(start);


	//Form submission

	function submit() {
		$('.waiting').addClass('show');

		var data = {
			'qr': $('#qr').val(),
			'submit': 1
		};
		$.post('server.php', data, response).fail(error);

		return false;
	}

	function response(data) {
		$('.waiting').removeClass('show');
		$('#qr').val('');

		var resObj = JSON.parse(data);
		if (resObj.found) {
			$('#duplicate_qr').modal('show');
		} else if (resObj.non_occuring) {
			$('#non_occuring_qr').modal('show');
		} else if (resObj.qr_remaining) {
			$('#qr_remaining').text(resObj.qr_remaining);
			$('#funfact').text(resObj.funfact);

			checkForEasterEgg(resObj.funfact);
		}

		if (resObj.already_won) {
			$('#already_won').modal('show');
		}

		if (resObj.token_code && resObj.token_code !== -1) {
			$('#token_code').text(resObj.token_code);
			$('#token_code_modal').modal('show');
		}
	}

	function error() {
		$('#xhr_error').modal('show');
	}

	$('#qr_form').submit(submit);


	//QR conversion

	window.URL = window.URL || window.webkitURL;

	function showDialog() {
		$('#load_qr').click();
	}

	function loadQR() {
		var files = this.files;

		if (! files) {
			$('#file_reader_ns').modal('show');
			return;
		}

		if (! files.length) {
			return;
		}

		try {
			var imageURL = URL.createObjectURL(files[0]);
			qrcode.decode(imageURL);
		} catch (e) {
			$('#object_url_ns').modal('show');
		}
	}

	function converted(qr) {
		$('#qr').val(qr);
	}

	$('#get_qr').click(showDialog);
	$('#load_qr').on('change', loadQR);
	qrcode.callback = converted;

})(jQuery);
