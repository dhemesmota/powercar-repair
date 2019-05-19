
@if($items)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end mb-5">
            @foreach ($items as $key => $value)
                @if ($value->url)
                    <li class="breadcrumb-item"><a class="link" href="{{ $value->url }}">{{ $value->title }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $value->title }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif