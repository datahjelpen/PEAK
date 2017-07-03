@extends('admin.partials.master')

@section('content-main')
	<h1>Object types</h1>
	
	<hr>
	@include('admin.builder.object_type.form-create')
	<hr>

	@if (count($object_types))
		<ul id="object-types-list">
			@foreach ($object_types as $object_type)
				<li id="object-types-list-item-{{ $object_type->slug }}" class="object-types-list-item">
					{{ $object_type->name }}

					<button class="modal-trigger" data-modal="#show-object-type-{{ $object_type->slug }}">Quick-view</button>
					<div id="show-object-type-{{ $object_type->slug }}" class="modal">
						<a href="{{ route('object_type.show', $object_type->slug) }}">Open</a>
						<a href="{{ route('object_type.show', $object_type->slug) }}" target="_blank">Open in new tab</a>
						@include('object_type.content-main', ['object_type' => $object_type])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $object_type->slug }}">Edit</button>
					<div id="edit-object-type-{{ $object_type->slug }}" class="modal">
						@include('admin.builder.object_type.form-edit', ['object_type' => $object_type])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $object_type->slug }}">Delete</button>
					<div id="delete-object-type-{{ $object_type->slug }}" class="modal">
						@include('admin.builder.object_type.form-delete', ['object_type' => $object_type])
					</div>

					<a href="{{ route('object_taxonomy.index', $object_type->slug) }}">Taxonomies</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
