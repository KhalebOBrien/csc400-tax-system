<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Tax Filing') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('filing.personal.store') }}">
                @csrf
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-section-title>
                        <x-slot name="title">{{ __('Section 1') }}</x-slot>
                        <x-slot name="description">{{ __('Personal Information') }}</x-slot>
                    </x-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="name" value="{{ __('Full Name') }}" required />
                                    <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="Auth::user()->last_name.', '.Auth::user()->other_name" disabled autocomplete="name" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                                <!-- TIN -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="tin" value="{{ __('Tax Identification Number') }}" required />
                                    <x-input id="tin" name="tin" type="text" class="mt-1 block w-full" :value="Auth::user()->tin" disabled autocomplete="tin" />
                                    <x-input-error for="tin" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <x-section-title>
                            <x-slot name="title">{{ __('Section 2') }}</x-slot>
                            <x-slot name="description">{{ __('Income Data') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- total income amount -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="income_amount" value="{{ __('Total Income Amount (N)') }}" required />
                                        <x-input id="income_amount" name="income_amount" type="number" class="mt-1 block w-full" required :value="old('income_amount')" />
                                        <x-input-error for="income_amount" class="mt-2" />
                                    </div>
                                    <!-- total income amount -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="income_duration_start_date" value="{{ __('Start Date') }}" required />
                                        <x-input id="income_duration_start_date" name="income_duration_start_date" type="date" class="mt-1 block w-full" required :value="old('income_duration_start_date')" />
                                        <x-input-error for="income_duration_start_date" class="mt-2" />
                                    </div>
                                    <!-- total income amount -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="income_duration_end_date" value="{{ __('End Date') }}" required />
                                        <x-input id="income_duration_end_date" name="income_duration_end_date" type="date" class="mt-1 block w-full" required :value="old('income_duration_end_date')" />
                                        <x-input-error for="income_duration_end_date" class="mt-2" />
                                    </div>
                                    <!-- total payable tax -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="computed_tax_amount" value="{{ __('Total Payable Tax (N)') }}" />
                                        <x-input id="computed_tax_amount" name="computed_tax_amount" type="number" class="mt-1 block w-full" readonly  :value="1000" />
                                        <x-input-error for="computed_tax_amount" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <x-section-title>
                            <x-slot name="title">{{ __('Section 3') }}</x-slot>
                            <x-slot name="description">{{ __('Acknowledgement') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="text-gray-600 text-sm mt-6 mb-4">
                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="flex items-center">
                                            <x-checkbox name="toc" value="Equipment" required />
                                            <div class="ms-2">
                                                I, <span class="font-bold">{{Auth::user()->last_name.', '.Auth::user()->other_name}}</span> hereby certify that the information provided is accurate and true. I understand that my filing will be reviewed and additional information may be requested.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-600 mb-4 mt-4 italic">
                                    {{ __('NOTE: You will be redirected to the payment page after you click proceed.') }}
                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                <x-button wire:loading.attr="disabled" wire:target="photo">
                                    {{ __('Proceed') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
