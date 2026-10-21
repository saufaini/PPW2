@php
    $links = [
        ['Home', 'home', 'home'],
        ['Profile', 'profile', 'profile'],
        ['About', 'about', 'about'],
        ['Education', 'education', 'education'],
        ['Posts', 'posts.index', 'posts.*'],
    ];
@endphp

<nav class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-4 py-4">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">Portofolio Saya</a>

        <ul class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm">
            @foreach ($links as [$label, $name, $pattern])
                <li>
                    <a href="{{ route($name) }}"
                       class="{{ request()->routeIs($pattern) ? 'font-semibold text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

