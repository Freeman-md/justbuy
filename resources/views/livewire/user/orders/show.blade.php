<div>
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            Order Details - Products
        </x-slot>
        <x-slot name="content">
            <div class="w-full space-y-2 overflow-x-auto">
                <table class="w-full text-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">S / N</th>
                            <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Name</th>
                            <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Quantity</th>
                            <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Price [USD]</th>
                            <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Sub Total [USD]</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->details as $detail)
                            <tr>
                                <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ ++$loop->index }}</td>
                                <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $detail->name }}</td>
                                <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $detail->qty }}</td>
                                <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ number_format(round($detail->price, 2), 2) }}</td>
                                <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $detail->subtotal }}</td>
                            </tr> 
                        @empty
                            <tr class="flex justify-center p-2">
                                <td class="text-sm text-gray-500">No products available</td>
                            </tr>
                        @endforelse                      
                    </tbody>
                </table>
            </div>
        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>

</div>
