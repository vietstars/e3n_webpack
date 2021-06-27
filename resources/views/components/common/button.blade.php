<a href="{{ $url ?? 'javascript:;' }}" {{ $attributes->merge(['class' => 'btn']) }}>
    {{ $label ?? __('button') }}
</a>