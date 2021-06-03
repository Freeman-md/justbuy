<div class="relative z-0 h-48 text-center transition duration-100 bg-gray-400 cursor-pointer hover:bg-black hover:opacity-70 backdrop-filter hover:brightness-0">
    
    <div>
        {{-- Discount (If Any) --}}
        <div class="absolute flex items-center justify-center text-lg font-semibold text-white rounded-full z-1 w-14 h-14 bg-primary">{{ $product->discount }}%</div>
        {{-- Product Price --}}
        <div class="absolute z-1 p-1.5 text-xs font-semibold text-white bg-primary right-0 top-0">${{ $product->total_price }}</div>
        {{-- Product Image --}}
        <div>
            @if($product->image->medium)
            <img src="{{$product->image->medium}}" alt="{{ $product->name }}" class="w-full h-48">
            @else
                <img src="https://via.placeholder.com" alt="{{ $product->name }}" class="w-full h-48">
            @endif
        </div>
    </div>

    {{-- Product Functionality [Add To Cart, Increase/Decrease Quantity In Cart] --}}
    @if($product->is_in_stock)
        @forelse($cartItems as $item)
            @if(in_array($product->id, $cartIds))
                @if($item['id'] != $product->id)
                    @continue
                @else
                    <div class="absolute flex items-center justify-center z-1 inset-x-1 bottom-1">
                        <button wire:loading.attr="disabled" wire:loading.class="opacity-75" class="px-1.5 mx-1 mt-1 transition duration-100 rounded-full bg-primary hover:bg-black hover:text-white focus:bg-black focus:text-white" wire:click.prevent="updateItem('{{\Hashids::encode($product->id)}}', 'decrease')" wire:loading.class="loading">&minus;</button>
                        <input type="text" class="p-1 input-quantity form-input" readonly value="{{$item['qty']}}">
                        <button wire:loading.attr="disabled" wire:loading.class="opacity-75" @if($item['qty'] >= 10 ||$item['qty'] >= $product->stock->quantity) disabled @endif class="px-1.5 mx-1 mt-1 transition duration-100 rounded-full @if($item['qty'] >= 10 || $item['qty'] >= $product->stock->quantity) disabled @else bg-primary hover:bg-black hover:text-white focus:bg-black focus:text-white @endif" wire:click.prevent="updateItem('{{\Hashids::encode($product->id)}}', 'increase')" wire:loading.class="loading">&plus;</button>
                    </div>
                @endif
            @elseif($item['id'] != $product->id)
                {{-- Add To Cart Button --}}
                <div class="absolute flex items-center justify-center z-1 inset-x-1 bottom-1">
                    <button wire:loading.class="opacity-75" class="shadow-md btn btn-sm btn-primary" wire:click.prevent="addToCart('{{\Hashids::encode($product->id)}}', '{{$product->name}}', {{$product->total_price}})">&plus; Add To Cart</button>
                </div>
            @endif
            @break
        @empty
            {{-- Add To Cart Button --}}
            <div class="absolute flex items-center justify-center inset-x-1 bottom-1">
                <button wire:loading.class="opacity-75" class="shadow-md btn btn-sm btn-primary" wire:click.prevent="addToCart('{{\Hashids::encode($product->id)}}', '{{$product->name}}', {{$product->total_price}})">&plus; Add To Cart</button>
            </div>
        @endforelse
    @else
        {{-- Out Of Stock --}}
        <div class="absolute flex items-center justify-center z-1 inset-x-1 bottom-1">
            <button class="p-1 text-xs text-white bg-black shadow-md cursor-default">Out of Stock</button>
        </div>
    @endif

    {{-- Product Name and Brand Name --}}
    <div class="absolute flex flex-col items-center justify-center m-2 text-transparent transition duration-300 hover:text-gray-500 inset-x-2 inset-y-6 " style="z-index: 0" wire:click.prevent="$emit('viewProduct', {{$product}})">
        <span class="flex flex-col transition duration-100 transform hover:text-white hover:scale-110">
            <span class="font-bold capitalize">{{$product->name}}</span>
            <span class="font-semibold capitalize">Brand: {{$product->brand->name}}</span>
        </span>
    </div>

    {{-- Loader --}}
    {{-- <div class="absolute ml-2 bottom-2 left-2">
        <span wire:loading>
            <span class="spinner"></span>
        </span>
    </div> --}}

</div>