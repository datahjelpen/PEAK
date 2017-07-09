<form method="POST" action="{{ route('admin.object.term.destroy', [$type->slug, $taxonomy->slug, $term->slug]) }}">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	
	<h1>{{ __('forms.confirm.delete.ask', ['name' => $term->name]) }}</h1>
	<button class="autofocus" type="submit" autofocus>{{ __('forms.confirm.delete.yes') }}</button>
	<button type="button" class="modal-close">{{ __('forms.confirm.delete.no') }}</button>
</form>