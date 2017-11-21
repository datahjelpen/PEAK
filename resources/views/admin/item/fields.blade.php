<label for="item-item-name">{{ __('general.name') }}</label>
<input type="text" id="item-item-name" class="autofocus" name="name" placeholder="name" value="{{ $item->name }}" autofocus>

<label for="item-item-slug">{{ __('general.slug') }}</label>
<input type="text" id="item-item-slug" name="slug" placeholder="slug" value="{{ $item->slug }}">

<label for="item-item-text">{{ __('general.text') }}</label>
<textarea id="item-item-text" name="text" placeholder="text">{{ $item->text }}</textarea>

<label for="item-item-excerpt">{{ __('general.excerpt') }}</label>
<textarea id="item-item-excerpt" name="excerpt" placeholder="excerpt">{{ $item->excerpt }}</textarea>

@foreach ($item_type->taxonomies as $taxonomy)
	<p><strong>{{ $taxonomy->name }}</strong></p>
	<ul>

		@if ($taxonomy->hierarchical)
			<ul>
				@foreach ($taxonomy->parents as $parent)
					@include('admin.item.field-item-parent')
				@endforeach
			</ul>
		@endif
	</ul>
@endforeach


<label for="item-item-author">{{ __('general.author') }}</label>
<select id="item-item-author" name="author_id">
	@foreach ($users as $user)
		<option value="{{ $user->id }}" {{ $user->id == old('author_id', isset($item->author->id) ? $item->author->id : null) ? 'selected' : null }}>{{ $user->name }}</option>
	@endforeach
</select>

<label for="item-item-template">{{ __('general.template') }}</label>
<input type="text" id="item-item-template" name="template" placeholder="template" value="{{ $item->template }}">

{{-- <label for="item-item-status">{{ __('general.status') }}</label>
<input type="text" id="item-item-status" name="status" placeholder="status" value="{{ $item->status }}"> --}}

<p><strong>Statuses</strong></p>
<select name="status">
	@foreach ($item_type->statuses as $status)
		<option value="{{ $status->id }}">{{ $status->name }}</option>

		{{-- {{ $status['id'] == $item->status ? 'selected' : null }} --}}

	@endforeach
</select>

<label for="item-item-comments">{{ __('general.comments') }}</label>
<input type="checkbox" id="item-item-comments" name="comments" placeholder="comments" {{ $item->comments ? 'checked' : null }}>