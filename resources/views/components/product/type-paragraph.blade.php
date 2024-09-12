@props(['product'])
@php
    switch ($product->type) {
        case 'meditation':
        $translatedType = 'Meditációk';
        break;
    case 'audiobook':
        $translatedType = 'Hangoskönyvek';
        break;
    case 'lecture':
        $translatedType = 'Előadások';
        break;
    default:
        $translatedType = $product->type;
        break;
    }
@endphp
<p class="text-gray-400 text-sm">{{ $translatedType }}</p>
