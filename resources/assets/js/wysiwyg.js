import Quill from 'quill';
import BlotFormatter, { AlignAction, DeleteAction, ResizeAction, ImageSpec, IframeVideoSpec } from 'quill-blot-formatter'
Quill.register('modules/blotFormatter', BlotFormatter);

class CustomImageSpec extends ImageSpec {
	getActions() {
		return [AlignAction, DeleteAction, ResizeAction];
	}
}

require('quill/themes/snow.js');

var fonts = ['serif', 'sans-serif', 'monospace'];
var toolbarOptions = [
	[{ 'size': [] }, { 'font': fonts }],
	[ 'bold', 'italic', 'underline'],
	[{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'align': [] }],
	[ 'link', 'image', 'video'],
];

var editors = document.querySelectorAll('.wysiwyg-editor');
var forms = [];
var editorsQuill = [];
var editorTargets = [];

for (var i = 0; i < editors.length; i++) {
	(function() {
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
						IframeVideoSpec
					],
					toolbar: {
						buttonStyle: null,
						svgStyle: null
					}
				}
			},
			theme: 'snow',
		});
		editorsQuill.push(quill_editor);
		editorTargets.push(editorTarget);
		editorTarget.hide();

		// custom image upload button
		quill_editor.getModule('toolbar').addHandler('image', function(e) {
			selectLocalImage(this.quill);
		});

		// listen for drop and paste events
		quill_editor.container.addEventListener('dragleave', function (e) { handleDragLeave(e, quill_editor) });
		quill_editor.container.addEventListener('dragover', function (e) { handleDragOver(e, quill_editor) });
		quill_editor.container.addEventListener('drop',      function (e) { handleDrop(e, quill_editor) });
	})();
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


function handleDragLeave(evt, editor) {
	evt.preventDefault();
	$(editor.container).removeClass('wysiwyg-editor-drag-active');
}


function handleDragOver(evt, editor) {
	evt.preventDefault();
	$(editor.container).addClass('wysiwyg-editor-drag-active');
}


function handleDrop(evt, editor) {
	evt.preventDefault();
	$(editor.container).removeClass('wysiwyg-editor-drag-active');

	if (evt.dataTransfer && evt.dataTransfer.files && evt.dataTransfer.files.length) {
		for (var i = 0; i < evt.dataTransfer.files.length; i++) {
			insertLoadingIndicator(editor);
			saveToServer(editor, evt.dataTransfer.files[i]);
		}
	}
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
	input.setAttribute('multiple', true);
	input.click();

	// Listen upload local image and save to server
	input.onchange = () => {
		if (input.files && input.files.length) {
			for (var i = 0; i < input.files.length; i++) {
				var file = input.files[i];
				insertLoadingIndicator(editor);

				// file type is only image.
				if (/^image\//.test(file.type)) {
					saveToServer(editor, file);
				} else {
					removeLoadingIndicator(editor);
					console.warn('You could only upload images.');
				}
			}
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
	var range;

	try {
		range = editor.getSelection()
	} catch (e) {
		console.warn(e);
	}

	if (range) {
		range = range.index;
	} else {
		range = 1;
	}

	editor.insertEmbed(range, 'image', '/uploads/'+url);
	removeLoadingIndicator(editor);
}

// Generate GUID with RFC4122 v4 complianc
function generate_guid() {
	return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
		var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
		return v.toString(16);
	});
}