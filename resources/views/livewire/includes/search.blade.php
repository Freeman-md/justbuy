<div class="relative z-1">

    {{-- Desktop Search Dropdown --}}
    <div class="relative z-1">
        {{-- Main Search Input --}}
        
            <input wire:model.debounce.500ms="search" type="text" class="w-full px-4 py-1 pl-8 text-sm bg-white rounded-full md:w-56 form-input focus:outline-none focus:border-none focus:ring focus:ring-black focus:ring-opacity-0" placeholder="Search">
            <div class="absolute top-0 ml-1">
                <i class="mt-1.5 ml-1 text-gray-300 fa fa-search"></i>
            </div>
            <span wire:loading class="mb-1 ml-2">
                <span class="spinner"></span>
            </span>
        
        @if(strlen($search) > 0)
    
            <div class="absolute z-50 w-full mt-4 overflow-x-auto text-sm bg-gray-100 rounded shadow-md md:w-56" wire:ignore.self>
                @if($searchResults->count() > 0)
                    <ul>
                        @foreach($searchResults as $result)
                            <li class="border-b border-grey-700">
                                <a wire:click.prevent="$emit('viewProduct', {{$result}})" class="flex items-center px-3 py-3 transition duration-100 cursor-pointer hover:text-white hover:bg-gray-900">
                                    @if($result->image)
                                    <img src="{{$result->image->medium}}" alt="{{ $result->name }}" class="w-8 mr-2">
                                    @else
                                        <img src="https://via.placeholder.com/50x50" alt="{{ $result->name }}" class="w-8 mr-2">
                                    @endif
                                    <div class="flex flex-col items-start justify-start">
                                        <span>{{$result->name}}</span>
                                        <span class="text-xs">
                                            @if($result->price == $result->total_price) ${{$result->price}} @else <s class="line-through text-secondary">${{$result->price}}</s> ${{$result->total_price}} @endif
                                        </span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="px-3 py-3">No Results For {{$search}}</div>
                @endif
            </div>
    
        @endif
    </div>

    
    {{-- Mobile Search Dropdown --}}

</div>