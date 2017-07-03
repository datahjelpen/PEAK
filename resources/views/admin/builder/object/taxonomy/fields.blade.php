@php
	if (!isset($object_taxonomy)) {
		$object_taxonomy = new stdClass();
		$object_taxonomy->name = old('name');
		$object_taxonomy->slug = old('slug');
		$object_taxonomy->hierarchical = old('hierarchical');
	}

	if (isset($object_taxonomy->_old_slug)) {
		$object_taxonomy->slug = $object_taxonomy->_old_slug;
	}
@endphp

<label for="object-taxonomy-name">name</label>
<input type="text" id="object-taxonomy-name" class="autofocus" name="name" placeholder="name" value="{{ $object_taxonomy->name }}" autofocus>

<label for="object-taxonomy-slug">slug</label>
<input type="text" id="object-taxonomy-slug" name="slug" placeholder="slug" value="{{ $object_taxonomy->slug }}">

<label for="object-taxonomy-hierarchical">hierarchical</label>
<input type="checkbox" id="object-taxonomy-hierarchical" name="hierarchical" placeholder="hierarchical" {{ $object_taxonomy->hierarchical ? 'value="on"' : null }}>