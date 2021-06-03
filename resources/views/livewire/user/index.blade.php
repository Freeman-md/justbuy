<div>
    @livewire('user.includes.navigation')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-3 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <h1 class="text-2xl">Welcome to your dashboard, <span class="font-semibold">{{ auth()->user()->username }}</span></h1>
            </div>
        </div>
    </div>
</div>
