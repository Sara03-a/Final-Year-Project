<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('addresses.update', $address) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-label for="label" value="{{ __('Label') }}" />
                        <x-input id="label" class="block mt-1 w-full" type="text" name="label" :value="old('label', $address->label)" required autofocus />
                        <x-input-error for="label" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="street_address" value="{{ __('Street Address') }}" />
                        <x-input id="street_address" class="block mt-1 w-full" type="text" name="street_address" :value="old('street_address', $address->street_address)" required />
                        <x-input-error for="street_address" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="city" value="{{ __('City') }}" />
                        <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $address->city)" required />
                        <x-input-error for="city" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="postal_code" value="{{ __('Postal Code') }}" />
                        <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code', $address->postal_code)" required />
                        <x-input-error for="postal_code" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>