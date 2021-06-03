<div>
    @if($product != null)
        <x-jet-dialog-modal wire:model="modal">
            <x-slot name="title">
                {{$product['name']}} 
            </x-slot>

            <x-slot name="content">
                <div class="grid space-y-2 md:grid-cols-2 md:gap-4 md:space-y-0">
                    
                    <div class="w-full h-68">
                        <img src="{{$product['image']['medium']}}" alt="{{$product['name']}}" class="object-contain">
                    </div>

                    <div class="flex flex-col space-y-1">
                        
                        <div class="flex flex-wrap items-center space-x-2">
                            <span class="font-bold">Brand: </span>
                            <x-badge color="gray" :text="$product['brand']['name']"/>
                            <span wire:loading class="pl-2">
                                <span class="spinner"></span>
                            </span>
                        </div>

                        <div>
                            <x-badge color="gray" :text="$product['stock']['availability']"/>
                        </div>

                        <div>
                            {{$product['description']}}
                        </div>

                        <div>
                            @if($product['price'] == $product['total_price']) ${{$product['price']}} @else <s class="line-through text-secondary">${{$product['price']}}</s> ${{$product['total_price']}} @endif
                        </div>

                        {{-- Product Functionality [Add To Cart, Increase/Decrease Quantity In Cart] --}}
                        @if($product['stock']['availability'] == 'In Stock')
                            @forelse($cartItems as $item)
                                @if(in_array($product['id'], $cartIds))
                                    @if($item['id'] != $product['id'])
                                        @continue
                                    @else
                                        <div>
                                            <button wire:loading.attr="disabled" wire:loading.class="opacity-75" class="px-1.5 mx-1 mt-1 transition duration-100 rounded-full bg-primary hover:bg-black hover:text-white focus:bg-black focus:text-white" wire:click.prevent="updateItem('{{\Hashids::encode($product['id'])}}', 'decrease')" wire:loading.class="loading">&minus;</button>
                                            <input type="text" class="p-1 input-quantity form-input" readonly value="{{$item['qty']}}">
                                            <button wire:loading.attr="disabled" wire:loading.class="opacity-75" @if($item['qty'] >= 10 ||$item['qty'] >= $product['stock']['quantity']) disabled @endif class="px-1.5 mx-1 mt-1 transition duration-100 rounded-full @if($item['qty'] >= 10 || $item['qty'] >= $product['stock']['quantity']) disabled @else bg-primary hover:bg-black hover:text-white focus:bg-black focus:text-white @endif" wire:click.prevent="updateItem('{{\Hashids::encode($product['id'])}}', 'increase')" wire:loading.class="loading">&plus;</button>
                                        </div>
                                    @endif
                                @elseif($item['id'] != $product['id'])
                                    {{-- Add To Cart Button --}}
                                    <div>
                                        <button wire:loading.class="opacity-75" class="shadow-md btn btn-sm btn-primary" wire:click.prevent="addToCart('{{\Hashids::encode($product['id'])}}', '{{$product['name']}}', {{$product['total_price']}})">&plus; Add To Cart</button>
                                    </div>
                                @endif
                                @break
                            @empty
                                {{-- Add To Cart Button --}}
                                <div>
                                    <button wire:loading.class="opacity-75" class="shadow-md btn btn-sm btn-primary" wire:click.prevent="addToCart('{{\Hashids::encode($product['id'])}}', '{{$product['name']}}', {{$product['total_price']}})">&plus; Add To Cart</button>
                                </div>
                            @endforelse
                        @else
                            {{-- Out Of Stock --}}
                            <div>
                                <button class="p-1 text-xs text-white bg-black shadow-md cursor-default">Out of Stock</button>
                            </div>
                        @endif

                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>