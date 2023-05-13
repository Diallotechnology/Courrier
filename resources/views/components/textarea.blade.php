@props(['value'=>'', 'label'=>'','place'=>'', 'required'=> true, 'name'=>''])

<div class="mb-3">
    <label for="{{ $name }}" {{ $attributes->merge(['class' => 'form-label text-uppercase']) }}>
        @empty($label)
        {{ $name }}
        @else
        {{ $label }}
        @endempty
    </label>
    <textarea @required($required) name="{{ $name }}" id="{{ $name }}" {{
        $attributes->merge(['class' => 'form-control']) }} rows="4" placeholder="{{ $place }}">{{ $value }}</textarea>
</div>