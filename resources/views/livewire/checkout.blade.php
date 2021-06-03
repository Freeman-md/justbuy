<div class="py-8 responsive-container">

    {{-- Seller - Buyer --}}
    <div class="grid space-y-6 sm:grid-cols-2 sm:gap-6 sm:space-y-0">

        <div>
            <p class="py-2 font-bold border-t border-b">
                {{ __('invoices::invoice.seller') }}
            </p>
            <p class="seller-name">
                <strong>{{env('APP_NAME')}}</strong>
            </p>
            <p class="seller-address">
                {{ __('invoices::invoice.address') }}: {{env('SELLER_ADDRESS')}}
            </p>
            <p class="seller-phone">
                {{ __('invoices::invoice.phone') }}: {{env('SELLER_PHONE')}}
            </p>
        </div>

        <div>
            <p class="py-2 font-bold border-t border-b">
                {{ __('invoices::invoice.buyer') }}
            </p>
            <p class="buyer-name">
                <strong>{{ $address->fullname }}</strong>
            </p>
            <p class="buyer-address">
                {{ __('Country') }}: {{ $address->country }}
            </p>
            <p class="buyer-address">
                {{ __('invoices::invoice.address') }}: {{ $address->address.', '.trim($address->city).', '.trim($address->state).'.' }}
            </p>
            <p class="buyer-phone">
                {{ __('invoices::invoice.phone') }}: {{ $address->phone }}
            </p>
            <p class="buyer-address">
                {{ __('Postcode') }}: {{ $address->postcode }}
            </p>
        </div>

    </div>

    <div class="w-full my-2 overflow-x-auto">
        <table class="w-full text-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Name</th>
                    <th class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Quantity</th>
                    <th class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Price</th>
                    <th class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Discount</th>
                    <th class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Tax</th>
                    <th class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse(Cart::content() as $item)
                    @if($itemModel = $item->model) @endif
                    <tr>
                        <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{$itemModel->name}}</td>
                        <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{$item->qty}}</td>
                        <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{number_format(round($itemModel->price, 2), 2)}} <strong>$</strong></td>
                        <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{$itemModel->discount}} <strong>$</strong></td>
                        <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{$item->tax}} <strong>$</strong></td>
                        <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{$item->subtotal}} <strong>$</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No Item In Cart.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(Cart::count())
        <div class="flex justify-start">
            <div>
                <div class="flex justify-between space-x-6"> 
                    <span class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Sub Total: </span>
                    <span class="px-6 py-3 text-xs font-bold text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{Cart::subtotal()}} <strong>$</strong></span>
                </div>
                <div class="flex justify-between space-x-6"> 
                    <span class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Tax: </span>
                    <span class="px-6 py-3 text-xs font-bold text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{Cart::tax()}} <strong>$</strong></span>
                </div>
                <div class="flex justify-between space-x-6"> 
                    <span class="px-6 py-3 text-sm font-semibold text-left uppercase align-middle bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Total: </span>
                    <span class="px-6 py-3 text-xs font-bold text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{Cart::total()}} $</span>
                </div>
            </div>
        </div>
    @endif

</div>
