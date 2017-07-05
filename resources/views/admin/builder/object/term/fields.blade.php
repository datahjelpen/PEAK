@php
	if (!isset($term)) {
		$term = new stdClass();
		$term->name = old('name');
		$term->slug = old('slug');
		$term->parent = old('parent');
		$term->template = old('template');
	}

	if (isset($term->_old_slug)) {
		$term->slug = $term->_old_slug;
	}
@endphp

<label for="object-term-name">{{ __('general.name') }}</label>
<input type="text" id="object-term-name" class="autofocus" name="name" placeholder="name" value="{{ $term->name }}" autofocus>

<label for="object-term-slug">{{ __('general.slug') }}</label>
<input type="text" id="object-term-slug" name="slug" placeholder="slug" value="{{ $term->slug }}">

<label for="object-term-parent">{{ __('general.parent') }}</label>
<input type="text" id="object-term-parent" name="parent" placeholder="parent" value="{{ $term->parent }}">

<label for="object-term-template">{{ __('general.template') }}</label>
<input type="text" id="object-term-template" name="template" placeholder="template" value="{{ $term->template }}">