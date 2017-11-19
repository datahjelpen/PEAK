@php
	$parent_id = old('parent_id', isset($term) ? $term->parent()->get()->first()['id'] : null);
@endphp
<label for="term-{{ $_term->id }}">{{ $_term->name }}</label>
<input id="term-{{ $_term->id }}" type="radio" name="parent_id" value="{{ $_term->id }}" {{ ($parent_id == $_term->id) ? 'checked' : null }}>