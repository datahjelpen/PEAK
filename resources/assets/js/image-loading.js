(function() {
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
})();