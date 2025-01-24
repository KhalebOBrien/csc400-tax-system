<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grant Application Info') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-6 ">
        <div class="grid gap-6 lg:grid-cols-3 lg:gap-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black">Applicant Information</h2>

                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Full Name:</span> {{ $grant->full_name }}</p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Age:</span> {{ $grant->age }}</p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Address:</span> {{ $grant->address }}</p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Email:</span> {{ $grant->email }}</p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Phone No:</span> {{ $grant->phone_no }}</p>
                </div>
            </div>
            <div class="grid gap-6">
                <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                    <div class="">
                        <h2 class="text-xl font-semibold text-black">Grant Purpose</h2>

                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Purpose of applying:</span> {{ $grant->grant_purpose }}</p>
                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Project/Idea:</span> {{ $grant->idea_short_description }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                    <div class="">
                        <h2 class="text-xl font-semibold text-black">Funding</h2>

                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Expected funding:</span> ${{ $grant->expected_funding }}</p>
                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Expected Payment Means:</span> {{ $grant->payment_means }}</p>
                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Fund Use-cases:</span> 
                        @php
                            $arr = json_decode($grant->fund_use_cases);
                        @endphp
                        {{ $arr ? implode(', ', $arr) : '' }}</p>
                    </div>
                </div>
            </div>
            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black">Additional Information</h2>

                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Heard about via:</span> {{ $grant->campaign }}</p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Have Received grants from other organizations before?</span> {{ $grant->received_grants_before ? 'Yes' : 'No' }}</p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">List of organizations and amounts received:</span> {{ $grant->past_grants_details }}</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3 lg:gap-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-start gap-4 col-span-2 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black">Identifications</h2>

                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">SSN or TIN:</span> {{ $grant->ssn_or_tin }}</p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Uploaded ID Card (Front):</span></p>
                    <p class="mt-4 text-sm/relaxed">
                        @if (isset($grant->issued_id_front_path))
                        <img src="{{ asset('storage/' . $grant->issued_id_front_path) }}" alt="{{ $grant->full_name }} ID card front" />
                        @else
                        NILL
                        @endif
                    </p>
                    <p class="mt-4 text-sm/relaxed"><span class="font-bold">Uploaded ID Card (Back):</span></p>
                    <p class="mt-4 text-sm/relaxed">
                        @if (isset($grant->issued_id_back_path))
                        <img src="{{ asset('storage/' . $grant->issued_id_back_path) }}" alt="{{ $grant->full_name }} ID card back" />
                        @else
                        NILL
                        @endif
                    </p>
                </div>
            </div>
            <div class="grid gap-6">
                <div class="rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20]">
                    <div class="pt-3 sm:pt-5">
                        <h2 class="text-xl font-semibold text-black">Certification</h2>

                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Full Name:</span> {{ $grant->certification_name }}</p>
                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Date:</span> {{ $grant->certification_date }}</p>
                    </div>
                </div>
                @if (Auth::user()->role == 'user')
                <div class="gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                    <div class="">
                        <h2 class="text-xl font-semibold text-black">Verification Link</h2>
                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Grant Status:</span> {{ \Str::ucfirst($grant->status) }}</p>
                        <p class="mt-4 text-sm/relaxed">
                            <span class="font-bold">URL:</span> <a href="{{ $grant->verification_url }}" target="_blank"> {{ $grant->verification_url }}</a>
                        </p>
                        @if ($grant->status == 'awaiting_verification')
                        <form method="POST" enctype="multipart/form-data" action="{{ route('grant.store-vproof', ['uuid' => $grant->id]) }}">
                            @csrf
                            <div class="col-span-12 sm:col-span-12 mt-4">
                                <x-label for="verification_proof" value="{{ __('Upload Proof of Verification') }}" />
                                <x-input id="verification_proof" name="verification_proof" type="file" class="mt-1 w-full" required />
                                <x-input-error for="verification_proof" class="mt-2" />
                            </div>
                            <div class="justify-end text-end mt-4">
                                <x-button>
                                    {{ __('Upload') }}
                                </x-button>
                            </div>
                        </form>
                        @endif
                        @if ($grant->status != 'pending')
                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Uploaded Proof of Verification:</span></p>
                        <p class="mt-4 text-sm/relaxed">
                            @if (isset($grant->verification_proof_path))
                            <img src="{{ asset('storage/' . $grant->verification_proof_path) }}" alt="{{ $grant->full_name }} proof of verification" />
                            @else
                            NILL
                            @endif
                        </p>
                        @endif
                    </div>
                </div>
                @else
                <div class="gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                    <div class="">
                        <h2 class="text-xl font-semibold text-black">Verification Link</h2>
                        <form method="POST" action="{{ route('grant.store-vlink', ['uuid' => $grant->id]) }}">
                            @csrf
                            <div class="col-span-12 sm:col-span-12 mt-4">
                                <x-label for="verification_url" value="{{ __('Set URL') }}" required />
                                <x-input id="verification_url" name="verification_url" type="text" class="mt-1 w-full" required value="{{ $grant->verification_url ?? old('verification_url')}}" />
                                <x-input-error for="verification_url" class="mt-2" />
                            </div>
                            <div class="justify-end text-end mt-4">
                                <x-button>
                                    {{ __('Save') }}
                                </x-button>
                            </div>
                        </form>
                        @if ($grant->status != 'pending')
                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Uploaded Proof of Verification:</span></p>
                        <p class="mt-4 text-sm/relaxed">
                            @if (isset($grant->verification_proof_path))
                            <img src="{{ asset('storage/' . $grant->verification_proof_path) }}" alt="{{ $grant->full_name }} proof of verification" />
                            @else
                            NILL
                            @endif
                        </p>
                        @endif
                    </div>
                </div>
                <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                    <div class="">
                        <h2 class="text-xl font-semibold text-black">Take Action</h2>

                        <p class="mt-4 text-sm/relaxed"><span class="font-bold">Grant Status:</span> {{ \Str::ucfirst($grant->status) }}</p>

                        <p class="mt-4 text-sm/relaxed">
                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href="{{ route('grant.update-status', ['uuid' => $grant->id, 'status' => 'approved']) }}">Approve</a>
                        
                            <a class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href="{{ route('grant.update-status', ['uuid' => $grant->id, 'status' => 'rejected']) }}">Reject</a>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
