<x-app.auth :title="__('New Incentive')">
    <div>
        <div class="max-w-6xl mx-auto py-5 sm:px-6 lg:px-8">
            <a href="{{ route('castle.incentives.index') }}" class="inline-flex items-center pt-1 border-b-2 border-green-base text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-base transition duration-150 ease-in-out">
                < New Incentive
            </a>
        </div>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-form :route="route('castle.incentives.store')" post>
                <div>
                    <div class="mt-6 grid grid-cols-2 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="md:col-span-3 col-span-2">
                            <x-input label="Number of Installs" name="number_installs" type="number"/>
                        </div>

                        <div class="md:col-span-3 col-span-2">
                            <x-input label="Incentive Name" name="name"/>
                        </div>

                        <div class="md:col-span-3 col-span-1">
                            <x-input label="Installs Needed" name="installs_needed"/>
                        </div>

                        <div class="md:col-span-3 col-span-2">
                            <x-input-add-on  label="kW Needed" name="kw_needed" addOn="kW"/>
                        </div>
                        <div class="md:col-span-3 col-span-2">
                            <div class="md:col-span-3 col-span-2">
                                @if(user()->role != "Admin" && user()->role != "Owner")
                                    <x-select label="Department" name="department_id" hidden>
                                        @if (old('department') == '')
                                            <option value="" selected>None</option>
                                        @endif
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department', user()->department_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department['name'] }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                @else
                                    <x-select label="Department" name="department_id">
                                        @if (old('department') == '')
                                            <option value="" selected>None</option>
                                        @endif
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department', user()->department_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department['name'] }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-5">
                <div class="flex justify-start">
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray transition duration-150 ease-in-out">
                            Add Incentive
                        </button>
                    </span>
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <a href="{{route('castle.incentives.index')}}" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-800 hover:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray transition duration-150 ease-in-out">
                            Cancel
                        </a>
                    </span>
                </div>
                </div>
            </x-form>
        </div>
    </div>
</x-app.auth>
