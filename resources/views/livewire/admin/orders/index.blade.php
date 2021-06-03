<div>
    @livewire('admin.includes.navigation')
    <div class="py-4 responsive-container">
        <livewire:admin.data-tables.orders searchable="user.name, user.email" exportable  />
    </div>
</div>
