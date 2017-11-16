@extends('admin.partials.master')

@section('content-main')
	<h1>{{ str_plural($type->name) }}</h1>
	
	<hr>
	@include('admin.object.form-create')
	<hr>

	@if (count($objects))
		<ul id="object-terms-list">
			@foreach ($objects as $object)
				<li id="object-types-list-item-{{ $object->id }}" class="object-types-list-item">
					{{ $object->name }}

					<button class="modal-trigger" data-modal="#show-object-type-{{ $object->id }}">{{ __('navigation.actions.view_quick') }}</button>
					<div id="show-object-type-{{ $object->id }}" class="modal">
						<a href="{{ route('object.show', [$type->slug, $object->slug]) }}">{{ __('general.actions.open') }}</a>
						<a href="{{ route('object.show', [$type->slug, $object->slug]) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a>
						<button class="modal-close"><i data-feather="x-square"></i></button>
						@include('object.content-main', ['object' => $object])
					</div>

					<button class="modal-trigger" data-modal="#edit-object-type-{{ $object->id }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-object-type-{{ $object->id }}" class="modal">
						<button class="modal-close"><i data-feather="x-square"></i></button>
						@include('admin.object.form-edit', [$type->slug, $object->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $object->id }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-object-type-{{ $object->id }}" class="modal">
						<button class="modal-close"><i data-feather="x-square"></i></button>
						@include('admin.object.form-delete', [$type->slug, $object->slug])
					</div>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
