@props([
    'name',
    'label' => '',
    'checked' => false,
    'disabled' => false,
])

<div class="mb-3 form-check">
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $name }}"
           {{ old($name, $checked) ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}
           {{ $attributes->merge(['class' => 'form-check-input']) }}>

    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>

    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>
