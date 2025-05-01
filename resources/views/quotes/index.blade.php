<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Quotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($quotes->count() > 0)
                    <div class="space-y-4">
                        @foreach($quotes as $quote)
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold">Quote #{{ $quote->id }}</h4>
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
                                        @endif
                                        @if($quote->notes)
                                            <p class="text-sm text-gray-600 mt-2">
                                                Notes: {{ $quote->notes }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $quote->status === 'approval_required' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $quote->status === 'approval_required' ? 'Approval Required' : ucfirst($quote->status) }}
                                        </span>
                                        @if($quote->status === 'approved')
                                        <a href="{{ route('quotes.show', $quote) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-2">
                                            {{ __('View Quote') }}
                                        </a>
                                        @endif
                                        <div class="flex space-x-2">
                                            @if($quote->status !== 'approved')
                                                <a href="{{ route('quotes.edit', $quote) }}" class="inline-flex items-center px-2 py-1 bg-blue-100 border border-transparent rounded-md font-semibold text-xs text-blue-800 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('quotes.destroy', $quote) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this quote?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-100 border border-transparent rounded-md font-semibold text-xs text-red-800 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">{{ __('No quotes found.') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>