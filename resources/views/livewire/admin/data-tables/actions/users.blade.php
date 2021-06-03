<div class="flex justify-around space-x-1">
    @if($role == 'Admin')
        <button wire:click.prevent="user('{{ \Hashids::encode($id) }}')" class="p-1 text-pink-600 rounded hover:bg-pink-600 hover:text-white">
            <i class="fas fa-user-alt"></i>
        </button>
    @else
        <button wire:click.prevent="admin('{{ \Hashids::encode($id) }}')" class="p-1 text-yellow-600 rounded hover:bg-yellow-600 hover:text-white">
            <i class="fas fa-user-tie"></i>
        </button>
    @endif

    @if($verified != null)
        <button wire:click.prevent="disable('{{ \Hashids::encode($id) }}')" class="p-1 text-gray-600 rounded hover:bg-gray-600 hover:text-white">
            <i class="fas fa-user-times"></i>
        </button>
    @else
        <button wire:click.prevent="verify('{{ \Hashids::encode($id) }}')" class="p-1 text-green-600 rounded hover:bg-green-600 hover:text-white">
            <i class="fas fa-user-clock"></i>
        </button>
    @endif
</div>