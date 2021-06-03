<div>

    <h1 class="text-2xl">Tell us about your experience with <span class="font-bold">Xclusive Designs</span></h1>

    <form wire:submit.prevent="sendFeedback" novalidate>
    
        <div class="grid mt-4 space-y-2 md:grid-cols-2 md:gap-6 md:space-y-0">
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block w-full mt-1" type="text" wire:model.debounce.500ms="feedback.name"/>
                <x-jet-input-error for="feedback.name" class="mt-2" />
            </div>
        
            <div>
                <x-jet-label for="email" value="{{ __('Email ID') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" wire:model.debounce.500ms="feedback.email" />
                <x-jet-input-error for="feedback.email" class="mt-2" />
            </div>
        </div>
    
        <div class="mt-4">
            <x-jet-label for="subject" value="{{ __('Subject') }}" />
            <x-jet-input id="subject" class="block w-full mt-1" type="text" wire:model.debounce.500ms="feedback.subject"/>
            <x-jet-input-error for="feedback.subject" class="mt-2" />
        </div>
    
        <div class="mt-4">
            <x-jet-label for="message" value="{{ __('Message') }}" />
            <textarea id="message" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.debounce.500ms="feedback.message"></textarea>
            <x-jet-input-error for="feedback.message" class="mt-2" />
        </div>
    
        <div class="flex items-center justify-start mt-4">
            
            <x-jet-button>
                {{ __('Send Feedback') }}
            </x-jet-button>
            <x-jet-action-message class="ml-3" on="sent">
                {{ __('Feedback sent.') }}
            </x-jet-action-message>
        </div>
    </form>

    
</div>