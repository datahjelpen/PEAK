<label for="item-item_type-name">{{ __('general.name') }}</label>
<input type="text" id="item-item_type-name" class="autofocus" name="name" placeholder="name" value="{{ old('name', isset($status->name) ? $status->name : null) }}" required autofocus>

<label for="item-item_type-slug">{{ __('general.slug') }}</label>
<input type="text" id="item-item_type-slug" name="slug" placeholder="slug" value="{{ old('slug', isset($status->slug) ? $status->slug : null) }}">