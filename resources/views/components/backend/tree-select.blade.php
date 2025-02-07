@props(['categories', 'selected' => null, 'name' => 'category_id', 'required' => false])

@php
    function renderTreeSelect($categories, $level = 0, $selected = null) {
        $html = '';
        foreach ($categories as $category) {
            $padding = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
            $symbol = $level > 0 ? '└─ ' : '';

            $isSelected = is_array($selected)
                ? in_array($category['id'], $selected)
                : $selected == $category['id'];

            $html .= sprintf(
                '<option value="%s" %s>%s%s%s</option>',
                $category['id'],
                $isSelected ? 'selected' : '',
                $padding,
                $symbol,
                e($category['name'])
            );

            if (!empty($category['children'])) {
                $html .= renderTreeSelect($category['children'], $level + 1, $selected);
            }
        }
        return $html;
    }

    // Get old value if validation fails
    $oldValue = old($name, $selected);
@endphp

<div class="form-group">
    <label for="{{ $name }}" class="form-label">
        Select Category
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-select @error($name) is-invalid @enderror"
        {{ $required ? 'required' : '' }}
    >
        <option value="">Select a category</option>
        {!! renderTreeSelect($categories, 0, $oldValue) !!}
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<style>
    .form-select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        font-size: 1rem;
        line-height: 1.5;
    }

    .form-select option {
        font-family: monospace;
    }

    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .text-danger {
        color: #dc3545;
    }
</style>
