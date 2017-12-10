
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

// Generate GUID with RFC4122 v4 complianc
function generate_guid() {
	return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
		var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
		return v.toString(16);
	});
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

// Use quill text editor


import Quill from 'quill';
import BlotFormatter, { AlignAction, DeleteAction, ResizeAction, ImageSpec } from 'quill-blot-formatter'
Quill.register('modules/blotFormatter', BlotFormatter);

class CustomImageSpec extends ImageSpec {
	getActions() {
		return [AlignAction, DeleteAction, ResizeAction];
	}
}

try {
	require('quill/themes/snow.js');

	var fonts = ['serif', 'sans-serif', 'monospace'];
	var toolbarOptions = [
		[{ 'size': [] }, { 'font': fonts }],
		[ 'bold', 'italic', 'underline'],
		[{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'align': [] }],
		[ 'link', 'image', 'video'],
		[ 'formula', 'code-block' ],
		[ 'clean' ]
	];

	var editors = document.querySelectorAll('.wysiwyg-editor');
	var forms = [];
	var editorsQuill = [];
	var editorTargets = [];

	for (var i = 0; i < editors.length; i++) {
		var editor = editors[i];
		var editorTarget = $(editor).next('.wysiwyg-editor-target');
		var form = editorTarget[0].form;

		if (!(forms.indexOf(form) > -1)) {
			forms.push(form);
		}

		// Setup unique classname for all editor elements to ensure uniqueness and avoid duplicate toolbars
		var random = 'unique_'+generate_guid();
		var id = '#'+editor.getAttribute('id')+'.'+random;
		editor.className += ' '+random;
		editorTarget[0].className = ' '+random;


		// Setup Quill editor
		var quill_editor = new Quill(id, {
			modules: {
				toolbar: toolbarOptions,
				blotFormatter: {
					specs: [
						CustomImageSpec,
					],
					toolbar: {
						buttonStyle: {
						},
						svgStyle: {
						}
					}
				}
			},
			theme: 'snow'
		});
		editorsQuill.push(quill_editor);
		editorTargets.push(editorTarget);

		// custom image upload button
		quill_editor.getModule('toolbar').addHandler('image', function(e) {
			selectLocalImage(this.quill);
		});

	}
	
	for (var i = 0; i < forms.length; i++) {
		forms[i].addEventListener('submit', function(e) {
			for (var i = 0; i < editorsQuill.length; i++) {
				var contentHTML = editorsQuill[i].container.firstChild.innerHTML;
				var contentDelta = editorsQuill[i].getContents();

				if (contentDelta.length() > 1) {
					editorTargets[i].val(contentHTML);
				}
			}

			return false;
		});

	}

	var loadingIndicatorURL = '/images/graphics/image-upload-loading.gif';

	function insertLoadingIndicator(editor) {
		var range = editor.getSelection();

		if (range) {
			range = range.index;
		} else {
			range = 1;
		}

		editor.insertEmbed(range, 'image', loadingIndicatorURL);
	}


	function removeLoadingIndicator(editor) {
		var content = editor.getContents();

		for (var i = 0; i < content.ops.length; i++) {
			var image = content.ops[i].insert.image;

			if (image && image == loadingIndicatorURL) {
				delete content.ops[i];
			}
		}

		editor.setContents(content);
	}

	function selectLocalImage(editor) {
		var input = document.createElement('input');
		input.setAttribute('type', 'file');
		input.click();

		// Listen upload local image and save to server
		input.onchange = () => {
			var file = input.files[0];
			insertLoadingIndicator(editor);

			// file type is only image.
			if (/^image\//.test(file.type)) {
				saveToServer(editor, file);
			} else {
				removeLoadingIndicator(editor);
				console.warn('You could only upload images.');
			}
		};
	}

	function saveToServer(editor, file) {
		var fd = new FormData();
		fd.append('image', file);

		$.ajax({
			url:'/upload/image',
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				insertToEditor(editor, data.url);
			},
			error: function(data){
				removeLoadingIndicator(editor);
			}
		});
	}

	function insertToEditor(editor, url) {
		var range = editor.getSelection();

		if (range) {
			range = range.index;
		} else {
			range = 1;
		}

		editor.insertEmbed(range, 'image', '/uploads/'+url);
		removeLoadingIndicator(editor);
	}
} catch (e) {
	console.log(e);
}

// Use feather icons
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
