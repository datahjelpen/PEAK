<form method="POST" action="{{ route('admin.object.destroy', [$type->slug, $object->slug]) }}">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	
	<h1>{{ __('forms.confirm.delete.ask', ['name' => $object->name]) }}</h1>
	<button class="autofocus" type="submit" autofocus>{{ __('forms.confirm.delete.yes') }}</button>
	<button type="button" class="modal-close">{{ __('forms.confirm.delete.no') }}</button>
</form>