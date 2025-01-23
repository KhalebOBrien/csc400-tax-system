<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Grant Application') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form method="POST" enctype="multipart/form-data" action="{{ route('grant.store') }}">
                @csrf
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-section-title>
                        <x-slot name="title">{{ __('Section 1') }}</x-slot>
                        <x-slot name="description">{{ __('Applicant Information') }}</x-slot>
                    </x-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="name" value="{{ __('Full Name') }}" required />
                                    <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autocomplete="name" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                                <!-- Age -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="age" value="{{ __('Age') }}" required />
                                    <x-input id="age" name="age" type="text" class="mt-1 block w-full" :value="old('age')" required autocomplete="age" />
                                    <x-input-error for="age" class="mt-2" />
                                </div>
                                <!-- Address -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="address" value="{{ __('Address') }}" required />
                                    <x-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required autocomplete="address" />
                                    <x-input-error for="address" class="mt-2" />
                                </div>
                                <!-- Phone Number -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="phone_no" value="{{ __('Phone Number') }}" required />
                                    <x-input id="phone_no" name="phone_no" type="text" class="mt-1 block w-full" :value="old('phone_no')" required autocomplete="phone_no" />
                                    <x-input-error for="phone_no" class="mt-2" />
                                </div>
                                <!-- Email -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="email" value="{{ __('Email') }}" required />
                                    <x-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required autocomplete="email" />
                                    <x-input-error for="email" class="mt-2" />
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
                            <x-slot name="description">{{ __('Grant Purpose') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- Grant Purpose -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="grant_purpose" value="{{ __('What is the purpose of this grant application? ') }}" required />
                                        <select name="grant_purpose" id="grant_purposeSelect" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="Education">Education</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Entrepreneurship">Entrepreneurship</option>
                                            <option value="Community Development">Community Development</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <div class="flex items-center">
                                            <div>Others (please specify)</div>
                                            <x-input id="grant_purposeTxt" type="text" name="full_name" class="mt-1 block w-full" />
                                        </div>
                                        <x-input-error for="grant_purpose" class="mt-2" />
                                    </div>
                                    <!-- idea_short_description -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="idea_short_description" value="{{ __('Describe your project/idea in 50 words or less') }}" required />
                                        <x-textarea id="idea_short_description" class="mt-1 block w-full h-40" name="idea_short_description" :value="old('idea_short_description')" required />
                                        <x-input-error for="idea_short_description" class="mt-2" />
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
                            <x-slot name="description">{{ __('Funding') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- Expected funding -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="expected_funding" value="{{ __('How much funding do you expect to receive from AidBridge? ($)') }}" required />
                                        <x-input id="expected_funding" name="expected_funding" type="number" class="mt-1 block w-full" required :value="old('expected_funding')" />
                                        <x-input-error for="expected_funding" class="mt-2" />
                                    </div>
                                    <!-- Means of payment -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="payment_means" value="{{ __('How would you like to get paid?') }}" required />
                                        <select name="payment_means" id="payment_means" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="Bank Check">Bank Check</option>
                                            <option value="Bank Deposit">Bank Deposit</option>
                                            <option value="PayPal">PayPal</option>
                                        </select>
                                        <x-input-error for="payment_means" class="mt-2" />
                                    </div>
                                    <!-- fund use cases -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="fund_use_cases[]" value="{{ __('What will the funds be used for? (select all that apply)') }}" required />
                                        <div class="flex items-center">
                                            <x-checkbox name="fund_use_cases[]" value="Equipment" />
                                            <div class="ms-2">Equipment</div>
                                        </div>
                                        <div class="flex items-center">
                                            <x-checkbox name="fund_use_cases[]" value="Personnel" />
                                            <div class="ms-2">Personnel</div>
                                        </div>
                                        <div class="flex items-center">
                                            <x-checkbox name="fund_use_cases[]" value="Operations" />
                                            <div class="ms-2">Operations</div>
                                        </div>
                                        <div class="flex items-center">
                                            <x-checkbox name="fund_use_cases[]" value="Research" />
                                            <div class="ms-2">Research</div>
                                        </div>
                                        <div class="flex items-center">
                                            <div>Other (please specify)</div>
                                            <x-input type="text" name="fund_use_casesTxt" class="mt-1 block w-full" />
                                        </div>
                                        <x-input-error for="fund_use_cases" class="mt-2" />
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
                            <x-slot name="title">{{ __('Section 4') }}</x-slot>
                            <x-slot name="description">{{ __('Identification') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- Identity Front -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="issued_id_front" value="{{ __('Front of Government Issued ID (Drivers License, Passport, etc)') }}" required />
                                        <x-input id="issued_id_front" name="issued_id_front" type="file" class="mt-1 block w-full" required />
                                        <x-input-error for="issued_id_front" class="mt-2" />
                                    </div>
                                    <!-- Identity Back-->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="issued_id_back" value="{{ __('Back of Government Issued ID') }}" required />
                                        <x-input id="issued_id_back" name="issued_id_back" type="file" class="mt-1 block w-full" required />
                                        <x-input-error for="issued_id_back" class="mt-2" />
                                    </div>
                                    <!-- SSN or TIN -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="ssn_or_tin" value="{{ __('Social Security Number (SSN) or Taxpayer Identification Number (TIN)') }}" required />
                                        <x-input id="ssn_or_tin" name="ssn_or_tin" type="text" class="mt-1 block w-full" required value="{{old('ssn_or_tin')}}" />
                                        <x-input-error for="ssn_or_tin" class="mt-2" />
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
                            <x-slot name="title">{{ __('Section 5') }}</x-slot>
                            <x-slot name="description">{{ __('Additional Information') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- Campaign -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="campaign" value="{{ __('How did you hear about AidBridge?') }}" />
                                        <x-input id="campaign" name="campaign" type="text" class="mt-1 block w-full" value="{{old('campaign') ?? $user->campaign}}" />
                                        <x-input-error for="campaign" class="mt-2" />
                                    </div>
                                    <!-- Past Grants -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="received_grants_before" value="{{ __('Have you received grants from other organizations in the past?') }}" />
                                        <select name="received_grants_before" id="received_grants_before" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" :value="old('received_grants_before')">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        <x-input-error for="received_grants_beforeTxt" class="mt-2" />
                                    </div>
                                    <!-- Yes, past grants -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="past_grants_details" value="{{ __('If yes, please list the organizations and amounts received') }}" />
                                        <x-textarea id="past_grants_details" class="mt-1 block w-full h-40" name="past_grants_details" value="{{old('past_grants_details')}}" />
                                        <x-input-error for="past_grants_details" class="mt-2" />
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
                            <x-slot name="title">{{ __('Section 6') }}</x-slot>
                            <x-slot name="description">{{ __('Certification') }}</x-slot>
                        </x-section-title>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                <div class="text-sm text-gray-600 mb-4">
                                    {{ __('I hereby certify that the information provided is accurate and true. I understand that AidBridge will review my application and may request additional information.') }}
                                </div>
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- certification name -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="certification_name" value="{{ __('Full Name') }}" required />
                                        <x-input id="certification_name" name="certification_name" type="text" class="mt-1 block w-full" required value="{{old('certification_name')}}" />
                                        <x-input-error for="certification_name" class="mt-2" />
                                    </div>
                                    <!-- certification date -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="certification_date" value="{{ __('Date') }}" required />
                                        <x-input id="certification_date" name="certification_date" type="text" class="mt-1 block w-full" required value="{{old('certification_date')}}" />
                                        <x-input-error for="certification_date" class="mt-2" />
                                    </div>
                                </div>
                                <div class="text-gray-600 text-base mt-4 border rounded p-4">
                                    <p class="text-gray-800 font-bold">Important Note: Human Liveness Check Requirement</p>
                                    <p>As part of our review process, you will be required to complete a human liveness check to verify your identity.</p>

                                    <p class="text-gray-800 font-semibold mt-2">What to Expect:</p>
                                    <ul class="list-disc pl-8">
                                        <li>Upon review of your application, you will receive an email with a unique verification link.</li>
                                        <li>Click the link to complete the liveness check.</li>
                                        <li>After completion, upload the confirmation certificate to your AidBridge account.</li>
                                    </ul>

                                    <p class="text-gray-800 font-semibold mt-2">Why is this required?</p>
                                    <p>This security measure ensures the integrity of our grant program and protects against fraudulent activities.</p>

                                    <p class="text-gray-800 font-semibold mt-2">When will I receive the verification link?</p>
                                    <p>You will receive the link via email once our team begins reviewing your application.</p>

                                    <p class="text-gray-800 font-semibold mt-2">Questions or Issues?</p>
                                    <p>Contact our support team at <a href="mailto:support@aidbridgefoundation.org" class="text-blue-600">support@aidbridgefoundation.org</a> for assistance.</p>

                                    <p class="mt-2">Thank you for your cooperation and understanding.</p>
                                </div>
                                <div class="text-gray-600 text-base mt-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="flex items-center">
                                            <x-checkbox name="toc" value="Equipment" required />
                                            <div class="ms-2">I have read and I understand these instructions.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                <x-button wire:loading.attr="disabled" wire:target="photo">
                                    {{ __('Submit Application') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
