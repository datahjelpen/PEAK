(function(w) {
	w.onload = function() {
		$(document).on('click', '.modal-trigger', function() {
			var modal = $(this.getAttribute('data-modal'));
			modal.toggle();
			modal.find('.autofocus').trigger('focus');

			modal.on('click', '.modal-close', function() {
				modal.off('click');
				modal.hide();
			});
		});

		$('img.comp').each(function() {
			var img = $(this);
			var newImg = new Image();
			newImg.src = img.attr('data-highres');

			$(newImg).ready(function() {
				img.css({ width: img.innerWidth() });
				img.attr('src', newImg.src);
				// img.removeClass('pulse');
			});
		});
	}
})(window);
