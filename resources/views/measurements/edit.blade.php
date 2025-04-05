<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Measurement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('measurements.update', $measurement) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Room Name -->
                        <div>
                            <x-label for="room_name" value="{{ __('Room Name') }}" />
                            <x-input id="room_name" class="block mt-1 w-full" type="text" name="room_name" :value="old('room_name', $measurement->room_name)" required autofocus />
                            @error('room_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Length -->
                        <div>
                            <x-label for="length" value="{{ __('Length (meters)') }}" />
                            <x-input id="length" class="block mt-1 w-full" type="number" name="length" step="0.01" :value="old('length', $measurement->length)" required />
                            @error('length')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Width -->
                        <div>
                            <x-label for="width" value="{{ __('Width (meters)') }}" />
                            <x-input id="width" class="block mt-1 w-full" type="number" name="width" step="0.01" :value="old('width', $measurement->width)" required />
                            @error('width')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $measurement->address)" required />
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
                            {{ __('Update Measurement') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>