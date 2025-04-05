<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Quote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('admin.quotes') }}" class="text-indigo-600 hover:text-indigo-900">
                        ← Back to Quotes
                    </a>
                </div>

                <form action="{{ route('admin.quotes.update', $quote) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
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

                    <!-- Quote Details -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900">Quote Details</h3>
                        <div class="mt-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Total Price (£)</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">£</span>
                                </div>
                                <input type="number" name="total_price" id="total_price" step="0.01" min="0" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ old('total_price', $quote->price) }}" placeholder="0.00">
                            </div>
                            @error('total_price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Quote Status -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900">Quote Status</h3>
                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1">
                                <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="pending" {{ $quote->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $quote->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $quote->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Carpet Details -->
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
                                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-4">No measurements recorded. Add measurements below:</p>
                                    
                                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                                        <div>
                                            <label for="room_name" class="block text-sm font-medium text-gray-700">Room Name</label>
                                            <input type="text" name="room_name" id="room_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('room_name')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="width" class="block text-sm font-medium text-gray-700">Width (m)</label>
                                            <input type="number" name="width" id="width" step="0.01" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('width')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="length" class="block text-sm font-medium text-gray-700">Length (m)</label>
                                            <input type="number" name="length" id="length" step="0.01" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('length')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="create_measurement" value="1">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="notes" name="notes" rows="4" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('notes', $quote->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.quotes') }}" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Quote
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>