<form method="POST" action="{{ route('profile.destroy', $profile->id) }}">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	
	<h1>{{ __('forms.confirm.delete.ask', ['name' => $profile->name_display]) }}</h1>
	<button class="autofocus" type="submit" autofocus>
		<i data-feather="{{ __('forms.confirm.delete.yes-icon') }}"></i>
		<span>{{ __('forms.confirm.delete.yes') }}</span>
	</button>
	<button type="button" class="modal-close">
		<i data-feather="{{ __('forms.confirm.delete.no-icon') }}"></i>
		<span>{{ __('forms.confirm.delete.no') }}</span>
	</button>
</form>