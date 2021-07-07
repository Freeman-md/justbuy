<div>
    @livewire('admin.includes.navigation')
    <div class="py-4 responsive-container">
        <div class="mb-6">
            <a href="{{ route('admin-projects.create') }}" class="btn btn-dark btn-md">&plus; Create New</a>
        </div>
        <livewire:admin.data-tables.projects searchable="title" exportable  /> 
    </div>
</div>
