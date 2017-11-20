@php
	if (!isset($item)) {
		$item = new stdClass();
		$item->name = old('name');
		$item->slug = old('slug');
		$item->text = old('text');
		$item->excerpt = old('excerpt');
		$item->author = old('author');
		$item->template = old('template');
		$item->status = old('status');
		$item->comments = old('comments');
	}

	if (isset($item->_old_slug)) {
		$item->slug = $item->_old_slug;
	}

	echo "<pre>";
	var_dump($item);
	echo "</pre>";
@endphp

<label for="item-item-name">{{ __('general.name') }}</label>
<input type="text" id="item-item-name" class="autofocus" name="name" placeholder="name" value="{{ $item->name }}" autofocus>

<label for="item-item-slug">{{ __('general.slug') }}</label>
<input type="text" id="item-item-slug" name="slug" placeholder="slug" value="{{ $item->slug }}">

<label for="item-item-text">{{ __('general.text') }}</label>
<textarea id="item-item-text" name="text" placeholder="text">{{ $item->text }}</textarea>

<label for="item-item-excerpt">{{ __('general.excerpt') }}</label>
<textarea id="item-item-excerpt" name="excerpt" placeholder="excerpt">{{ $item->excerpt }}</textarea>

@foreach ($taxonomies as $taxonomy)
	<p><strong>{{ $taxonomy->name }}</strong></p>
	<ul>
		@foreach ($terms as $term)
			@if ($term['taxonomy'] == $taxonomy->id)
				<li>
					<label for="term-{{ $term['id'] }}">{{ $term['name'] }}</label>
					<input id="term-{{ $term['id'] }}" type="checkbox" name="terms[]" value="{{ $term['id'] }}" {{ $term['id'] == $term->parent ? 'selected' : null }}>

					@if ($term['hasChildren'])
						<ul>
							@foreach ($term['children'] as $child)
								<li>
									<label for="term-{{ $child['id'] }}">{{ $child['name'] }}</label>
									<input id="term-{{ $child['id'] }}" type="checkbox" name="terms[]" value="{{ $child['id'] }}">
								</li>
							@endforeach
						</ul>
					@endif
				</li>
			@endif
		@endforeach
	</ul>
@endforeach


<label for="item-item-author">{{ __('general.author') }}</label>
<select id="item-item-author" name="author">
	<option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
</select>

{{-- <input type="text" id="item-item-author" name="author" placeholder="author" value="{{ $item->author }}"> --}}

<label for="item-item-template">{{ __('general.template') }}</label>
<input type="text" id="item-item-template" name="template" placeholder="template" value="{{ $item->template }}">

{{-- <label for="item-item-status">{{ __('general.status') }}</label>
<input type="text" id="item-item-status" name="status" placeholder="status" value="{{ $item->status }}"> --}}

<p><strong>Statuses</strong></p>
<select name="status">
	@foreach ($statuses as $status)
		<option value="{{ $status['id'] }}">{{ $status['name'] }}</option>

		{{-- {{ $status['id'] == $item->status ? 'selected' : null }} --}}

	@endforeach
</select>

<label for="item-item-comments">{{ __('general.comments') }}</label>
<input type="checkbox" id="item-item-comments" name="comments" placeholder="comments" {{ $item->comments ? 'checked' : null }}>