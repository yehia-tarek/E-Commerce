<form {{ $attributes->merge(['class' => 'needs-validation', 'novalidate' => true]) }}>
    {{ $slot }}
</form>
