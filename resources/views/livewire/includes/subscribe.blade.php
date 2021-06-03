<div class="w-full">
    
    {{-- Subscription Form --}}
    <form wire:submit.prevent="subscribe" class="relative">
        <div class="absolute top-0 right-0 ml-1">
            <i wire:click.prevent="subscribe" class="mt-3.5 mr-4 text-gray-500 transition duration-100 transform cursor-pointer hover:text-gray-900 hover:translate-x-1 fa fa-chevron-right"></i>
        </div>
        <input type="text" class="w-full p-2 text-black border border-black rounded-md focus:border-none focus:ring focus:ring-black focus:ring-opacity-50 focus:outline-none" wire:model.debounce.500ms="subscriber.email" placeholder="Email Address"/>
        <x-jet-input-error class="mt-2 text-white" for="subscriber.email"/>

        <x-jet-action-message class="mt-2 ml-3 text-white" on="subscribed">
            {{ __('Subscribed.') }}
        </x-jet-action-message>
        
    </form>

</div>
