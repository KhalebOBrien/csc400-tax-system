<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">Welcome to your account dashboard! Here, you can manage your profile, track your filings, and access exclusive updates on your tax payments.</p>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-4 lg:gap-8 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('grants') }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $grantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Total Applications</p>
            </div>
        </a>
        <a href="{{ route('grants.byStatus', ['status' => 'pending']) }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $pendingGrantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Pending Applications</p>
            </div>
        </a>
        <a href="{{ route('grants.byStatus', ['status' => 'awaiting_verification']) }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $awaitingGrantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Grants Awaiting Verification</p>
            </div>
        </a>
        <a href="{{ route('grants.byStatus', ['status' => 'approved']) }}"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black">{{ $approvedGrantsCount }}</h2>

                <p class="mt-4 text-sm/relaxed">Grants Approved</p>
            </div>
        </a>
    </div>
</x-app-layout>
