@extends('partials.master')

@section('content-main')
	<h1>Welcome {{ Auth::user()->name }}</h1>
	<p>Let's setup your profile</p>
	@include('profile.form-create')
@endsection