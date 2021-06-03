<div class="relative z-0 py-4 responsive-container">

    <span wire:loading class="pt-3 pl-2">
        <span class="spinner"></span>
    </span>
    <div class="clearfix"></div>

    @if(Cart::count() <= 0)
        <div class="col-span-3">
            <div class="flex flex-col items-center justify-center">
                <span class="fa fa-4x fa-shopping-cart main-color" style="font-size: 100px;"></span>
                <h4 class="mt-2 text-center">No Item In Cart.</h4>
                <div class="mt-2"><a href="{{route('gallery')}}" class="btn btn-sm btn-dark">Back To Gallery</a></div>
            </div>
        </div>
    @else
    
        {{-- Cart Items --}}
        <div class="grid space-y-2 sm:grid-cols-2 sm:gap-6 sm:space-y-0 lg:grid-cols-3 lg:gap-4">
            @foreach(Cart::content() as $item)
                @php
                    $itemModel = $item->model;
                @endphp
                <div class="cursor-pointer">
                    <div class="relative w-full p-3 my-2 border rounded-md shadow @if($itemModel->stock->availability == 'Out Of Stock') opacity-75 @endif">
                        <div class="grid items-center grid-cols-3 gap-4">

                            <div>
                                <div class="w-full py-1">
                                    <img class="object-contain w-full h-20" id="cart-image" alt="{{ucwords($itemModel->name)}}" src="{{$itemModel->image->small}}">
                                </div>
                            </div>

                            <div class="col-span-2 py-1">
                                <h4>{{ucwords($item->name)}}</h4>
                                <h6>Brand: <small class="p-1 font-bold">{{$itemModel->brand->name}}</small></h6>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <b>@if($itemModel->price == $itemModel->total_price) ${{$itemModel->price}} @else <s class="line-through text-secondary">${{$itemModel->price}}</s> ${{$itemModel->total_price}} @endif</b>
                                    </div>
                                    <b>${{$item->subtotal}}</b>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <button class="px-2 py-1" wire:click.prevent="destroy('{{$item->rowId}}')" wire:loading.class="opacity-75" wire:loading.attr="disabled"><span class="fa fa-trash"></span></button>
                            </div>
                            <div>
                                @if(!$itemModel->is_in_stock)
                                    <span class="float-right p-1 m-1 text-sm text-white bg-black cursor-default">Out of Stock</span>
                                @else
                                    {{-- Increase quantity --}}
                                    <button class="float-right px-1.5 mx-1 mt-1 transition duration-100 rounded-full @if(maxQuantity($item->rowId) || $item->qty >= $itemModel->stock->quantity) disabled @else bg-primary hover:bg-black hover:text-white focus:bg-black focus:text-white @endif"  @if(maxQuantity($item->rowId) || $item->qty >= $itemModel->stock->quantity || $itemModel->stock->availability == 'Out of Stock') disabled @endif wire:click.prevent="updateItem('{{$item->rowId}}', 'increase')" wire:loading.class="loading">&plus;</button>
                                    
                                    {{-- Quantity --}}
                                    <input type="text" class="float-right p-1 input-quantity" readonly value="{{$item->qty}}">

                                    {{-- Decrease quantity --}}
                                    <button class="float-right px-1.5 mx-1 mt-1 transition duration-100 rounded-full @if($item->qty <= 1 || $itemModel->stock->availability == 'Out of Stock')disabled @else bg-primary hover:bg-black hover:text-white focus:bg-black focus:text-white @endif" @if($item->qty <= 1 || $itemModel->stock->availability == 'Out of Stock') disabled @endif  wire:click.prevent="updateItem('{{$item->rowId}}', 'decrease')" wire:loading.class="loading">&minus;</button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Order Summary | Price Details | Checkout --}}
        <div class="grid space-y-2 md:grid-cols-2 md:gap-6 md:space-y-0">

            {{-- Order Summary --}}
            <div class="w-full overflow-x-auto">
                <div class="flex items-center justify-between">
                    <span class="font-bold">Order Summary</span>
                    <button class="float-left my-2 shadow-lg btn-sm btn-dark" wire:click.prevent="destroyAll" wire:loading.attr="disabled" wire:loading.class="opacity-75"><span class="fa fa-trash"></span> Clear Cart</button>
                </div>
                <div class="w-full space-y-2 overflow-x-auto">
                    <table class="text-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">S / N</th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Brand</th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Name</th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Price [USD]</th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Quantity</th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Sub Total [USD]</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Cart::content() as $item)
                                <tr class="hover:text-white hover:bg-black">
                                    <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ ++$loop->index }}</td>
                                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $item->model->brand->name }}</td>
                                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $item->name }}</td>
                                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $item->price }}</td>
                                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $item->qty }}</td>
                                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $item->subtotal }}</td>
                                </tr> 
                            @empty
                                <tr class="flex justify-center p-2">
                                    <td class="text-sm text-gray-500">No item in cart</td>
                                </tr>
                            @endforelse                      
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Price Details --}}
            <div class="flex flex-col px-4 mt-2 space-y-2">

                {{-- Sub Total --}}
                <div class="flex items-baseline justify-between text-lg">
                    <span>Subtotal: </span>
                    <span class="font-bold">${{ Cart::subtotal() }}</span>
                </div>

                {{-- Tax --}}
                <div class="flex items-baseline justify-between text-lg">
                    <span>Tax: </span>
                    <span class="font-bold">${{ Cart::tax() }}</span>
                </div>

                {{-- Total Price --}}
                <div class="flex items-baseline justify-between text-lg">
                    <span>Total: </span>
                    <span class="font-bold">${{ Cart::total() }}</span>
                </div>

                <button wire:click.prevent="checkout" class="shadow btn btn-md btn-dark" wire:loading.attr="disabled" wire:loading.class="opacity-75">Checkout</button>

            </div>
            
        </div>

    @endif

</div>