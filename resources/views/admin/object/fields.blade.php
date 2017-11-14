@php
	if (!isset($object)) {
		$object = new stdClass();
		$object->name = old('name');
		$object->slug = old('slug');
		$object->text = old('text');
		$object->excerpt = old('excerpt');
		$object->author = old('author');
		$object->template = old('template');
		$object->status = old('status');
		$object->comments = old('comments');
	}

	if (isset($object->_old_slug)) {
		$object->slug = $object->_old_slug;
	}
@endphp

<label for="object-object-name">{{ __('general.name') }}</label>
<input type="text" id="object-object-name" class="autofocus" name="name" placeholder="name" value="{{ $object->name }}" autofocus>

<label for="object-object-slug">{{ __('general.slug') }}</label>
<input type="text" id="object-object-slug" name="slug" placeholder="slug" value="{{ $object->slug }}">

<label for="object-object-text">{{ __('general.text') }}</label>
<input type="text" id="object-object-text" name="text" placeholder="text" value="{{ $object->text }}">

<label for="object-object-excerpt">{{ __('general.excerpt') }}</label>
<input type="text" id="object-object-excerpt" name="excerpt" placeholder="excerpt" value="{{ $object->excerpt }}">

@foreach ($taxonomies as $taxonomy)
	<label for="object-term-{{ $taxonomy->slug }}">{{ str_singular($taxonomy->name) }}</label>

	<select name="parent" id="object-term-parent">
			<option value="" selected>{{ __('forms.select.value.normal') . ' ' . str_singular($taxonomy->name) }}</option>
			@foreach ($terms as $term)
				@if ($term['taxonomy'] == $taxonomy->id)
					<option value="{{ $term['id'] }}">{{ $term['name'] }}</option>
				@endif

				@if ($term['hasChildren'])
					<optgroup>
						@foreach ($term['children'] as $child)
							<option value="{{ $child['id'] }}">{{ $child['name'] }}</option>
						@endforeach
					</optgroup>
				@endif
			@endforeach
	</select>
@endforeach


<label for="object-object-author">{{ __('general.author') }}</label>
<input type="text" id="object-object-author" name="author" placeholder="author" value="{{ $object->author }}">

<label for="object-object-template">{{ __('general.template') }}</label>
<input type="text" id="object-object-template" name="template" placeholder="template" value="{{ $object->template }}">

<label for="object-object-status">{{ __('general.status') }}</label>
<input type="text" id="object-object-status" name="status" placeholder="status" value="{{ $object->status }}">

<label for="object-object-comments">{{ __('general.comments') }}</label>
<input type="checkbox" id="object-object-comments" name="comments" placeholder="comments" {{ $object->comments ? 'checked' : null }}>