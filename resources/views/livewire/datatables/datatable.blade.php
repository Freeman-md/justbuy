<div>
    @if($beforeTableSlot)
        <div class="mt-8">
            @include($beforeTableSlot)
        </div>
    @endif
    <div class="relative">
        <div class="flex flex-col justify-between mb-1 space-y-1 sm:items-center sm:space-y-0 sm:flex-row">
            <div class="flex items-center flex-grow h-10">
                @if($this->searchableColumns()->count())
                <div class="flex rounded-lg shadow-sm w-96">
                    <div class="relative flex-grow focus-within:z-10">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input wire:model.debounce.500ms="search" class="block w-full p-2 pl-10 transition duration-150 ease-in-out rounded-md form-input bg-gray-50 focus:bg-white sm:text-sm sm:leading-5" placeholder="{{__('Search in')}} {{ $this->searchableColumns()->map->label->join(', ') }}" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button wire:click="$set('search', null)" class="text-gray-300 hover:text-red-600 focus:outline-none">
                                <x-icons.x-circle class="w-5 h-5 stroke-current" />
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="flex items-center sm:space-x-1">
                <x-icons.cog wire:loading class="text-gray-400 h-9 w-9 animate-spin" />

                @if($exportable)
                <div x-data="{ init() {
                    window.livewire.on('startDownload', link => window.open(link,'_blank'))
                } }" x-init="init">
                    <button wire:click="export" class="flex items-center px-3 space-x-2 text-xs font-medium leading-4 tracking-wider text-green-500 uppercase bg-white border border-green-400 rounded-md hover:bg-green-200 focus:outline-none"><span>{{ __('Export') }}</span>
                        <x-icons.excel class="m-2" /></button>
                </div>
                @endif

                @if($hideable === 'select')
                @include('datatables::hide-column-multiselect')
                @endif
            </div>
        </div>

        @if($hideable === 'buttons')
        <div class="grid grid-cols-8 gap-2 p-2">
            @foreach($this->columns as $index => $column)
            <button wire:click.prefetch="toggle('{{ $index }}')" class="px-3 py-2 rounded text-white text-xs focus:outline-none
            {{ $column['hidden'] ? 'bg-blue-100 hover:bg-blue-300 text-blue-600' : 'bg-blue-500 hover:bg-blue-800' }}">
                {{ $column['label'] }}
            </button>
            @endforeach
        </div>
        @endif

        <div class="overflow-x-scroll bg-white rounded-lg shadow-lg max-w-screen">
            <div class="rounded-lg @unless($this->hidePagination) rounded-b-none @endif">
                <div class="table min-w-full align-middle">
                    @unless($this->hideHeader)
                    <div class="table-row divide-x divide-gray-200">
                        @foreach($this->columns as $index => $column)
                            @if($hideable === 'inline')
                                @include('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort])
                            @elseif($column['type'] === 'checkbox')
                            <div class="relative flex items-center justify-between w-48 h-12 px-6 py-3.5 overflow-hidden text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase align-top focus:outline-none">
                                <div class="flex items-center space-x-2">
                                    <div>SELECT ALL</div>
                                    <div>
                                        <input type="checkbox" wire:click="toggleSelectAll" @if(count($selected) === $this->results->total()) checked @endif class="w-4 h-4 text-blue-600 transition duration-150 ease-in-out form-checkbox" />
                                    </div>
                                </div>
                                <div class="p-1 rounded @if(count($selected)) bg-gray-800 @else bg-gray-200 @endif text-white text-center">
                                    {{ count($selected) }}
                                </div>
                            </div>
                            @else
                                @include('datatables::header-no-hide', ['column' => $column, 'sort' => $sort])
                            @endif
                        @endforeach
                    </div>

                    <div class="table-row bg-blue-100 divide-x divide-blue-200">
                        @foreach($this->columns as $index => $column)
                            @if($column['hidden'])
                                @if($hideable === 'inline')
                                    <div class="table-cell w-5 overflow-hidden align-top bg-blue-100"></div>
                                @endif
                            @else
                                <div class="table-cell overflow-hidden align-top">
                                    @isset($column['filterable'])
                                        @if( is_iterable($column['filterable']) )
                                            <div wire:key="{{ $index }}" class="p-1">
                                                @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                                            </div>
                                        @else
                                            <div wire:key="{{ $index }}">
                                                @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                                            </div>
                                        @endif
                                    @endisset
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                    @foreach($this->results as $result)
                        <div class="table-row p-1 divide-x divide-gray-100 {{ isset($result->checkbox_attribute) && in_array($result->checkbox_attribute, $selected) ? 'bg-orange-100' : ($loop->even ? 'bg-gray-100' : 'bg-gray-50') }}">
                            @foreach($this->columns as $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                    <div class="table-cell w-5 overflow-hidden align-top"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    @include('datatables::checkbox', ['value' => $result->checkbox_attribute])
                                @elseif($column['name'] == 'role')
                                    <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                                        <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight @if($result->{$column['name']} == 'Admin') text-yellow-900 @else text-pink-900 @endif">
                                        <span aria-hidden
                                            class="absolute inset-0 rounded-full opacity-50 @if($result->{$column['name']} == 'Admin') bg-yellow-200 @else bg-pink-200 @endif"></span>
                                        <span class="relative">{!! $result->{$column['name']} !!}</span>
                                    </span>
                                    </div>
                                @elseif(in_array($column['name'], ['status', 'availability']))
                                    <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                                        <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight @if(in_array($result->{$column['name']}, ['Transit', 'Out of Stock'])) text-yellow-900 @elseif(in_array($result->{$column['name']}, ['Confirmed', 'In Stock'] )) text-green-900 @else text-blue-900 @endif">
                                        <span aria-hidden
                                            class="absolute inset-0 rounded-full opacity-50 @if(in_array($result->{$column['name']}, ['Transit', 'Out of Stock']))bg-yellow-200 @elseif(in_array($result->{$column['name']}, ['Confirmed', 'In Stock'] )) bg-green-200 @else bg-blue-200 @endif"></span>
                                        <span class="relative">{!! $result->{$column['name']} !!}</span>
                                    </span>
                                    </div>
                                @else
                                    <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                                        {!! $result->{$column['name']} !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if($this->results->count() <= 0)
            <div class="w-full p-3 text-sm text-center text-teal-600 bg-white">
                {{ __("There's Nothing to show at the moment") }}
            </div>
        @endif
        @unless($this->hidePagination)
            <div class="bg-white border-b border-gray-200 rounded-lg rounded-t-none max-w-screen">
                <div class="items-center justify-between p-2 sm:flex">
                    {{-- check if there is any data --}}
                    @if(count($this->results))
                        <div class="flex items-center my-2 sm:my-0">
                            <select name="perPage" class="block w-full py-2 pl-3 pr-10 mt-1 text-base leading-6 border-gray-300 form-select focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="99999999">{{__('All')}}</option>
                            </select>
                        </div>

                        <div class="my-4 sm:my-0">
                            <div class="lg:hidden">
                                <span class="space-x-2">{{ $this->results->links('datatables::tailwind-simple-pagination') }}</span>
                            </div>

                            <div class="justify-center hidden lg:flex">
                                <span>{{ $this->results->links('datatables::tailwind-pagination') }}</span>
                            </div>
                        </div>

                        <div class="flex justify-end text-gray-600">
                            {{__('Results')}} {{ $this->results->firstItem() }} - {{ $this->results->lastItem() }} {{__('of')}}
                            {{ $this->results->total() }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    @if($afterTableSlot)
    <div class="mt-8">
        @include($afterTableSlot)
    </div>
    @endif
</div>
