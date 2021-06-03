<div>
    @livewire('user.includes.navigation')

    {{-- User Orders --}}
    <div class="w-full py-8 space-y-2 overflow-x-auto responsive-container">
        <table class="w-full text-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">S / N</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Amount</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Tax</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Total Amount</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Status</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Created At</th>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ ++$loop->index }}</td>
                        <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $order->amount }}</td>
                        <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $order->tax }}</td>
                        <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $order->total_amount }}</td>
                        <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                            @if($order->status == 'Cancelled')
                                <x-badge color="red" :text="$order['status']"/>
                            @elseif($order->status == 'Transit')
                                <x-badge color="indigo" :text="$order['status']" />
                            @elseif($order->status == 'Confirmed')
                                <x-badge color="blue" :text="$order['status']" />
                            @elseif($order->status == 'Delivered')
                                <x-badge color="green" :text="$order['status']" />
                            @endif
                        </td>
                        <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">{{ $order->created_at }}</td>
                        <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                            @if(in_array($order->status, ['Transit', 'Confirmed', 'Delivered']))
                                <button class="px-2 py-1 text-xs text-white transition duration-100 bg-red-500 rounded-xl hover:bg-red-600" wire:click.prevent="cancel('{{\Hashids::encode($order->id)}}')">Cancel</button>
                            @endif
                        {{-- <a class="px-2 py-1 text-xs text-white transition duration-100 bg-green-500 cursor-pointer rounded-xl hover:bg-green-600" wire:click.prevent="$emit('viewOrder', {{ $order }})">Details</button> --}}
                        </td>
                    </tr> 
                @empty
                    <tr class="flex justify-center p-2">
                        <td class="text-sm text-gray-500">No orders available</td>
                    </tr>
                @endforelse                      
            </tbody>
        </table>
    </div>

    {{-- @livewire('user.orders.show') --}}

</div>
