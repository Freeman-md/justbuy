<div class="py-8 bg-gray-900">
  
  <div class="grid space-y-4 text-white responsive-container md:space-y-0 md:grid-cols-2 md:gap-6">

    {{-- About Us --}}
    <div class="flex flex-col items-center justify-center space-y-3 text-sm divide-gray-500 divide">
      
      {{-- Brief About Us --}}
      <div class="flex flex-col items-center justify-center space-y-2">
        <h1 class="text-xl font-bold">About Us</h1>
        <span class="font-bold">Just Buy is not your typical thrift store.</span>
        <p class="text-center">
          We're the world's largest online secondhand shopping destination with thousands of like-new styles from your favorite brands at up to 90% off estimated retail. We make sure every single one of the 40k new arrivals we add to the site is 100% authentic and in such good shape anyone could mistake them as new. No knockoffs here-just knockoff prices. Find high-quality used women's clothing from fashionable closets just like yours. Specially curated by our style experts.
        </p>
        <a href="{{route('contact-us')}}" class="font-semibold btn btn-sm btn-light">Contact Us Now</a>
      </div>

      {{-- Quick Links --}}
      <div class="flex flex-col items-center self-center justify-center w-2/3">
        <span>Help Center</span>
        <div class="flex justify-between w-full">

          <div class="flex flex-col items-start justify-start space-y-1">
            <a href="" class="hover:underline">Terms Of Use</a>
            <a href="" class="hover:underline">Accessibility</a>
          </div>

          <div class="flex flex-col items-start justify-start space-y-1">
            <a href="" class="hover:underline">Privacy Policy</a>
            <a href="" class="hover:underline">Do Not Sell My Info</a>
          </div>

        </div>
      </div>

    </div>

    {{-- Subscriber --}}
    <div class="flex flex-col items-start w-full space-y-3 text-sm divide-gray-500 divide">
      
      {{-- Brief About Us --}}
      <div class="flex flex-col items-stretch space-y-2">
        <h1 class="w-full text-xl font-bold">Get Exclusive Offers & Updates</h1>
        @livewire('includes.subscribe')
      </div>
    
    </div>

  </div>
  
</div>

{{-- Bottom Footer --}}
<div class="flex flex-col py-8 space-y-2 text-sm text-white bg-black">
  <div class="responsive-container">
      <p>All third party brand names appearing on this page are trademarks or registered trademarks of their respective holders. Any such appearance does not necessarily imply any affiliation with or endorsement of {{ env('APP_NAME') }}.</p>
      <p>* While supplies last</p>
      <p>** % off estimated retail. See our Terms of Use for more information on how we calculate estimated original retail prices.</p>
      <p class="font-semibold">&copy;2020 {{ env('APP_NAME') }}.com. ALL RIGHTS RESERVED</p>
      <p class="font-semibold">{{ env('APP_NAME') }} Full SIte | Report Security Issues</p>
  </div>
  <div class="w-full text-center">
    <span class="text-gray-200">Coded with &hearts; by <a href="" class="transition duration-200 hover:underline hover:text-white">Xclusive Designs</a></span>
  </div>
</div>