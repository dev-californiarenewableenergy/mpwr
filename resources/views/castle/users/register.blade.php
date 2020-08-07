<x-app.auth :title="__('New User')">
    <div>
        <div class="max-w-6xl mx-auto py-5 sm:px-6 lg:px-8">
            <a href="{{route('castle.users.index')}}" class="inline-flex items-center pt-1 border-b-2 border-green-base text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-base transition duration-150 ease-in-out">
                < User Info
            </a>
        </div>

        @if ($message = session('message'))
            <x-alert class="mb-4" :title="__('Success')" :description="$message"></x-alert>
        @endif

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-form :route="route('castle.users.store')">
                <div>
                    <div class="mt-6 grid grid-cols-2 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="md:col-span-3 col-span-2">
                            <x-input :label="__('First Name')" name="first_name"/>
                        </div>
                
                        <div class="md:col-span-3 col-span-2">
                            <x-input :label="__('Last Name')" name="last_name"/>
                        </div>

                        <div class="md:col-span-3 col-span-2">
                            <x-input :label="__('Email')" name="email"/>
                        </div>

                        <div class="md:col-span-3 col-span-2">
                            <x-select label="Role" name="role">
                                @if (old('role') == '')
                                    <option selected></option>
                                @endif
                                @foreach($roles as $role)
                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="md:col-span-3 col-span-2">
                            <x-input :label="__('Office')" name="office"/>
                        </div>

                        <div class="md:col-span-3 col-span-2">
                            <x-input-currency :label="__('Pay')" name="pay"/>
                        </div>
                
                    </div>
                </div>
                
                <div class="mt-8 pt-2 flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray transition duration-150 ease-in-out">
                            Send Welcome Email
                        </button>
                    </span>
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <a href="{{route('home')}}" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-800 hover:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray transition duration-150 ease-in-out">
                            Cancel
                        </a>
                    </span>
                </div>
                
            </x-form>
        </div>
    </div>
</x-app.auth>
