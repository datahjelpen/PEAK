@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $taxonomy->name }} terms</h1>
	
	<hr>
	@include('admin.builder.object.term.form-create')
	<hr>

	@if (count($terms))
		<ul id="object-types-list">
			@foreach ($terms as $term)
				<li id="object-types-list-item-{{ $term->id }}" class="object-types-list-item">
					{{ $term->name }}

 					<button class="modal-trigger" data-modal="#show-object-type-{{ $term->id }}">{{ __('navigation.actions.view_quick') }}</button>
					<div id="show-object-type-{{ $term->id }}" class="modal">
						<a href="{{ route('object.term.show', [$type->slug, $taxonomy->slug, $term->slug]) }}">{{ __('general.actions.open') }}</a>
						<a href="{{ route('object.term.show', [$type->slug, $taxonomy->slug, $term->slug]) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a>
						@include('object.term.content-main', ['term' => $term])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $term->id }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-object-type-{{ $term->id }}" class="modal">
						@include('admin.builder.object.term.form-edit', [$type->slug, $taxonomy->slug, $term->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $term->id }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-object-type-{{ $term->id }}" class="modal">
						@include('admin.builder.object.term.form-delete', [$type->slug, $taxonomy->slug, $term->slug])
					</div>

					{{-- <a href="{{ route('object.terms.index', [$type->slug, $taxonomy->slug, $term->slug]) }}">Objects</a> --}}
				</li>
			@endforeach
		</ul>
	@endif
@endsection
