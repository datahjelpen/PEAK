@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $type->name }} statuses</h1>
	
	<hr>
	@include('admin.superadmin.object.status.form-create')
	<hr>

	@if (count($statuses))
		<ul id="object-types-list">
			@foreach ($statuses as $status)
				<li id="object-types-list-item-{{ $status->id }}" class="object-types-list-item">
					{{ $status->name }}
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $status->id }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-object-type-{{ $status->id }}" class="modal">
						@include('admin.superadmin.object.status.form-edit', [$type->slug, $status->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $status->id }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-object-type-{{ $status->id }}" class="modal">
						@include('admin.superadmin.object.status.form-delete', [$type->slug, $status->slug])
					</div>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
