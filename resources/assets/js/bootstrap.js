
// window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
	window.$ = window.jQuery = require('jquery');
} catch (e) {
	console.log(e);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
	console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Use pjax
// Makes all a href links use ajax
// try {
// 	window.pjax = require("jquery-pjax")
// 	$(document).pjax('a', 'body');

// 	$(document).on('pjax:send', function() {
// 		$('#loader').show()
// 	})
	
// 	$(document).on('pjax:complete', function() {
// 		$('#loader').hide()
// 	})
// } catch (e) {}

// Use feather icons
try {
	window.quill = require('quill');

	require('quill/themes/snow.js');


	var fonts = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
	var toolbarOptions = [
		[{ 'size': [] }, { 'font': fonts }],
		[ 'bold', 'italic', 'underline'],
		[{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'align': [] }],
		[ 'link', 'image', 'video'],
		[ 'formula', 'code-block' ],
		[ 'clean' ]
	];


	var editors = document.querySelectorAll('.wysiwyg-editor');
	for (var i = 0; i < editors.length; i++) {
		var editor = new window.quill('#'+editors[i].getAttribute('id'), {
			modules: {
				toolbar: toolbarOptions
			},
			theme: 'snow'
		});
	}


	// window.quill
} catch (e) {
	console.log(e);
}

// Use quill text editor
try {
	window.feather = require('feather-icons');
	window.feather.replace();
} catch (e) {}

// Modals.js
try {
	require('./modals.js');
	require('./image-loading.js');
} catch (e) {
	console.log(e);
}
