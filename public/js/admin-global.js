(function(w) {
	w.onload = function() {
		$(document).on('click', '.modal-trigger', function() {
			var modal = $(this.getAttribute('data-modal'));
			modal.toggle();

			modal.on('click', '.modal-close', function() {
				modal.off('click');
				modal.hide();
			});
		});

		$('img').each(function() {
			$(this).css({ width: $(this).innerWidth() });
			$(this).addClass('pulse');
			this.setAttribute('src', this.getAttribute('data-highres'));


			this.onload = function() {
				$(this).removeClass('pulse');
			};
		});
	}
})(window);

// function showModal(modal) {

// }

// function getCsrfToken() {
// 	return $('meta[name="csrf-token"]').attr('content');
// }