<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('addresses.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-label for="label" value="{{ __('Label') }}" />
                        <x-input id="label" class="block mt-1 w-full" type="text" name="label" :value="old('label')" required autofocus />
                        @error('label')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-label for="street_address" value="{{ __('Street Address') }}" />
                        <x-input id="street_address" class="block mt-1 w-full" type="text" name="street_address" :value="old('street_address')" required />
                        @error('street_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-label for="city" value="{{ __('City') }}" />
                        <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-label for="postal_code" value="{{ __('Postal Code') }}" />
                        <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required />
                        @error('postal_code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Create Address') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>