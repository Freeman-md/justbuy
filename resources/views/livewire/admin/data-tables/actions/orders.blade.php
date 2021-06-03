<div class="flex justify-around space-x-1">
    @if(!in_array($status, ['Confirmed', 'Delivered']))
        <button wire:click.prevent="confirm('{{ \Hashids::encode($id) }}')" class="p-1 text-blue-600 rounded hover:bg-blue-600 hover:text-white">
            <i class="fas fa-check"></i>
        </button>
    @endif
    @if($status != 'Delivered')
        <button wire:click.prevent="deliver('{{ \Hashids::encode($id) }}')" class="p-1 text-green-600 rounded hover:bg-green-600 hover:text-white">
            <i class="fas fa-shipping-fast"></i>
        </button>
    @endif
</div>