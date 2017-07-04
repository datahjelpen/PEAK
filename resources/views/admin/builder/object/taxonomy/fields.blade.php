@php
	if (!isset($taxonomy)) {
		$taxonomy = new stdClass();
		$taxonomy->name = old('name');
		$taxonomy->slug = old('slug');
		$taxonomy->hierarchical = old('hierarchical');
	}

	if (isset($taxonomy->_old_slug)) {
		$taxonomy->slug = $taxonomy->_old_slug;
	}
@endphp

<label for="object-taxonomy-name">{{ __('general.name') }}</label>
<input type="text" id="object-taxonomy-name" class="autofocus" name="name" placeholder="name" value="{{ $taxonomy->name }}" autofocus>

<label for="object-taxonomy-slug">{{ __('general.slug') }}</label>
<input type="text" id="object-taxonomy-slug" name="slug" placeholder="slug" value="{{ $taxonomy->slug }}">

<label for="object-taxonomy-hierarchical">{{ __('general.hierarchical') }}</label>
<input type="checkbox" id="object-taxonomy-hierarchical" name="hierarchical" placeholder="hierarchical" {{ $taxonomy->hierarchical ? 'checked' : null }}>