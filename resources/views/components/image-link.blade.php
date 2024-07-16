@props(['href', 'src', 'alt' => '', 'size' => '40'])

<a href="{{ $href }}" target=”_blank”>
    <img src="{{ $src }}" alt=" {{ $alt }}" width="{{ $size }}" height="{{ $size }}">
</a>
