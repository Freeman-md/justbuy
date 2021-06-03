<x-jet-form-section submit="updateCreditCardInformation">
    <x-slot name="title">
        {{ __('Credit Card Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s credit card information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Digits -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="digits" value="{{ __('Card Digits') }}" />
            <x-jet-input id="digits" type="text" class="block w-full mt-1" wire:model.defer="creditCard.digits" autocomplete="digits" placeholder="**** - **** - **** - ****"/>
            <x-jet-input-error for="creditCard.digits" class="mt-2" />
        </div>

        <!-- Expiry Date -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="expiryDate" value="{{ __('Expiry Date') }}" />
            <x-jet-input id="expiryDate" type="text" class="block w-full mt-1" wire:model.defer="creditCard.expiryDate" autocomplete="expiryDate" placeholder="09 / 22" />
            <x-jet-input-error for="creditCard.expiryDate" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="authorizationCode" value="{{ __('Authorization Code') }}" />
            <x-jet-input maxlength="3" id="authorizationCode" type="text" class="block w-full mt-1 italic" wire:model.defer="creditCard.authorizationCode" placeholder="123" />
            <x-jet-input-error for="creditCard.authorizationCode" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="creditCardInformationUpdated">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
