<div>
    {{-- Desktop Notifications --}}
    <div class="relative ml-3 ">
        <x-jet-dropdown align="right" width="80">
            <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50" wire:click.prevent="markAllAsRead">
                        
                        
                        <span class="text-base tracking-tighter text-gray-500">
                            @if($unreadNotifications->count())
                                <x-svg.bell class="h-5 -mr-1 align-text-top origin-top animate-swing"/>
                                <sup class="text-lg text-primary">&bull;</sup>
                            @else
                                <x-svg.bell class="h-5 -mr-1 align-text-top origin-top"/>
                            @endif
                        </span>
    
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            </x-slot>
    
            <x-slot name="content">
                <div class="w-80">
                    <!--  Notificiations -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Notifications') }}
                    </div>
    
                    <div class="overflow-auto max-h-56">
                        @foreach ($notifications as $notification)
                            {{-- Notification --}}
                            <div class="flex items-center justify-between py-2 pl-3 pr-4 text-xs font-medium text-gray-600 transition border-b anitialised">
                                <div class="flex flex-col items-start px-1 space-y-1.5">
                                    <x-admin.notification :notification="$notification" />
                                    <span class="font-medium text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                @if(is_null($notification->read_at))
                                    <i class="text-xl font-extrabold text-blue-500 transition duration-300 shadow-lg">&bull;</i>
                                @endif
                            </div>
                            @if(!$loop->last)
                                <div class="border-t border-gray-100"></div>
                            @endif
                        @endforeach
                    </div>
                    @if($notifications->count() <= 0)
                        <div class="block px-4 py-1 text-xs font-semibold text-gray-400">
                            <span>No Notifications Available</span>
                        </div>
                    @endif
                    
                </div>
            </x-slot>
        </x-jet-dropdown>
    </div>
    
</div>