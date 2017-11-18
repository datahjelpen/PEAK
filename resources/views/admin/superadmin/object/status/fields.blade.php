@php
	if (!isset($status)) {
		$status = new stdClass();
		$status->name = old('name');
		$status->slug = old('slug');
	}

	if (isset($status->_old_slug)) {
		$status->slug = $status->_old_slug;
	}
@endphp

<label for="object-type-name">{{ __('general.name') }}</label>
<input type="text" id="object-type-name" class="autofocus" name="name" placeholder="name" value="{{ $status->name }}" required autofocus>

<label for="object-type-slug">{{ __('general.slug') }}</label>
<input type="text" id="object-type-slug" name="slug" placeholder="slug" value="{{ $status->slug }}">