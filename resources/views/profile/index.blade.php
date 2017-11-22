@extends('partials.master')

@section('content-main')
	@include('profile.content-main')

	<button class="modal-trigger" data-modal="#edit-profile-{{ $profile->id }}">{{ __('general.actions.edit') }}</button>
	<div id="edit-profile-{{ $profile->id }}" class="modal">
		@include('profile.form-edit', [$profile->id])
	</div>

	<button class="modal-trigger" data-modal="#delete-profile-{{ $profile->id }}">{{ __('general.actions.delete') }}</button>
	<div id="delete-profile-{{ $profile->id }}" class="modal">
		@include('profile.form-delete', [$profile->id])
	</div>
</li>
@endsection
