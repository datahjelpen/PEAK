@php
	if (!isset($object_type)) {
		$object_type = new stdClass();
		$object_type->name = old('name');
		$object_type->slug = old('slug');
		$object_type->template = old('template');
	}
@endphp

<label for="object-type-name">name</label>
<input type="text" id="object-type-name" class="autofocus" name="name" placeholder="name" value="{{ $object_type->name }}" required autofocus>

<label for="object-type-slug">slug</label>
<input type="text" id="object-type-slug" name="slug" placeholder="slug" value="{{ $object_type->slug }}">

<label for="object-type-template">template</label>
<input type="number" id="object-type-template" name="template" placeholder="template" value="{{ $object_type->template }}" >