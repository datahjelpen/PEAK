<label for="item-item_type-name">{{ __('general.name') }}</label>
<input type="text" id="item-item_type-name" class="autofocus" name="name" placeholder="name" value="{{ old('name', isset($item_type->name) ? $item_type->name : null) }}" required autofocus>

<label for="item-item_type-slug">{{ __('general.slug') }}</label>
<input type="text" id="item-item_type-slug" name="slug" placeholder="slug" value="{{ old('slug', isset($item_type->slug) ? $item_type->slug : null) }}">

<label for="item-item_type-template">{{ __('general.template') }}</label>
<input type="number" id="item-item_type-template" name="template" placeholder="template" value="{{ old('template', isset($item_type->template) ? $item_type->template : null) }}" >