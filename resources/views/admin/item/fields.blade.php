<label for="item-item-name">{{ __('general.name') }}</label>
<input type="text" id="item-item-name" class="autofocus" name="name" placeholder="name" value="{{ old('name', isset($item->name) ? $item->name : null) }}" autofocus>

<label for="item-item-slug">{{ __('general.slug') }}</label>
<input type="text" id="item-item-slug" name="slug" placeholder="slug" value="{{ old('slug', isset($item->slug) ? $item->slug : null) }}">

<label for="item-item-text-{{ str_random(15) }}">{{ __('general.text') }}</label>
{{-- <textarea class="wysiwyg-editor" id="item-item-text" name="text" placeholder="text">{{ old('text', isset($item->text) ? $item->text : null) }}</textarea> --}}
<div class="wysiwyg-editor" id="item-item-text-{{ str_random(15) }}" name="text">{{ old('text', isset($item->text) ? $item->text : null) }}</div>

<label for="item-item-excerpt-{{ str_random(15) }}">{{ __('general.excerpt') }}</label>
{{-- <textarea class="wysiwyg-editor" id="item-item-excerpt-{{ str_random(15) }}" name="excerpt" placeholder="excerpt">{{ old('excerpt', isset($item->excerpt) ? $item->excerpt : null) }}</textarea> --}}
<div class="wysiwyg-editor" id="item-item-excerpt-{{ str_random(15) }}" name="excerpt">{{ old('excerpt', isset($item->excerpt) ? $item->excerpt : null) }}</div>

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
	@can('view users')
		@foreach ($users as $user)
			<option value="{{ $user->id }}" {{ $user->id == old('author_id', isset($item->author->id) ? $item->author->id : null) ? 'selected' : null }}>{{ $user->name }}</option>
		@endforeach
	@else
		@php
			$user = Auth::user();
		@endphp
		<option value="{{ $user->id }}" {{ $user->id == old('author_id', isset($item->author->id) ? $item->author->id : null) ? 'selected' : null }}>{{ $user->name }}</option>
	@endcan
</select>

<label for="item-item-template">{{ __('general.template') }}</label>
<input type="text" id="item-item-template" name="template" placeholder="template" value="{{ old('template', isset($item->template) ? $item->template : null) }}">

@can('view statuses')
	<p><strong>Statuses</strong></p>
	<select name="status_id">
		@foreach ($item_type->statuses as $status)
			<option value="{{ $status->id }}" {{ $status->id == old('status', isset($item->status->id) ? $item->status->id : null) ? 'selected' : null }}>{{ $status->name }}</option>
		@endforeach
	</select>
@endcan

<label for="item-item-comments">{{ __('general.comments') }}</label>
<input type="checkbox" id="item-item-comments" name="comments" placeholder="comments" {{ old('comments', isset($item->comments) ? $item->comments : null) ? 'checked' : null }}>