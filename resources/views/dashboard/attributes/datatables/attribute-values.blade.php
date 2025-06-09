@foreach ($attribute->attributeValues as $attribute)
    <div class="badge border-primary primary badge-border">
        {{ $attribute->getTranslation('value', app()->getLocale()) }}
    </div>
@endforeach