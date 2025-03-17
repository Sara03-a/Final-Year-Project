<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="mb-4">
        <input wire:model.debounce.300ms="search" type="text" placeholder="Search by name or address..." 
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
                <tr class="text-left">
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Name</th>
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Address</th>
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Quotes</th>
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Measurements</th>
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $customer->name }}</td>
                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                            @foreach($customer->addresses as $address)
                                <div class="mb-1">
                                    <span class="font-semibold">{{ $address->label }}:</span>
                                    {{ $address->street_address }}, {{ $address->city }}, {{ $address->postal_code }}
                                </div>
                            @endforeach
                        </td>
                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                            @foreach($customer->quotes as $quote)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                    {{ $quote->status }}
                                </span>
                            @endforeach
                        </td>
                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                            @foreach($customer->measurements as $measurement)
                                <div class="mb-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2">
                                        {{ $measurement->room_name }} ({{ $measurement->width }}m × {{ $measurement->length }}m)
                                    </span>
                                </div>
                            @endforeach
                        </td>
                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $customer->id }})" class="text-blue-600 hover:text-blue-900">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $customer->id }})" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this customer?')">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border-dashed border-t border-gray-200 px-6 py-4 text-center text-gray-500">
                            No customers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>