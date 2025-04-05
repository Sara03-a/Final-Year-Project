<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request a Quote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('quotes.store') }}" class="space-y-6">
                    @csrf

                    <!-- Address Selection -->
                    <div>
                        <x-label for="address_id" value="{{ __('Select Address') }}" />
                        <select name="address_id" id="address_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}">
                                    {{ $address->label }} - {{ $address->street_address }}, {{ $address->city }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="address_id" class="mt-2" />
                    </div>

                    <!-- Optional Measurement Selection -->
                    <div>
                        <x-label for="measurement_id" value="{{ __('Room Measurement (Optional)') }}" />
                        <select name="measurement_id" id="measurement_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">{{ __('Select a measurement') }}</option>
                            @foreach($measurements as $measurement)
                                <option value="{{ $measurement->id }}">
                                    {{ $measurement->room_name }} ({{ $measurement->width }}m × {{ $measurement->length }}m)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="measurement_id" class="mt-2" />
                    </div>

                    <!-- Carpet Selection -->
                    <div x-data="{ showCustomDescription: false }">
                        <x-label value="{{ __('Carpet Selection') }}" />
                        
                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="carpet_type" value="existing" class="form-radio" x-on:change="showCustomDescription = false" checked>
                                <span class="ml-2">{{ __('Choose from existing carpets') }}</span>
                            </label>

                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="carpet_type" value="custom" class="form-radio" x-on:change="showCustomDescription = true">
                                <span class="ml-2">{{ __('Describe custom carpet') }}</span>
                            </label>
                        </div>

                        <div x-show="!showCustomDescription" class="mt-4">
                            <select name="carpet_id" id="carpet_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">{{ __('Select a carpet') }}</option>
                                @foreach($carpets as $carpet)
                                    <option value="{{ $carpet->id }}">
                                        {{ $carpet->name }} - £{{ number_format($carpet->price_per_sq_meter, 2) }}/m²
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div x-show="showCustomDescription" class="mt-4">
                            <x-label for="custom_carpet_description" value="{{ __('Custom Carpet Description') }}" class="mb-2" />
                            <textarea id="custom_carpet_description" name="custom_carpet_description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="{{ __('Please describe your desired carpet including details like material, color, pattern, and any specific requirements...') }}"></textarea>
                        </div>
                    </div>

                    <!-- Notes Field -->
                    <div class="mt-4">
                        <x-label for="notes" value="{{ __('Additional Notes') }}" />
                        <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="{{ __('Any additional information about your quote request...') }}"></textarea>
                        <x-input-error for="notes" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Submit Quote Request') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>