@php
	if (!isset($type)) {
		$type = new stdClass();
		$type->name = old('name');
		$type->slug = old('slug');
		$type->template = old('template');
	}

	if (isset($type->_old_slug)) {
		$type->slug = $type->_old_slug;
	}
@endphp

<label for="object-type-name">name</label>
<input type="text" id="object-type-name" class="autofocus" name="name" placeholder="name" value="{{ $type->name }}" required autofocus>

<label for="object-type-slug">slug</label>
<input type="text" id="object-type-slug" name="slug" placeholder="slug" value="{{ $type->slug }}">

<label for="object-type-template">template</label>
<input type="number" id="object-type-template" name="template" placeholder="template" value="{{ $type->template }}" >