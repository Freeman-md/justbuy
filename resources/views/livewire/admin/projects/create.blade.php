<div>
    @include('livewire.admin.includes.navigation')
    <div class="my-6 responsive-container">
        <x-jet-form-section submit="create">
            <x-slot name="title">
                {{ __('Profile Information') }}
            </x-slot>
        
            <x-slot name="description">
                {{ __('Update your account\'s profile information and other necessary profile details.') }}
            </x-slot>
        
            <x-slot name="form">
        
                <!-- Title -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" type="text" class="block w-full mt-1" wire:model.defer="state.title" autocomplete="title" />
                    <x-jet-input-error for="state.title" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea id="description" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.defer="state.description" autocomplete="title"></textarea>
                    <x-jet-input-error for="state.description" class="mt-2" />
                </div>
        
                <!-- Github -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="github" value="{{ __('Github URL') }}" />
                    <x-jet-input id="github" type="text" class="block w-full mt-1" wire:model.defer="state.github" autocomplete="github" />
                    <x-jet-input-error for="state.github" class="mt-2" />
                </div>
        
                <!-- Live -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="live" value="{{ __('Live URL') }}" />
                    <x-jet-input id="live" type="text" class="block w-full mt-1" wire:model.defer="state.live" autocomplete="live" />
                    <x-jet-input-error for="state.live" class="mt-2" />
                </div>
        
                <!-- Starred -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="star" value="{{ __('Star') }}" />
                    <input type="checkbox" wire:model="state.star"/>
                    {{-- <x-jet-input-error for="state.star" class="mt-2" /> --}}
                </div>
        
                <!-- Stacks -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="stacks" value="{{ __('Stacks') }}" />
                    <x-jet-input id="stacks" type="text" class="block w-full mt-1" wire:model.defer="state.stacks" autocomplete="stacks" />
                    <x-jet-input-error for="state.stacks" class="mt-2" />
                </div>
        
            </x-slot>
        
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="created">
                    {{ __('Created.') }}
                </x-jet-action-message>
        
                <x-jet-button wire:loading.attr="disabled" wire:target="create">
                    {{ __('Create') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
        
    </div>
</div>