@php
	if (!isset($object_type)) {
		$object_type = new stdClass();
		$object_type->name = old('name');
		$object_type->slug = old('slug');
		$object_type->template = old('template');
	}
@endphp

<label for="">name</label>
<input type="text" name="name" placeholder="name" value="{{ $object_type->name }}">

<label for="">slug</label>
<input type="text" name="slug" placeholder="slug" value="{{ $object_type->slug }}">

<label for="">template</label>
<input type="text" name="template" placeholder="template" value="{{ $object_type->template }}">