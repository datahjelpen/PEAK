@extends('admin.partials.master')

@section('content-main')
	<h1>Object types</h1>
	
	<hr>
	@include('admin.builder.object_type.form-add')
	<hr>

	@if (count($object_types))
		<ul id="object-types-list">
			@foreach ($object_types as $object_type)
				<li id="object-types-list-item-{{ $object_type->id }}" class="object-types-list-item">
					{{ $object_type->name }}
					<ul>
						<li>id:       {{ $object_type->id }}</li>
						<li>slug:     {{ $object_type->slug }}</li>
						<li>template: {{ $object_type->template }}</li>
					</ul>

					<button class="modal-trigger" data-modal="#edit-object-type-{{ $object_type->id }}">Edit</button>
					<div id="edit-object-type-{{ $object_type->id }}" class="modal">
						@include('admin.builder.object_type.form-edit', ['id' => $object_type->id])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $object_type->id }}">Delete</button>
					<div id="delete-object-type-{{ $object_type->id }}" class="modal">
						@include('admin.builder.object_type.form-delete', ['id' => $object_type->id])
					</div>
				</li>
			@endforeach
		</ul>



		<script>
			(function(w) {
				w.onload = function() {
					var objectTypesList = $('#object-types-list');

					objectTypesList.on('click', '.object-types-list-item .action.edit', function() {
						$(this).attr('disabled', true);
						objectEdit($(this).attr('data-url'));
					});

					objectTypesList.on('click', '.object-types-list-item .action.delete', function() {
						$(this).attr('disabled', true);
						objectDelete($(this).attr('data-url'));
					});
				}

				function objectEdit(type, url) {
					var form = $('#form-edit-' + type);
					form.attr('action', url);
					form.submit();
				}

				function objectDelete(type, url) {
					var form = $('#form-delete');
					form.attr('action', url);
					form.submit();
				}
			})(window);

		</script>
	@endif
@endsection
