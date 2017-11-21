(function() {
	$(document).on('click', '.modal-trigger', function() {
		var modal = $(this.getAttribute('data-modal'));
		modal.toggle();
		modal.find('.autofocus').trigger('focus');

		modal.on('click', '.modal-close', function() {
			modal.off('click');
			modal.hide();
		});
	});
})();