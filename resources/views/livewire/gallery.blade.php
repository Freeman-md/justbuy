<div class="relative py-8 responsive-container">
    <select class="mb-1" wire:model="sortBy">
        <option value="default">Sort By</option>
        <option value="latest">New Products</option>
        <option value="priceDesc">Price: High To Low</option>
        <option value="price">Price: Low To High</option>
        <option value="inStock">In Stock</option>
        <option value="outOfStock">Out of Stock</option>
    </select>
    <select class="mb-1" wire:model="pageSize">
        <option value="20">Page Size</option>
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="45">45</option>
        <option value="60">60</option>
    </select>

    {{-- Brands --}}
    <div class="flex flex-wrap w-full mt-4">

        @if($activeBrand == null)
            <span class="mx-1 rounded-xl py-1 px-2 text-xs capitalize text-white cursor-default bg-black mb-1">All Products</span>
        @else
            <span class="mx-1 rounded-xl py-1 px-2 text-xs capitalize text-white bg-secondary cursor-pointer mb-1" wire:click.prevent="$set('brand', null)">All Products</span>
        @endif

        @foreach($brands as $brand)
            <span class="mx-1 rounded-xl py-1 px-2 text-xs @if($activeBrand == $brand->slug) cursor-default bg-black @else bg-secondary cursor-pointer @endif mb-1 text-white capitalize" wire:click.prevent="$set('brand', '{{$brand->slug}}')">{{$brand->name}}</span>
        @endforeach

        <span wire:loading class="pt-3 pl-2">
            <span class="spinner"></span>
        </span>

    </div>

    {{-- Products --}}
    <div class="grid w-full mt-8 space-y-2 2xs:space-y-0 xs:space-y-0 sm:space-y-0 lg:grid-cols-5 md:grid-cols-3 xs:grid-cols-2 2xs:grid-cols-2 sm:grid-cols-2 lg:gap-4 md:gap-4 sm:gap-6 xs:gap-6 2xs:gap-6">
        @foreach($products as $product)
            @livewire('includes.product', ['product' => $product, 'cartItems' => $cartItems, 'cartIds' => $cartIds], key($product->id))
        @endforeach
    </div>

    <div class="overflow-x-auto my-3.5">
        {{$products->links()}}
    </div>
</div>
