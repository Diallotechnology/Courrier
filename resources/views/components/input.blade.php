@props(['disabled' => false, 'name' => '','type' => '', 'place' => '', 'label' => '', 'value' => '','messages'])

<label {{ $attributes->merge(['class' => 'form-label required text-uppercase']) }}>  
    @empty($label)
    {{ $name }}
    @else
    {{ $label }}
    @endempty
</label>
<input {!! $attributes->merge(['class' => 'form-control mb-2']) !!} type="{{ $type }}"  value="{{ $value }}" 
placeholder="Entrer {{ $place }}" name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} >
<div {{ $attributes->merge(['class' => 'valid-feedback']) }} ></div>
<div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>Ce champ est obligatoire.</div>
{{ $slot }}

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-danger space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif