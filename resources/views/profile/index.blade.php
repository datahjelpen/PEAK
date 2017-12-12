@extends('partials.master')

@section('content-main')
    <p><a href="{{ route('profile.show', $profile->url) }}">See how others see your profile</a></p>

    @include('profile.content-main')


    <button class="modal-trigger" data-modal="#edit-profile-{{ $profile->id }}">{{ __('general.actions.edit') }}</button>
    <div id="edit-profile-{{ $profile->id }}" class="modal">
        <button class="modal-close"><i data-feather="x-square"></i></button>
        @include('profile.form-edit', [$profile->id])
    </div>

    {{--
    <button class="modal-trigger" data-modal="#delete-profile-{{ $profile->id }}">{{ __('general.actions.delete') }}</button>
    <div id="delete-profile-{{ $profile->id }}" class="modal">
        @include('profile.form-delete', [$profile->id])
    </div>
    --}}

    <hr>

    <h2>Security roles</h2>
    @role('superadmin')
        <p>I am a superadmin!</p>
    @else
        <p>I am not a superadmin...</p>
    @endrole

    @role('admin')
        <p>I am an admin!</p>
    @else
        <p>I am not an admin...</p>
    @endrole

    @role('writer')
        <p>I am a writer!</p>
    @else
        <p>I am not a writer...</p>
    @endrole

    @can('view users')
        <p>User can view users</p>
    @else
        <p>User cannot view users</p>
    @endcan

    @can('update terms')
        <p>User can update terms</p>
    @else
        <p>User cannot update terms</p>
    @endcan


{{--     <p>Can {{ $profile->name_display }} view users?</p>
    <p>Can {{ $profile->name_display }} create users? {{ dump($profile->user->can('create users')) }}</p>
    <p>Can {{ $profile->name_display }} update users? {{ dump($profile->user->can('update users')) }}</p>
    <p>Can {{ $profile->name_display }} delete users? {{ dump($profile->user->can('delete users')) }}</p> --}}
@endsection
