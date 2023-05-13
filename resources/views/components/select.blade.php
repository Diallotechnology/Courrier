@props(['name'=>'','label'=>'','required' =>true, 'id' => ''])
<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    <label {{ $attributes->merge(['class' => 'form-label text-uppercase']) }} >{{ $label }}</label>
    <select name="{{ $name }}" type="text" {{ $attributes->merge(['class' => 'form-select select-tags']) }}
        value="" @required($required) id="{{ $id }}" >
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