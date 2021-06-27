<div {{ $attributes->merge(['class' => 'dropdown']) }}>
    <a href="javascript:;" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="nation-flag" src="{{ asset('img/'.$lang.'.svg') }}">
    </a>
    @foreach (config('app.available_locales') as $lg)
        @if ($lg != $lang)
        <div class="dropdown-menu text-right lang-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('change_language', $lg) }}">
                <img class="nation-flag" src="{{ asset('img/'.$lg.'.svg') }}">
            </a>
        </div>
        @endif
    @endforeach
</div>