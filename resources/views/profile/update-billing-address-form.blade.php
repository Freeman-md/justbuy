<x-jet-form-section submit="updateAddressInformation">
    <x-slot name="title">
        {{ __('Billing Address Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s billing address information.') }}
    </x-slot>

    <x-slot name="form">
        
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fullname" value="{{ __('Fullname') }}" />
            <x-jet-input type="text" id="fullname" wire:model="address.fullname" value="{{$address->fullname ?? old('address.fullname')}}" class="block w-full mt-1" />
            <x-jet-input-error for="address.fullname" class="mt-2"/>
        </div>
        
        <div class="col-span-6 sm:col-span-4" x-data="{countries: null}" x-init="
                            fetch('https://restcountries.eu/rest/v2/all')
                            .then((response) => response.json())
                            .then((data) => countries=data)
                            .catch((err) => toastr.error('An error has occurred.'))
                        ">
            <x-jet-label for="country" value="{{ __('Country') }}"/>
            <select wire:model="address.country" id="country" class="block w-full mt-1 form-box">
                @if($address['country'])
                    <option value="{{$address['country']}}">{{$address['country']}}</option>
                @else
                    <option disabled selected value="">Select your country</option>
                @endif
                <template x-if="countries" x-for="country in countries" x-bind:key="country.alpha2Code">
                    <option x-bind:value="country.name"  x-text="country.name"></option>
                </template>
            </select>
            <x-jet-input-error for="address.country" class="mt-2"/>
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('Address') }}" />
            <x-jet-input type="text" id="address" wire:model="address.address" value="{{$address->address ?? old('address.address')}}" class="block w-full mt-1" />
            <x-jet-input-error for="address.address" class="mt-2"/>
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="state" value="{{ __('State / County') }}" />
            <x-jet-input type="text" id="state" wire:model="address.state" value="{{$address->state ?? old('address.state')}}" class="block w-full mt-1" />
            <x-jet-input-error for="address.state" class="mt-2"/>
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="city" value="{{ __('Town / City') }}" />
            <x-jet-input type="text" id="city" wire:model="address.city" value="{{$address->city ?? old('address.city')}}" class="block w-full mt-1" />
            <x-jet-input-error for="address.city" class="mt-2"/>
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('Phone Number') }}" />
            <x-jet-input type="text" id="phone" wire:model="address.phone" value="{{$address->phone ?? old('address.phone')}}" class="block w-full mt-1" />
            <x-jet-input-error for="address.phone" class="mt-2"/>
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="postcode" value="{{ __('Postcode') }}" />
            <x-jet-input type="text" id="postcode" wire:model="address.postcode" value="{{$address->postcode ?? old('address.postcode')}}" class="block w-full mt-1" />
            <x-jet-input-error for="address.postcode" class="mt-2"/>
        </div>
        
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="billingAddressUpdated">
                {{ __('Saved.') }}
            </x-jet-action-message>
    
            <x-jet-button wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-slot>
</x-jet-form-section>
