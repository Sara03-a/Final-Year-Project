<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Quote Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('quotes.update', $quote) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-label for="address_id" value="{{ __('Select Address') }}" />
                        <select name="address_id" id="address_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{ $quote->address_id == $address->id ? 'selected' : '' }}>
                                    {{ $address->street }}, {{ $address->city }}, {{ $address->postcode }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="address_id" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="measurement_id" value="{{ __('Select Room Measurement (Optional)') }}" />
                        <select name="measurement_id" id="measurement_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">{{ __('No measurement needed') }}</option>
                            @foreach($measurements as $measurement)
                                <option value="{{ $measurement->id }}" {{ $quote->measurement_id == $measurement->id ? 'selected' : '' }}>
                                    {{ $measurement->room_name }} ({{ $measurement->width }}m × {{ $measurement->length }}m)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="measurement_id" class="mt-2" />
                    </div>

                    <div>
                        <x-label value="{{ __('Carpet Type') }}" />
                        <div class="mt-2 space-y-4">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="carpet_type" value="existing" class="form-radio" {{ $quote->carpet_id ? 'checked' : '' }}>
                                    <span class="ml-2">{{ __('Choose from existing carpets') }}</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="carpet_type" value="custom" class="form-radio" {{ !$quote->carpet_id ? 'checked' : '' }}>
                                    <span class="ml-2">{{ __('Custom carpet request') }}</span>
                                </label>
                            </div>
                        </div>
                        <x-input-error for="carpet_type" class="mt-2" />
                    </div>

                    <div id="existing-carpet-section" class="{{ $quote->carpet_id ? '' : 'hidden' }}">
                        <x-label for="carpet_id" value="{{ __('Select Carpet') }}" />
                        <select name="carpet_id" id="carpet_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($carpets as $carpet)
                                <option value="{{ $carpet->id }}" {{ $quote->carpet_id == $carpet->id ? 'selected' : '' }}>
                                    {{ $carpet->name }} - £{{ number_format($carpet->price_per_sq_meter, 2) }}/m²
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="carpet_id" class="mt-2" />
                    </div>

                    <div id="custom-carpet-section" class="{{ !$quote->carpet_id ? '' : 'hidden' }}">
                        <x-label for="custom_carpet_description" value="{{ __('Custom Carpet Description') }}" />
                        <textarea name="custom_carpet_description" id="custom_carpet_description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('custom_carpet_description', $quote->custom_carpet_description) }}</textarea>
                        <x-input-error for="custom_carpet_description" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="notes" value="{{ __('Additional Notes') }}" />
                        <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $quote->notes) }}</textarea>
                        <x-input-error for="notes" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('quotes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cancel') }}
                        </a>
                        <x-button class="ml-4">
                            {{ __('Update Quote') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carpetTypeRadios = document.querySelectorAll('input[name="carpet_type"]');
            const existingCarpetSection = document.getElementById('existing-carpet-section');
            const customCarpetSection = document.getElementById('custom-carpet-section');

            function toggleCarpetSections() {
                const selectedType = document.querySelector('input[name="carpet_type"]:checked').value;
                existingCarpetSection.classList.toggle('hidden', selectedType !== 'existing');
                customCarpetSection.classList.toggle('hidden', selectedType !== 'custom');
            }

            carpetTypeRadios.forEach(radio => {
                radio.addEventListener('change', toggleCarpetSections);
            });
        });
    </script>
    @endpush
</x-app-layout>