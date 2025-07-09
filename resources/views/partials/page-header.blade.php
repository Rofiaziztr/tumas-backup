<div class="page-header mb-4 {{ $centered ?? false ? 'text-center' : '' }}">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">{{ $title }}</h1>
            @if (isset($subtitle))
                <p class="page-subtitle">{{ $subtitle }}</p>
            @endif
        </div>
        @if (isset($actions))
            <div>
                {!! $actions !!}
            </div>
        @endif
    </div>
</div>
