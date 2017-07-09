@extends('admin.partials.master')

@section('content-main')
	<h1>Object types</h1>
	
	<hr>
	@include('admin.superadmin.object.type.form-create')
	<hr>

	@if (count($types))
		<ul id="object-types-list">
			@foreach ($types as $type)
				<li id="object-types-list-item-{{ $type->slug }}" class="object-types-list-item">
					{{ $type->name }}

					<button class="modal-trigger" data-modal="#show-object-type-{{ $type->slug }}">{{ __('navigation.actions.view_quick') }}</button>
					<div id="show-object-type-{{ $type->slug }}" class="modal">
						<a href="{{ route('object.type.show', $type->slug) }}">{{ __('general.actions.open') }}</a>
						<a href="{{ route('object.type.show', $type->slug) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a>
						@include('object.type.content-main', ['type' => $type])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $type->slug }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-object-type-{{ $type->slug }}" class="modal">
						@include('admin.superadmin.object.type.form-edit', ['type' => $type])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $type->slug }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-object-type-{{ $type->slug }}" class="modal">
						@include('admin.superadmin.object.type.form-delete', ['type' => $type])
					</div>

					<a href="{{ route('superadmin.object.taxonomies', $type->slug) }}">Taxonomies</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
