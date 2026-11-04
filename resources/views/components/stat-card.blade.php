@props(['label', 'value', 'color' => 'text-indigo-600'])

<div class="card p-4">
    <p class="text-xs text-slate-400">{{ $label }}</p>
    <p class="text-2xl font-bold {{ $color }}">{{ $value }}</p>
</div>