<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="{{ route('carpets.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Browse Carpets') }}
                </a>
                <a href="{{ route('quotes.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Request a Quote') }}
                </a>
            </div>
        </div>
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
                                    <div class="flex flex-col items-end space-y-2">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $quote->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($quote->status) }}
                                        </span>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('quotes.edit', $quote) }}" class="inline-flex items-center px-3 py-1 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                {{ __('Edit') }}
                                            </a>
                                            <form method="POST" action="{{ route('quotes.destroy', $quote) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete this quote?')">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
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
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Recent Measurements') }}</h3>
                    <a href="{{ route('measurements.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Add Measurement') }}
                    </a>
                </div>
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
                                    <div class="flex space-x-2">
                                        <a href="{{ route('measurements.edit', $measurement) }}" class="inline-flex items-center px-3 py-1 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            {{ __('Edit') }}
                                        </a>
                                        <form method="POST" action="{{ route('measurements.destroy', $measurement) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete this measurement?')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
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
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Your Addresses') }}</h3>
                    <a href="{{ route('addresses.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Add Address') }}
                    </a>
                </div>
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
                                    <div class="flex space-x-2">
                                        <a href="{{ route('addresses.edit', $address) }}" class="inline-flex items-center px-3 py-1 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            {{ __('Edit') }}
                                        </a>
                                        <form method="POST" action="{{ route('addresses.destroy', $address) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete this address?')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
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
