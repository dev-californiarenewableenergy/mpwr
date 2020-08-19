<x-app.auth :title="__('Manage Incentives')">
    <div>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex justify-between">
                    <div>
                        <h3 class="text-lg text-gray-900">Manage Incentives</h3>
                      </div>
                      <div>
                        <x-button :href="route('castle.incentives.create')" color="green">
                            @lang('Create')
                        </x-button>
                      </div>
                </div>
              
                <div class="mt-6">
                    <div class="flex flex-col">
                        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div class="align-middle inline-block min-w-full overflow-hidden">
                            @if($incentives)
                                <x-table>
                                    <x-slot name="header">
                                        <x-table.th-tr>
                                            <x-table.th by="number_installs">
                                                @lang('# of Installs')
                                            </x-table.th>
                                            <x-table.th by="incentives">
                                                @lang('Incentive')
                                            </x-table.th>
                                            <x-table.th by="installs_achieved">
                                                @lang('% Achieved (Installs)')
                                            </x-table.th>
                                            <x-table.th by="installs_needed">
                                                @lang('Needed (Installs)')
                                            </x-table.th>
                                            <x-table.th by="kw_achievied">
                                                @lang('% Achieved (kW\'s)')
                                            </x-table.th>
                                            <x-table.th by="kw_needed">
                                                @lang('Needed (kW\'s)')
                                            </x-table.th>
                                            <x-table.th></x-table.th>
                                            </x-table.th-tr>
                                    </x-slot>
                                    <x-slot name="body">
                                        @foreach($incentives as $incentive)
                                            <x-table.tr :loop="$loop">
                                                <x-table.td>{{ $incentive->number_installs }}</x-table.td>
                                                <x-table.td>{{ $incentive->name }}</x-table.td>
                                                <x-table.td>{{ $incentive->installs_achieved }}</x-table.td>
                                                <x-table.td>{{ $incentive->installs_needed }}</x-table.td>
                                                <x-table.td>{{ $incentive->kw_achieved }}</x-table.td>
                                                <x-table.td>{{ $incentive->kw_needed }}</x-table.td>
                                                <x-table.td class="flex space-x-3">
                                                    <x-link :href="route('castle.incentives.edit', $incentive)" class="text-sm">Edit</x-link>
                                                    <x-form :route="route('castle.incentives.destroy', $incentive->id)" delete
                                                            x-data="{deleting: false}">
                                                    <x-link color="red" class="text-sm" type="button"
                                                            x-show="!deleting"
                                                            x-on:click="$dispatch('confirm', {from: $event.target})"
                                                            x-on:confirmed="deleting = true; $el.submit()"
                                                        >Delete</x-link>
                                                    <span x-show="deleting" class="text-gray-400">Deleting ...</span>
                                                    </x-form>
                                                </x-table.td>
                                            </x-table.tr>
                                        @endforeach
                                    </x-slot>
                                </x-table>
                            @else
                                <div class="h-96 ">
                                    <div class="flex justify-center align-middle">
                                        <div class="text-sm text-center text-gray-700">
                                            <x-svg.draw.empty></x-svg.draw.empty>
                                            No data yet.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        </div>
        
                        <x-confirm
                            :title="__('Delete Incentive')"
                            :description="__('Are you sure you want to delete this incemtive?')"
                        ></x-confirm>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app.auth>