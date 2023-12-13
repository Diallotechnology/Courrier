@props(['name'=>'','label'=>'','required' =>true])
<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    <label {{ $attributes->merge(['class' => 'form-label text-uppercase']) }} >{{ $label }}</label>
    <select name="{{ $name }}" type="text" {{ $attributes->merge(['class' => 'form-select select-tags']) }}
        value="" @required($required) >
        <option selected disabled value="">Selectionner</option>
        {{ $slot }}
    </select>

    <div {{ $attributes->merge(['class' => 'valid-feedback']) }} ></div>
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>Ce champ est obligatoire.</div>
    <ul {{ $attributes->merge(['class' => 'text-sm text-danger space-y-1']) }}>
        @error($name)
        <li>{{ $message }}</li>
        @enderror
    </ul>
</div>

{{-- @props(['name' => '', 'label' => '', 'required' => true])

<div x-data="{ selectedValue: '' }" {{ $attributes->merge(['class' => 'mb-3']) }}>
    <label {{ $attributes->merge(['class' => 'form-label text-uppercase']) }}>{{ $label }}</label>

    <div x-data="{ tomSelect: null }" x-init="
        tomSelect = new TomSelect($refs.select, {
            copyClassesToDropdown: false,
            dropdownClass: 'dropdown-menu ts-dropdown',
            optionClass: 'dropdown-item',
            controlInput: '<input>',
        });
        tomSelect.on('change', function() {
            selectedValue = tomSelect.getValue();
        });
    ">
        <select x-ref="select" name="{{ $name }}" type="text" {{ $attributes->merge(['class' => 'form-select
            select-tags']) }} value="" @required($required)>
            <option selected disabled value="">Selectionner</option>
            {{ $slot }}
        </select>
    </div>

    <div {{ $attributes->merge(['class' => 'valid-feedback']) }}></div>
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>Ce champ est obligatoire.</div>

    <ul {{ $attributes->merge(['class' => 'text-sm text-danger space-y-1']) }}>
        @error($name)
        <li>{{ $message }}</li>
        @enderror
    </ul>
</div> --}}