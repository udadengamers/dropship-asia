<style>
    .text-underline-hover {
        text-decoration: none;
        color: #dc3545;
    }

    .text-underline-hover:hover {
        text-decoration: none;
        color: rgb(0, 0, 0);
    }
</style>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @php 
            $old = $paths;
        @endphp
        @foreach ($paths as $key => $path)
            @php
                unset($paths[$key]);
                $url = implode('/', array_diff($old, $paths));
            @endphp
            @if ($loop->first)
                @php
                    $first = $path;
                @endphp
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    <a class="text-underline-hover" href="{{ url($path) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                        </svg>
                    </a>
                </li>
            @else
                @if ($loop->last)
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                        {{ ucwords(str_replace('-', ' ', $path)) }}
                    </li>
                @else
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                        <a class="text-underline-hover" href="{{ url($url) }}">
                            {{ ucwords(str_replace('-', ' ', $path)) }}
                        </a>
                    </li>
                @endif
            @endif
            @php
                $previous = $path;
            @endphp
        @endforeach
    </ol>
</nav>
