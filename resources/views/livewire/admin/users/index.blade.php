<div>
    @livewire('admin.includes.navigation')
    <div class="py-4 responsive-container">
        <livewire:admin.data-tables.users searchable="name, email" exportable  />
    </div>
</div>
