<label for="term-{{ $term->id }}">{{ $term->name }}</label>
<input id="term-{{ $term->id }}" type="radio" name="parent_id" value="{{ $term->id }}">