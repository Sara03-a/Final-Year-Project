<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quote Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-900">
                        ← Back to Dashboard
                    </a>
                </div>

                <!-- Quote Status -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900">Quote Status</h3>
                    <div class="mt-4">
                        <div class="mt-1 text-sm text-gray-900">
                            @switch($quote->status)
                                @case('approval_required')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Approval Required</span>
                                    @break
                                @case('payment_received')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Payment Received</span>
                                    @break
                                @case('approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>

                <!-- Total Price -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900">Total Price</h3>
                    <div class="mt-4">
                        <div class="mt-1 text-sm text-gray-900">
                            @if($quote->price)
                                <p class="font-semibold">Total: £{{ number_format($quote->price, 2) }}</p>
                            @else
                                <p class="text-gray-500">No price set</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900">Customer Information</h3>
                    <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $quote->user->name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $quote->user->email }}</div>
                        </div>
                    </div>
                </div>


                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900">Carpet Details</h3>
                    <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                        @if($quote->carpet)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Carpet Type</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $quote->carpet->name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price per m²</label>
                            <div class="mt-1 text-sm text-gray-900">£{{ number_format($quote->carpet->price_per_sq_meter, 2) }}</div>
                        </div>
                        @else
                        <div class="col-span-2">
                            <p class="text-sm text-gray-500">No carpet selected</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Measurements -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900">Measurements</h3>
                    <div class="mt-4">
                        @if($quote->measurement)
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Room Name</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $quote->measurement->room_name }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Width (m)</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $quote->measurement->width }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Length (m)</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $quote->measurement->length }}</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No measurements recorded</p>
                        @endif
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900">Delivery Address</h3>
                    <div class="mt-4">
                        @if($quote->address)
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                                <div class="text-sm text-gray-900">
                                    {{ implode(', ', array_filter([
                                        $quote->address->street_address,
                                        $quote->address->city,
                                        $quote->address->postal_code,
                                    ])) }}
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No delivery address specified</p>
                        @endif
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Notes</h3>
                    <div class="mt-4">
                        <div class="text-sm text-gray-900">
                            {{ $quote->notes ?: 'No notes available' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>