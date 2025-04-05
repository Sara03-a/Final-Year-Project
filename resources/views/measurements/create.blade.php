<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Measurement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('measurements.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Room Name -->
                        <div>
                            <x-label for="room_name" value="{{ __('Room Name') }}" />
                            <x-input id="room_name" class="block mt-1 w-full" type="text" name="room_name" :value="old('room_name')" required autofocus />
                            @error('room_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Length -->
                        <div>
                            <x-label for="length" value="{{ __('Length (meters)') }}" />
                            <x-input id="length" class="block mt-1 w-full" type="number" name="length" step="0.01" :value="old('length')" required />
                            @error('length')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Width -->
                        <div>
                            <x-label for="width" value="{{ __('Width (meters)') }}" />
                            <x-input id="width" class="block mt-1 w-full" type="number" name="width" step="0.01" :value="old('width')" required />
                            @error('width')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <x-label for="address_id" value="{{ __('Address') }}" />
                            <select id="address_id" name="address_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Select an address</option>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}" {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                        {{ $address->label }} - {{ $address->street_address }}, {{ $address->city }}
                                    </option>
                                @endforeach
                            </select>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('measurements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                            {{ __('Cancel') }}
                        </a>
                        <x-button>
                            {{ __('Create Measurement') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>