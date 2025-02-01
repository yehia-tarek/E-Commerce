@props([
    'name',
    'label' => '',
    'value' => '',
    'rows' => 3,
    'required' => false,
    'disabled' => false,
    'placeholder' => '',
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <textarea name="{{ $name }}"
              id="{{ $name }}"
              rows="{{ $rows }}"
              {{ $required ? 'required' : '' }}
              {{ $disabled ? 'disabled' : '' }}
              placeholder="{{ $placeholder }}"
              {{ $attributes->merge(['class' => 'form-control']) }}>{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>
