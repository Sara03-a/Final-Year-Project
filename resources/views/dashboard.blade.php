<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Active Quotes Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Active Quotes') }}</h3>
@if(isset($quotes) && $quotes->count() > 0)
                    <div class="space-y-4">
                        @foreach($quotes as $quote)
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold">Quote #{{ $quote->id }}</h4>
                                        <p class="text-sm text-gray-600">Created: {{ $quote->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $quote->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($quote->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">{{ __('No active quotes found.') }}</p>
                @endif
            </div>

            <!-- Recent Measurements Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Recent Measurements') }}</h3>
                @if(isset($measurements) && $measurements->count() > 0)
                    <div class="space-y-4">
               
                        @foreach($measurements as $measurement)
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold">{{ $measurement->room_name }}</h4>
                                        <p class="text-sm text-gray-600">Measured: {{ $measurement->created_at->format('M d, Y') }}</p>
                                        <p class="text-sm text-gray-600">Dimensions: {{ $measurement->width }}m × {{ $measurement->length }}m</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">{{ __('No measurements found.') }}</p>
                @endif
            </div>

            <!-- Addresses Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Your Addresses') }}</h3>
                @if(isset($addresses) && $addresses->count() > 0)
                <div class="space-y-4">
                        @foreach($addresses as $address)
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold">{{ $address->label ?? 'Address' }}</h4>
                                        <p class="text-sm text-gray-600">{{ $address->street_address }}</p>
                                        <p class="text-sm text-gray-600">{{ $address->city }}, {{ $address->postal_code }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">{{ __('No addresses found.') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
