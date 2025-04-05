<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Carpets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($carpets->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($carpets as $carpet)
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <img src="{{ asset($carpet->image) }}" alt="{{ $carpet->name }}" class="w-full h-48 object-cover mb-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $carpet->name }}</h3>
                                <p class="text-sm text-gray-600 mt-2">{{ $carpet->description }}</p>
                                <p class="text-sm font-semibold text-gray-900 mt-2">£{{ number_format($carpet->price_per_sq_meter, 2) }}/m²</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">{{ __('No carpets available at the moment.') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>