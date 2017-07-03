@extends('admin.partials.master')

@section('content-main')
	<h1>Object types</h1>
	
	<hr>
	@include('admin.builder.object_type.form-create')
	<hr>

	@if (count($types))
		<ul id="object-types-list">
			@foreach ($types as $type)
				<li id="object-types-list-item-{{ $type->slug }}" class="object-types-list-item">
					{{ $type->name }}

					<button class="modal-trigger" data-modal="#show-object-type-{{ $type->slug }}">Quick-view</button>
					<div id="show-object-type-{{ $type->slug }}" class="modal">
						<a href="{{ route('object.type.show', $type->slug) }}">Open</a>
						<a href="{{ route('object.type.show', $type->slug) }}" target="_blank">Open in new tab</a>
						@include('object_type.content-main', ['object_type' => $type])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $type->slug }}">Edit</button>
					<div id="edit-object-type-{{ $type->slug }}" class="modal">
						@include('admin.builder.object_type.form-edit', ['object_type' => $type])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $type->slug }}">Delete</button>
					<div id="delete-object-type-{{ $type->slug }}" class="modal">
						@include('admin.builder.object_type.form-delete', ['object_type' => $type])
					</div>

					<a href="{{ route('object.taxonomies.index', $type->slug) }}">Taxonomies</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
