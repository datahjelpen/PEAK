@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $item_type->name }} statuses</h1>
	
	<hr>
	@include('admin.superadmin.item.status.form-create')
	<hr>

	@if (count($item_type->statuses))
		<ul id="item-item_types-list">
			@foreach ($item_type->statuses as $status)
				<li id="item-item_types-list-item-{{ $status->id }}" class="item-item_types-list-item">
					{{ $status->name }}
					
					<button class="modal-trigger" data-modal="#edit-item-item_type-{{ $status->id }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-item-item_type-{{ $status->id }}" class="modal">
						@include('admin.superadmin.item.status.form-edit', [$item_type->slug, $status->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-item-item_type-{{ $status->id }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-item-item_type-{{ $status->id }}" class="modal">
						@include('admin.superadmin.item.status.form-delete', [$item_type->slug, $status->slug])
					</div>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
