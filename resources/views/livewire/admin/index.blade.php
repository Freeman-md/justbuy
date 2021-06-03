<div>
    @livewire('admin.includes.navigation')

    <div class="responsive-container">

        {{-- Database Summary --}}
        
        <div class="flex flex-wrap">
            <div class="w-full px-4 my-2 sm:w-6/12 lg:w-4/12 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                        Total Users
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                        {{ $data['users'] }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-red-500 rounded-full shadow-lg">
                        <i class="fas fa-users"></i>
                        </div>
                    </div>
                    </div>
                    <p class="mt-4 text-sm">
                      <span class="mr-2 text-red-500">
                        <i class="text-red-500 fas fa-users"></i>
                      </span>
                    <a href="{{ route('admin-users') }}" class="whitespace-nowrap hover:text-red-500">
                        Users
                    </a>
                    </p>
                </div>
                </div>
            </div>
    
            <div class="w-full px-4 my-2 sm:w-6/12 lg:w-4/12 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                        Total Products
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                        {{ $data['products'] }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-purple-500 rounded-full shadow-lg">
                        <i class="fas fa-list-alt"></i>
                        </div>
                    </div>
                    </div>
                    <p class="mt-4 text-sm">
                      <span class="mr-2 text-purple-500">
                        <i class="text-purple-500 fas fa-list-alt"></i>
                      </span>
                    <a href="{{ route('admin-products') }}" class="whitespace-nowrap hover:text-purple-500">
                        Products
                    </a>
                    </p>
                </div>
                </div>
            </div>
    
            <div class="w-full px-4 my-2 sm:w-6/12 lg:w-4/12 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                        Total Brands
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                        {{ $data['brands'] }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-indigo-500 rounded-full shadow-lg">
                        <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                    </div>
                    <p class="mt-4 text-sm">
                      <span class="mr-2 text-indigo-500">
                        <i class="text-indigo-500 fas fa-layer-group"></i>
                      </span>
                    <a href="{{ route('admin-brands') }}" class="whitespace-nowrap hover:text-indigo-500">
                        Brands
                    </a>
                    </p>
                </div>
                </div>
            </div>
    
            <div class="w-full px-4 my-2 sm:w-6/12 lg:w-4/12 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                        Total Orders
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                        {{ $data['orders'] }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-green-500 rounded-full shadow-lg">
                        <i class="fas fa-shipping-fast"></i>
                        </div>
                    </div>
                    </div>
                    <p class="mt-4 text-sm">
                      <span class="mr-2 text-green-500">
                        <i class="text-green-500 fas fa-shipping-fast"></i>
                      </span>
                    <a href="{{ route('admin-orders') }}" class="whitespace-nowrap hover:text-green-500">
                        Orders
                    </a>
                    </p>
                </div>
                </div>
            </div>
        </div>
        

    </div>
</div>
