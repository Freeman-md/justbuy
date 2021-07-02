<div>

    {{-- Slider --}}
    <div style="height: 100%;">
      <div class="responsive-container">
        <div class="relative">
            <img src="{{ asset('assets/images/main-background.jpg') }}" class="z-0 object-fill w-100" style="height: 400px; width: 100%;"/>
            <div class="absolute top-0 bottom-0 flex justify-center bg-black opacity-50 z-1 w-100" style="width: 100%;"></div>
            <div class="absolute top-0 bottom-0 flex flex-col items-center justify-center space-y-2 z-2 w-100" style="width: 100%;">
                
                {{-- Advertisement --}}
                <div class="flex flex-col items-center justify-center px-10 py-6 space-y-4 font-serif text-2xl font-bold text-white uppercase border-4 border-white">
                    <div class="flex flex-col items-center justify-center">
                        <span>Today's</span>
                        <span>Deals</span>
                    </div>
                    
                    <span class="text-5xl font-extrabold text-primary">Sale</span>

                    <span class="">Up To</span>

                    <span class="text-primary">50%</span>
                </div>

                {{-- Go To Gallery --}}
                <a href="{{route('gallery')}}" class="uppercase btn btn-md btn-primary">Shop Now</a>

            </div>
        </div>
      </div>
    </div>
  
    {{-- Support --}}
    <div class="py-2">
      <div class="responsive-container">
        <div class="grid space-y-1 md:space-y-0 md:gap-12 md:grid-cols-3">
          
          {{-- Support Item --}}
          <div class="flex items-center justify-center p-3 text-2xl text-white md:rounded-r-full bg-secondary">
            <span class="mr-2 fas fa-plane-departure"></span>
            <div class="flex flex-col">
                <h1 class="font-extrabold uppercase">Free Shipping</h1>
                <span class="text-xs">In Order Min $200</span>
            </div>
          </div>
  
          {{-- Support Item --}}
          <div class="flex items-center justify-center p-3 text-2xl text-white bg-black md:rounded-l-full md:rounded-r-full">
            <span class="mr-2 far fa-clock"></span>
            <div class="flex flex-col">
                <h1 class="font-extrabold uppercase">30-Days Returns</h1>
                <span class="text-xs">Money Back Guarantee</span>
            </div>
          </div>
  
          {{-- Support Item --}}
          <div class="flex items-center justify-center p-3 text-2xl text-white md:rounded-l-full bg-secondary">
            <span class="mr-2 fas fa-radiation-alt"></span>
            <div class="flex flex-col">
                <h1 class="font-extrabold uppercase">24/7 Support</h1>
                <span class="text-xs">Lifetime Support</span>
            </div>
          </div>
  
        </div>
      </div>
    </div>

    {{-- Featured Products --}}
    <div class="flex flex-col items-center pt-8 mt-4" wire:ignore>
        {{-- Title --}}
        <x-title title="Featured Products"/>
        <div class="w-full mt-8 responsive-container">
            {{-- Images --}}
            <div class="">
                
                {{-- Owl Carousel --}}
                <div id="featured-products" class="owl-carousel owl-theme">
          
                    @foreach($featuredProducts as $product) 
                        <div class="relative w-full transition duration-300 item h-44 backdrop-filter hover:opacity-75 hover:brightness-0" wire:ignore>
                            <img class="h-full w-100" src="{{ $product->image->medium }}" alt="{{ $product->name }}">
                            <div class="absolute flex flex-col items-center justify-center m-2 text-transparent transition duration-300 border border-white hover:text-gray-500 inset-2 hover:border-transparent hover:bg-black hover:opacity-95">
                                <a class="transition duration-100 transform cursor-pointer hover:text-white hover:scale-110" wire:click.prevent="$emit('viewProduct', {{$product}})">View Product</a>
                            </div>
                        </div>
                    @endforeach
                   
                </div>

            </div>

        </div>
    </div>

    {{-- New Products --}}
    <div class="pt-8 mt-4">
        <div class="flex flex-col items-center w-full responsive-container">
            
            {{-- Title --}}
            <x-title title="New Products"/>

            <div class="grid w-full mt-8 2xs:space-y-0 space-y-2 xs:space-y-0 sm:space-y-0 lg:grid-cols-5 md:grid-cols-3 2xs:grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 lg:gap-4 md:gap-4 sm:gap-6 xs:gap-6 2xs:gap-6">
                
            @foreach($products as $product)
                @livewire('includes.product', ['product' => $product, 'cartItems' => $cartItems, 'cartIds' => $cartIds], key($product->id))
            @endforeach

            </div>

            <a href="{{ route('gallery') }}" class="mt-4 btn btn-lg btn-primary">Our Gallery</a>
            
        </div>
    </div>
    
    {{-- Brands --}}
    <div class="flex flex-col items-center pt-8 mt-4">
        {{-- Title --}}
        <x-title title="Our Brands"/>
        <div class="w-full mt-8 responsive-container">
            <div id="our-brands" class="owl-carousel owl-theme">
                <div class="w-full transition duration-300 h-44">
                    <img src="https://js-commerce.netlify.app/images/products/brands/brands1.webp" alt="Brand 1">
                </div>
                <div class="w-full transition duration-300 h-44">
                    <img src="https://js-commerce.netlify.app/images/products/brands/brands2.webp" alt="Brand 2">
                </div>
                <div class="w-full transition duration-300 h-44">
                    <img src="https://js-commerce.netlify.app/images/products/brands/brands3.webp" alt="Brand 3">
                </div>
                <div class="w-full transition duration-300 h-44">
                    <img src="https://js-commerce.netlify.app/images/products/brands/brands4.webp" alt="Brand 4">
                </div>
                <div class="w-full transition duration-300 h-44">
                    <img src="https://js-commerce.netlify.app/images/products/brands/brands5.webp" alt="Brand 5">
                </div>
                <div class="w-full transition duration-300 h-44">
                    <img src="https://js-commerce.netlify.app/images/products/brands/brands6.webp" alt="Brand 6">
                </div>
            </div>
        </div>
    </div>

    {{-- Customers Says --}}
    <div class="w-full pt-8 mt-4" wire:ignore>
        <div class="flex flex-col items-center ">
            {{-- Title --}}
            <x-title title="Customers Says"/>
        </div>
        
        <div class="mt-8 bg-secondary">
            <div class="responsive-container">
                <div class="grid py-10 space-y-4 text-white sm:grid-cols-2 sm:gap-12 md:space-y-0 md:grid-cols-4 md:gap-6 sm:space-y-0">
                    
                    {{-- Customer Say --}}
                    <div class="flex flex-col items-center justify-start" wire:ignore>
                        <img src="{{ (is_null($avatars) || $avatars == []) ? '' : $avatars['photos'][0]['src']['small'] }}" alt="Sandra" class="w-10 h-10 rounded-full" wire:ignore/>
                        <span class="w-2/3 text-center sm:w-full">Very user friendly and nice features. You would want to try this.</span>
                        <span class="text-xl text-black">Sandra Devi</span>
                        <span class="text-xs font-bold text-white uppercase">Fashion Designer</span>
                    </div>

                    {{-- Customer Say --}}
                    <div class="flex flex-col items-center justify-center" wire:ignore>
                        <img src="{{ (is_null($avatars) || $avatars == []) ? '' : $avatars['photos'][1]['src']['small'] }}" alt="George" class="w-10 h-10 rounded-full" wire:ignore/>
                        <span class="w-2/3 text-center sm:w-full">JustBuy is a good and well-known store.</span>
                        <span class="text-xl text-black">George Andrew</span>
                        <span class="text-xs font-bold text-white uppercase">Product Manager</span>
                    </div>

                    {{-- Customer Say --}}
                    <div class="flex flex-col items-center justify-center" wire:ignore>
                        <img src="{{ (is_null($avatars) || $avatars == []) ? '' : $avatars['photos'][2]['src']['small'] }}" alt="Edwin" class="w-10 h-10 rounded-full" wire:ignore/>
                        <span class="w-2/3 text-center sm:w-full">Very good and elegant designs with the automatic invoices.</span>
                        <span class="text-xl text-black">Edwin Thomas</span>
                        <span class="text-xs font-bold text-white uppercase">CEO Zaful</span>
                    </div>

                    {{-- Customer Say --}}
                    <div class="flex flex-col items-center justify-center" wire:ignore>
                        <img src="{{ (is_null($avatars) || $avatars == []) ? '' : $avatars['photos'][3]['src']['small'] }}" alt="Mark" class="w-10 h-10 rounded-full" wire:ignore/>
                        <span class="w-2/3 text-center sm:w-full">One thing I love about this store is about their unque designs.</span>
                        <span class="text-xl text-black">Mark Rod</span>
                        <span class="text-xs font-bold text-white uppercase">IT Manager</span>
                    </div>
    
                </div>
            </div>
        </div>
        
    </div>

    {{-- Footer --}}
    
  
  </div>