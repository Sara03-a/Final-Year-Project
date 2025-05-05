<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quote Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quote #{{ $quote->id }}</h3>
                <div class="mb-4">
                    <span class="px-2 py-1 text-xs rounded-full {{ $quote->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($quote->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                        {{ ucfirst($quote->status) }}
                    </span>
                </div>
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Created: {{ $quote->created_at->format('M d, Y') }}</p>
                    @if($quote->measurement)
                        <p class="text-sm text-gray-600 mt-2">
                            Room: {{ $quote->measurement->room_name }}<br>
                            Size: {{ $quote->measurement->width }}m × {{ $quote->measurement->length }}m
                        </p>
                    @endif
                    @if($quote->carpet)
                        <p class="text-sm text-gray-600 mt-2">
                            Carpet: {{ $quote->carpet->name }}<br>
                            Price: £{{ number_format($quote->carpet->price_per_sq_meter, 2) }}/m²
                        </p>
                    @elseif($quote->custom_carpet_description)
                        <p class="text-sm text-gray-600 mt-2">
                            Carpet: {{ $quote->custom_carpet_description }}
                        </p>
                    @endif
                    @if($quote->notes)
                        <p class="text-sm text-gray-600 mt-2">
                            Notes: {{ $quote->notes }}
                        </p>
                    @endif
                </div>
                <div class="mb-4">
                    <h4 class="font-semibold">Total Price</h4>
                    <p class="text-lg text-gray-900 font-bold">£{{ number_format($quote->price, 2) }}</p>
                </div>
                @if($quote->status === 'approved')
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Payment Options</h4>
                        <div class="flex items-center space-x-4">
                            <form method="POST" action="{{ route('payment.handle', $quote->id) }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Pay Now
                                </button>
                            </form>
                            <p class="text-sm text-gray-600">You may also pay with cash at our store.</p>
                        </div>
                    </div>
                @endif
                <div class="mt-6">
                    <a href="{{ route('quotes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                        Back to Quotes
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>