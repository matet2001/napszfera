@props(['product'])
<nav aria-label="Breadcrumb">
    <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 lg:max-w-7xl mb-5 text-primary">
        <li>
            <div class="flex items-center">
                <a href="{{ route('products.index') }}" class="mr-2 text-sm font-medium hover:text-gray-600">Termékek</a>
                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                </svg>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                @php
                    switch ($product->type) {
                        case 'meditation':
                            $translatedType = 'Meditációk';
                            $routeName = 'products.meditation';
                            break;
                        case 'audiobook':
                            $translatedType = 'Hangoskönyvek';
                            $routeName = 'products.audiobook';
                            break;
                        case 'lecture':
                            $translatedType = 'Előadások';
                            $routeName = 'products.lecture';
                            break;
                        default:
                            $translatedType = $product->type;
                            $routeName = 'products.lecture'; // Default route
                            break;
                    }
                @endphp

                <a href="{{ route($routeName) }}" class="mr-2 text-sm font-medium hover:text-gray-600">{{ $translatedType }}</a>

                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                </svg>
            </div>
        </li>

        <li class="text-sm">
            <p class="font-medium">{{ $product->name }}</p>
        </li>
    </ol>
</nav>
