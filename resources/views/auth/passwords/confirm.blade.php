@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                Confirm Password
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <x-card>
                <x-form :route="route('password.confirm')">

                    <x-input class="mt-6" type="password" label="Password" name="password"></x-input>

                    <div class="mt-6 flex items-center justify-end">
                        <div class="text-sm leading-5">
                            <x-link :href="route('password.request')">
                                Forgot Your Password?
                            </x-link>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <x-button class="w-full flex" type="submit" color="indigo">
                                 Confirm Password
                            </x-button>
                        </span>
                    </div>
                </x-form>

            </x-card>
        </div>
    </div>
@endsection
